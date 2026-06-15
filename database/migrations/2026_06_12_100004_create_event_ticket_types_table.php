<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('event_ticket_types', function (Blueprint $table) {
            $table->id();
            $table->foreignId('event_id')->constrained('events')->cascadeOnDelete();
            $table->string('name');
            $table->text('description')->nullable();
            $table->decimal('price', 10, 2)->default(0);
            $table->string('currency', 3)->default('NGN');
            $table->integer('quantity_available')->nullable(); // null = unlimited
            $table->integer('quantity_sold')->default(0);
            $table->datetime('sales_start')->nullable();
            $table->datetime('sales_end')->nullable();
            $table->enum('access_type', ['public', 'invite_only'])->default('public');
            $table->json('benefits')->nullable(); // array of strings
            $table->boolean('is_active')->default(true);
            $table->integer('display_order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('event_ticket_types');
    }
};
