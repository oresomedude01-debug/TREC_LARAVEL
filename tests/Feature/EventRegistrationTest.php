<?php

namespace Tests\Feature;

use App\Models\Event;
use App\Models\EventRegistration;
use App\Models\EventTicketType;
use App\Models\Setting;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class EventRegistrationTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        // Configure setting for Paystack
        Setting::set('paystack_enabled', '1');
        Setting::set('paystack_public_key', 'pk_test_123456');
        Setting::set('paystack_secret_key', 'sk_test_123456');
    }

    public function test_can_view_event_page(): void
    {
        $this->withoutExceptionHandling();

        $event = Event::create([
            'name' => 'Ripple Effect 2026',
            'slug' => '2026',
            'status' => 'registration_open',
        ]);

        $response = $this->get('/tscc/2026');

        $response->assertStatus(200);
        $response->assertSee('Ripple Effect 2026');
    }

    public function test_free_ticket_registration_succeeds_immediately(): void
    {
        Mail::fake();

        $event = Event::create([
            'name' => 'Ripple Effect 2026',
            'slug' => '2026',
            'status' => 'registration_open',
        ]);

        $ticket = EventTicketType::create([
            'event_id' => $event->id,
            'name' => 'Free Pass',
            'price' => 0,
            'currency' => 'NGN',
            'is_active' => true,
        ]);

        $response = $this->post('/tscc/2026/register', [
            'first_name' => 'John',
            'last_name' => 'Doe',
            'email' => 'john@example.com',
            'ticket_type_id' => $ticket->id,
        ]);

        // Assert registration exists
        $reg = EventRegistration::first();
        $this->assertNotNull($reg);
        $this->assertEquals('free', $reg->payment_status);
        $this->assertEquals('confirmed', $reg->status);
        $this->assertEquals(1, $ticket->fresh()->quantity_sold);

        // Assert redirect to confirmation page
        $response->assertRedirect(route('event.confirm', ['year' => '2026', 'token' => $reg->qr_token]));
    }

    public function test_paid_ticket_registration_redirects_to_paystack(): void
    {
        Http::fake([
            'https://api.paystack.co/transaction/initialize' => Http::response([
                'status' => true,
                'data' => [
                    'authorization_url' => 'https://checkout.paystack.com/fake-token',
                    'access_code' => 'fake-access-code',
                    'reference' => 'TEST-REF',
                ]
            ], 200)
        ]);

        $event = Event::create([
            'name' => 'Ripple Effect 2026',
            'slug' => '2026',
            'status' => 'registration_open',
        ]);

        $ticket = EventTicketType::create([
            'event_id' => $event->id,
            'name' => 'Premium Pass',
            'price' => 5000,
            'currency' => 'NGN',
            'is_active' => true,
        ]);

        $response = $this->post('/tscc/2026/register', [
            'first_name' => 'Jane',
            'last_name' => 'Doe',
            'email' => 'jane@example.com',
            'ticket_type_id' => $ticket->id,
        ]);

        // Assert registration exists as pending/waitlisted
        $reg = EventRegistration::first();
        $this->assertNotNull($reg);
        $this->assertEquals('pending', $reg->payment_status);
        $this->assertEquals('waitlisted', $reg->status);

        // Assert redirect to Paystack authorization URL
        $response->assertRedirect('https://checkout.paystack.com/fake-token');
    }

    public function test_paystack_callback_verifies_payment_correctly(): void
    {
        Mail::fake();

        $event = Event::create([
            'name' => 'Ripple Effect 2026',
            'slug' => '2026',
            'status' => 'registration_open',
        ]);

        $ticket = EventTicketType::create([
            'event_id' => $event->id,
            'name' => 'Premium Pass',
            'price' => 5000,
            'currency' => 'NGN',
            'is_active' => true,
        ]);

        // Create pending registration
        $reg = EventRegistration::create([
            'event_id' => $event->id,
            'ticket_type_id' => $ticket->id,
            'registration_number' => 'REF-123',
            'qr_token' => 'token-abc',
            'first_name' => 'Alice',
            'last_name' => 'Smith',
            'email' => 'alice@example.com',
            'payment_status' => 'pending',
            'amount_paid' => 0,
            'status' => 'waitlisted',
        ]);

        Http::fake([
            'https://api.paystack.co/transaction/verify/*' => Http::response([
                'status' => true,
                'data' => [
                    'status' => 'success',
                    'amount' => 500000, // 5000 NGN in kobo
                    'reference' => 'REF-123',
                ]
            ], 200)
        ]);

        $response = $this->get('/tscc/2026/payment/callback?reference=REF-123&token=token-abc');

        // Assert registration updated to paid & confirmed
        $reg->refresh();
        $this->assertEquals('paid', $reg->payment_status);
        $this->assertEquals('confirmed', $reg->status);
        $this->assertEquals(5000, $reg->amount_paid);

        $response->assertRedirect(route('event.confirm', ['year' => '2026', 'token' => 'token-abc']));
    }

    public function test_can_join_waitlist_when_no_active_tickets(): void
    {
        $event = Event::create([
            'name' => 'Ripple Effect 2026',
            'slug' => '2026',
            'status' => 'published', // Not registration_open yet
        ]);

        $response = $this->post('/tscc/2026/register', [
            'first_name' => 'Bob',
            'last_name' => 'Johnson',
            'email' => 'bob@example.com',
        ]);

        // Assert registration exists as waitlisted with free payment
        $reg = EventRegistration::first();
        $this->assertNotNull($reg);
        $this->assertEquals('free', $reg->payment_status);
        $this->assertEquals('waitlisted', $reg->status);

        $response->assertRedirect(route('event.confirm', ['year' => '2026', 'token' => $reg->qr_token]));
    }
}
