<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('event_email_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('event_id')->constrained('events')->cascadeOnDelete();
            $table->foreignId('registration_id')->nullable()->constrained('event_registrations')->nullOnDelete();
            $table->string('template'); // confirmation, reminder_30d, reminder_7d, reminder_1d, thank_you
            $table->string('recipient_email');
            $table->string('recipient_name')->nullable();
            $table->enum('status', ['sent', 'failed'])->default('sent');
            $table->text('error_message')->nullable();
            $table->timestamp('sent_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('event_email_logs');
    }
};
