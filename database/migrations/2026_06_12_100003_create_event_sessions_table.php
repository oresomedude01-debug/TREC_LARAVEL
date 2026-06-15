<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('event_sessions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('event_id')->constrained('events')->cascadeOnDelete();
            $table->foreignId('speaker_id')->nullable()->constrained('event_speakers')->nullOnDelete();
            $table->string('title');
            $table->text('description')->nullable();
            $table->date('session_date')->nullable();
            $table->time('start_time')->nullable();
            $table->time('end_time')->nullable();
            $table->string('venue_room')->nullable();
            $table->enum('category', ['keynote', 'workshop', 'panel', 'networking', 'break', 'other'])->default('other');
            $table->string('track')->nullable();
            $table->integer('display_order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('event_sessions');
    }
};
