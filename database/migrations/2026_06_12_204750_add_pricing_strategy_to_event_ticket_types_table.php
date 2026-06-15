<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('event_ticket_types', function (Blueprint $table) {
            $table->string('pricing_strategy')->default('standard');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('event_ticket_types', function (Blueprint $table) {
            $table->dropColumn('pricing_strategy');
        });
    }
};
