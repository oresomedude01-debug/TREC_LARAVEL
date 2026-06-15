<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('theme')->nullable();
            $table->string('slug')->unique(); // e.g. "2026" → /tscc/2026
            $table->enum('status', ['draft', 'published', 'registration_open', 'registration_closed', 'completed', 'archived'])->default('draft');
            $table->text('short_description')->nullable();
            $table->longText('full_description')->nullable();
            $table->json('objectives')->nullable(); // array of strings
            $table->text('target_audience')->nullable();
            $table->string('venue_name')->nullable();
            $table->text('venue_address')->nullable();
            $table->string('google_maps_url')->nullable();
            $table->date('event_date')->nullable();
            $table->time('start_time')->nullable();
            $table->time('end_time')->nullable();
            $table->string('banner_image')->nullable();
            $table->string('logo_image')->nullable();
            $table->string('social_share_image')->nullable();
            $table->string('email_header_image')->nullable();
            $table->json('registration_form_fields')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
