<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('event_marketing_campaigns', function (Blueprint $table) {
            $table->id();
            $table->foreignId('event_id')->constrained('events')->cascadeOnDelete();
            $table->string('name');
            $table->enum('channel', ['facebook', 'instagram', 'linkedin', 'whatsapp', 'email', 'direct', 'other'])->default('other');
            $table->string('utm_source')->nullable();
            $table->string('utm_medium')->nullable();
            $table->string('utm_campaign')->nullable();
            $table->string('ref_code')->unique()->nullable();
            $table->integer('clicks')->default(0);
            $table->integer('registrations')->default(0);
            $table->decimal('revenue', 10, 2)->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('event_marketing_campaigns');
    }
};
