<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('event_ticket_types', function (Blueprint $table) {
            $table->decimal('strike_price', 10, 2)->nullable()->after('price')->comment('Original/regular price for strike-through display');
        });
    }

    public function down(): void
    {
        Schema::table('event_ticket_types', function (Blueprint $table) {
            $table->dropColumn('strike_price');
        });
    }
};
