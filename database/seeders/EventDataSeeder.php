<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\EventTicketType;
use App\Models\EventRegistration;
use App\Models\EventSpeaker;
use App\Models\EventSession;
use App\Models\EventSponsor;
use App\Models\Setting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EventDataSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create settings
        Setting::updateOrCreate(['key' => 'paystack_enabled'], ['value' => '1']);
        Setting::updateOrCreate(['key' => 'paystack_public_key'], ['value' => 'pk_test_xxx']);
        Setting::updateOrCreate(['key' => 'paystack_secret_key'], ['value' => 'sk_test_xxx']);
        Setting::updateOrCreate(['key' => 'email_from_address'], ['value' => 'events@trec.com']);
        Setting::updateOrCreate(['key' => 'email_from_name'], ['value' => 'TREC Events']);

        // Create Event 1: TSCC 2026 (Published, Registration Open)
        $tscc = Event::create([
            'name' => 'TSCC 2026 - The Counselling Conference',
            'theme' => 'Building Resilience in Uncertain Times',
            'slug' => '2026',
            'status' => 'registration_open',
            'short_description' => 'Join hundreds of counselling professionals for three days of learning, networking, and growth.',
            'full_description' => 'The Training and Support Centre for Counsellors (TSCC) Annual Conference brings together school counsellors, private practitioners, educators, and mental health advocates for a transformative three-day experience. This year\'s theme, "Building Resilience in Uncertain Times," addresses the pressing mental health challenges facing today\'s young people.',
            'objectives' => json_encode([
                'Share evidence-based practices in school counselling',
                'Explore emerging trends in adolescent mental health',
                'Build professional networks and collaborate',
                'Develop skills in digital counselling and mental health tech',
            ]),
            'target_audience' => 'School counsellors, mental health professionals, educators, and counselling practitioners',
            'venue_name' => 'Eko Hotels & Suites',
            'venue_address' => '1435 Adetokunbo Ademola Street, Victoria Island, Lagos, Nigeria',
            'google_maps_url' => 'https://maps.google.com/?q=Eko+Hotels+Lagos',
            'event_date' => now()->addMonths(3)->format('Y-m-d'),
            'start_time' => '08:00:00',
            'end_time' => '17:00:00',
            'banner_image' => '/storage/events/tscc-banner.jpg',
            'logo_image' => '/storage/events/tscc-logo.png',
        ]);

        // Create Event 2: Parenting Workshop (Published, Ticket Not On Sale)
        $parenting = Event::create([
            'name' => 'Modern Parenting in the Digital Age',
            'theme' => 'Raising emotionally intelligent children',
            'slug' => 'parenting-workshop-2026',
            'status' => 'published',
            'short_description' => 'A practical workshop for parents navigating screen time, social media, and emotional wellbeing.',
            'full_description' => 'This workshop equips parents with evidence-based strategies to support their children\'s emotional and social development in the digital age. Topics include screen time management, recognizing mental health concerns, and building resilience.',
            'objectives' => json_encode([
                'Understand digital age parenting challenges',
                'Learn effective communication strategies',
                'Identify signs of emotional distress in children',
                'Build action plans for family wellbeing',
            ]),
            'target_audience' => 'Parents, guardians, and educators interested in child development',
            'venue_name' => 'Civic Centre Lagos',
            'venue_address' => 'Ozumba Mbadiwe Avenue, Victoria Island, Lagos',
            'google_maps_url' => 'https://maps.google.com/?q=Civic+Centre+Lagos',
            'event_date' => now()->addMonths(2)->format('Y-m-d'),
            'start_time' => '09:30:00',
            'end_time' => '13:00:00',
            'banner_image' => '/storage/events/parenting-banner.jpg',
            'logo_image' => '/storage/events/parenting-logo.png',
        ]);

        // Create Event 3: School Wellbeing Training (Draft)
        $school = Event::create([
            'name' => 'School Wellbeing Coordinator Training',
            'theme' => 'Implementing holistic wellbeing programs',
            'slug' => 'school-wellbeing-training',
            'status' => 'draft',
            'short_description' => 'Comprehensive training for school coordinators implementing whole-school wellbeing initiatives.',
            'full_description' => 'This intensive training prepares school staff to develop, implement, and evaluate comprehensive school wellbeing programs that support student and staff mental health.',
            'objectives' => json_encode([
                'Develop school wellbeing policies',
                'Train staff on mental health first aid',
                'Create peer support systems',
                'Implement assessment and monitoring tools',
            ]),
            'target_audience' => 'School administrators, counsellors, and designated wellbeing coordinators',
            'venue_name' => 'TREC Training Centre',
            'venue_address' => '123 Counselling Way, Lagos',
            'event_date' => now()->addMonths(4)->format('Y-m-d'),
            'start_time' => '08:00:00',
            'end_time' => '16:00:00',
        ]);

        // Create Ticket Types for TSCC
        $earlyBird = EventTicketType::create([
            'event_id' => $tscc->id,
            'type' => 'early_bird',
            'team_size' => null,
            'name' => 'Early Bird (Limited)',
            'description' => 'Available until end of month',
            'price' => 15000,
            'currency' => 'NGN',
            'quantity_available' => 100,
            'quantity_sold' => 45,
            'sales_start' => now()->subWeeks(2),
            'sales_end' => now()->addDays(15),
            'access_type' => 'public',
            'benefits' => json_encode(['Full conference access', 'Welcome pack']),
            'is_active' => true,
            'display_order' => 1,
        ]);

        $regular = EventTicketType::create([
            'event_id' => $tscc->id,
            'type' => 'regular',
            'team_size' => null,
            'name' => 'Regular Ticket',
            'description' => 'Standard conference access',
            'price' => 20000,
            'currency' => 'NGN',
            'quantity_available' => 300,
            'quantity_sold' => 120,
            'sales_start' => now()->subWeeks(2),
            'sales_end' => now()->addMonths(2),
            'access_type' => 'public',
            'benefits' => json_encode(['Full conference access', 'Materials', 'Lunch & refreshments']),
            'is_active' => true,
            'display_order' => 2,
        ]);

        $vip = EventTicketType::create([
            'event_id' => $tscc->id,
            'type' => 'vip',
            'team_size' => null,
            'name' => 'VIP Access',
            'description' => 'Premium seating, networking dinner, materials package',
            'price' => 35000,
            'currency' => 'NGN',
            'quantity_available' => 50,
            'quantity_sold' => 18,
            'sales_start' => now()->subWeeks(2),
            'sales_end' => now()->addMonths(2),
            'access_type' => 'public',
            'benefits' => json_encode(['Premium seating', 'Private networking dinner', 'Exclusive materials', 'One-on-one mentoring']),
            'is_active' => true,
            'display_order' => 3,
        ]);

        // Create Ticket Types for Parenting Workshop
        $parentingTicket = EventTicketType::create([
            'event_id' => $parenting->id,
            'type' => 'standard',
            'team_size' => null,
            'name' => 'Standard Ticket',
            'description' => 'Full workshop access with materials',
            'price' => 5000,
            'currency' => 'NGN',
            'quantity_available' => 150,
            'quantity_sold' => 0,
            'sales_start' => now()->addDays(30),
            'sales_end' => now()->addMonths(2)->subDays(5),
            'access_type' => 'public',
            'benefits' => json_encode(['Full workshop access', 'Resource materials', 'Refreshments']),
            'is_active' => true,
            'display_order' => 1,
        ]);

        // Create Event Registrations for TSCC (Mixed Confirmed and Waitlisted)
        $registrations = [
            ['name' => 'Chinyere Okafor', 'email' => 'chinyere@example.com', 'phone' => '+2348012345678', 'ticket_type_id' => $earlyBird->id, 'status' => 'confirmed', 'payment_status' => 'paid', 'amount' => 15000],
            ['name' => 'Usman Adebayo', 'email' => 'usman@example.com', 'phone' => '+2348023456789', 'ticket_type_id' => $regular->id, 'status' => 'confirmed', 'payment_status' => 'paid', 'amount' => 20000],
            ['name' => 'Amara Igwe', 'email' => 'amara.igwe@example.com', 'phone' => '+2348034567890', 'ticket_type_id' => $regular->id, 'status' => 'confirmed', 'payment_status' => 'paid', 'amount' => 20000],
            ['name' => 'Tunde Okonkwo', 'email' => 'tunde.okonkwo@example.com', 'phone' => '+2348045678901', 'ticket_type_id' => $vip->id, 'status' => 'confirmed', 'payment_status' => 'paid', 'amount' => 35000],
            ['name' => 'Zainab Hassan', 'email' => 'zainab.h@example.com', 'phone' => '+2348056789012', 'ticket_type_id' => $regular->id, 'status' => 'confirmed', 'payment_status' => 'paid', 'amount' => 20000],
            ['name' => 'Chioma Eze', 'email' => 'chioma.eze@example.com', 'phone' => '+2348067890123', 'ticket_type_id' => $parentingTicket->id, 'status' => 'waitlisted', 'payment_status' => 'pending', 'amount' => 0],
            ['name' => 'Damola Adeyemi', 'email' => 'damola.a@example.com', 'phone' => '+2348078901234', 'ticket_type_id' => $parentingTicket->id, 'status' => 'waitlisted', 'payment_status' => 'pending', 'amount' => 0],
            ['name' => 'Ngozi Nwankwo', 'email' => 'ngozi.nw@example.com', 'phone' => '+2348089012345', 'ticket_type_id' => $parentingTicket->id, 'status' => 'waitlisted', 'payment_status' => 'pending', 'amount' => 0],
            ['name' => 'Emeka Obi', 'email' => 'emeka.obi@example.com', 'phone' => '+2348090123456', 'ticket_type_id' => $regular->id, 'status' => 'confirmed', 'payment_status' => 'paid', 'amount' => 20000],
            ['name' => 'Adekunle Bankole', 'email' => 'adekunle.b@example.com', 'phone' => '+2348101234567', 'ticket_type_id' => $earlyBird->id, 'status' => 'confirmed', 'payment_status' => 'paid', 'amount' => 15000],
        ];

        foreach ($registrations as $reg) {
            $registration = EventRegistration::create([
                'event_id' => $tscc->id,
                'ticket_type_id' => $reg['ticket_type_id'],
                'first_name' => explode(' ', $reg['name'])[0],
                'last_name' => implode(' ', array_slice(explode(' ', $reg['name']), 1)),
                'email' => $reg['email'],
                'phone' => $reg['phone'],
                'organization' => 'Sample Organization',
                'profession' => 'Counsellor',
                'status' => $reg['status'],
                'payment_status' => $reg['payment_status'],
                'amount_paid' => $reg['amount'],
                'registration_number' => 'TSCC26-' . str_pad($tscc->registrations()->count() + 1, 6, '0', STR_PAD_LEFT),
                'qr_token' => hash('sha256', $reg['email'] . now()),
            ]);

            if ($reg['status'] === 'waitlisted') {
                $registration->update(['waitlist_notified_at' => null]);
            }
        }

        // Create Event Speakers
        EventSpeaker::create([
            'event_id' => $tscc->id,
            'name' => 'Dr. Folake Ayinde',
            'title' => 'Clinical Psychologist & School Counsellor',
            'organization' => 'Lagos Counselling Centre',
            'biography' => 'Over 15 years of experience in adolescent mental health and school-based counselling.',
            'photo' => '/storage/speakers/folake.jpg',
            'is_featured' => true,
            'display_order' => 1,
        ]);

        EventSpeaker::create([
            'event_id' => $tscc->id,
            'name' => 'Prof. Chukwuemeka Okonkwo',
            'title' => 'Professor of Educational Psychology',
            'organization' => 'University of Lagos',
            'biography' => 'Leading researcher on resilience and emotional intelligence in African contexts.',
            'photo' => '/storage/speakers/chukwu.jpg',
            'is_featured' => true,
            'display_order' => 2,
        ]);

        EventSpeaker::create([
            'event_id' => $parenting->id,
            'name' => 'Mrs. Bola Olajide',
            'title' => 'Parenting Coach & Child Development Specialist',
            'organization' => 'Family Wellness Institute',
            'biography' => 'Certified parent coach specializing in digital age parenting challenges.',
            'photo' => '/storage/speakers/bola.jpg',
            'is_featured' => true,
            'display_order' => 1,
        ]);

        // Create Event Sessions/Programme
        EventSession::create([
            'event_id' => $tscc->id,
            'speaker_id' => 1,
            'title' => 'Opening Keynote: Mental Health in Schools - Where are we now?',
            'description' => 'An insightful keynote exploring the current state of mental health in schools and practical approaches to improving student wellbeing.',
            'session_date' => $tscc->event_date,
            'start_time' => '09:00:00',
            'end_time' => '10:30:00',
            'venue_room' => 'Main Hall',
            'category' => 'keynote',
            'track' => 'Main Conference',
            'display_order' => 1,
        ]);

        EventSession::create([
            'event_id' => $tscc->id,
            'speaker_id' => null,
            'title' => 'Panel Discussion: Digital Counselling Tools & Ethics',
            'description' => 'A panel of experts discussing the latest digital tools for counselling and the ethical considerations involved.',
            'session_date' => $tscc->event_date,
            'start_time' => '11:00:00',
            'end_time' => '12:30:00',
            'venue_room' => 'Main Hall',
            'category' => 'panel',
            'track' => 'Main Conference',
            'display_order' => 2,
        ]);

        EventSession::create([
            'event_id' => $tscc->id,
            'speaker_id' => 2,
            'title' => 'Workshop: Recognizing Anxiety Disorders in Students',
            'description' => 'An interactive workshop teaching counsellors how to identify and support students with anxiety disorders.',
            'session_date' => now()->addMonths(3)->addDays(1)->format('Y-m-d'),
            'start_time' => '09:00:00',
            'end_time' => '11:00:00',
            'venue_room' => 'Training Room A',
            'category' => 'workshop',
            'track' => 'Skills Development',
            'display_order' => 3,
        ]);

        // Create Event Sponsors
        EventSponsor::create([
            'event_id' => $tscc->id,
            'name' => 'Mental Health Foundation Nigeria',
            'logo' => '/storage/sponsors/mhfn.png',
            'website_url' => 'https://mhfn.ng',
            'tier' => 'platinum',
            'display_order' => 1,
        ]);

        EventSponsor::create([
            'event_id' => $tscc->id,
            'name' => 'Counselling Psychology Association',
            'logo' => '/storage/sponsors/cpa.png',
            'website_url' => 'https://cpa-ng.org',
            'tier' => 'gold',
            'display_order' => 2,
        ]);

        EventSponsor::create([
            'event_id' => $parenting->id,
            'name' => 'Child Development Institute',
            'logo' => '/storage/sponsors/cdi.png',
            'website_url' => 'https://cdi.ng',
            'tier' => 'platinum',
            'display_order' => 1,
        ]);
    }
}
