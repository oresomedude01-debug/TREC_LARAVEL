<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('events', function (Blueprint $table) {
            $table->json('venues')->nullable()->after('google_maps_url');
        });

        // Migrate existing single-venue rows into the new JSON column
        DB::table('events')->whereNotNull('venue_name')->chunkById(50, function ($events) {
            foreach ($events as $event) {
                DB::table('events')->where('id', $event->id)->update([
                    'venues' => json_encode([[
                        'name'     => $event->venue_name,
                        'address'  => $event->venue_address,
                        'maps_url' => $event->google_maps_url,
                    ]]),
                ]);
            }
        });
    }

    public function down(): void
    {
        Schema::table('events', function (Blueprint $table) {
            $table->dropColumn('venues');
        });
    }
};
