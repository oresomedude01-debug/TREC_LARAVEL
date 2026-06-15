<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('event_certificates', function (Blueprint $table) {
            $table->id();
            $table->foreignId('event_id')->constrained('events')->cascadeOnDelete();
            $table->foreignId('registration_id')->constrained('event_registrations')->cascadeOnDelete();
            $table->string('certificate_number')->unique();
            $table->timestamp('issued_at')->nullable();
            $table->string('download_token')->unique();
            $table->string('template_path')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('event_certificates');
    }
};
