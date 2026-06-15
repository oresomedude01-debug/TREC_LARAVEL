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
            $table->dropColumn('pricing_strategy');
            $table->string('type')->default('standard')->after('event_id');
            $table->unique(['event_id', 'type'], 'event_ticket_type_unique');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('event_ticket_types', function (Blueprint $table) {
            $table->dropUnique('event_ticket_type_unique');
            $table->dropColumn('type');
            $table->string('pricing_strategy')->default('standard');
        });
    }
};
