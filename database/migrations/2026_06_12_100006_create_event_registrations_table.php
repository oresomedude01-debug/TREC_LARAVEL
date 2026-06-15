<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('event_registrations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('event_id')->constrained('events')->cascadeOnDelete();
            $table->foreignId('ticket_type_id')->nullable()->constrained('event_ticket_types')->nullOnDelete();
            $table->string('registration_number')->unique(); // e.g. TSCC26-000245
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email');
            $table->string('phone')->nullable();
            $table->string('organization')->nullable();
            $table->string('profession')->nullable();
            $table->json('custom_fields')->nullable();
            $table->enum('payment_status', ['pending', 'paid', 'free', 'refunded'])->default('pending');
            $table->decimal('amount_paid', 10, 2)->default(0);
            $table->string('qr_token')->unique(); // cryptographically signed
            $table->boolean('checked_in')->default(false);
            $table->datetime('checked_in_at')->nullable();
            $table->foreignId('checked_in_by')->nullable()->constrained('users')->nullOnDelete();
            $table->enum('status', ['confirmed', 'cancelled', 'waitlisted'])->default('confirmed');
            $table->string('utm_source')->nullable();
            $table->string('utm_medium')->nullable();
            $table->string('utm_campaign')->nullable();
            $table->string('ref_code')->nullable();
            $table->timestamps();

            $table->index(['event_id', 'email']);
            $table->index(['event_id', 'status']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('event_registrations');
    }
};
