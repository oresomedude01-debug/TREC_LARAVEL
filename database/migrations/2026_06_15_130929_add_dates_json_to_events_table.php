<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('events', function (Blueprint $table) {
            $table->json('dates')->nullable()->after('end_time');
        });

        // Migrate existing dates
        DB::table('events')->whereNotNull('event_date')->chunkById(50, function ($events) {
            foreach ($events as $event) {
                // Determine if we need to add multiple distinct dates based on start and end date
                // For simplicity, if they just had start and end date, we can populate one or two dates.
                // Wait, if it was a range (e.g. Nov 12 to Nov 14), we could generate each day.
                // But let's just keep it simple: insert one object representing the first date
                $datesArray = [];
                $startDate = \Carbon\Carbon::parse($event->event_date);
                
                if ($event->end_date && $event->end_date !== $event->event_date) {
                    $endDate = \Carbon\Carbon::parse($event->end_date);
                    // generate dates for each day in range
                    while ($startDate->lte($endDate)) {
                        $datesArray[] = [
                            'date' => $startDate->format('Y-m-d'),
                            'start_time' => $event->start_time,
                            'end_time' => $event->end_time,
                        ];
                        $startDate->addDay();
                    }
                } else {
                    $datesArray[] = [
                        'date' => $startDate->format('Y-m-d'),
                        'start_time' => $event->start_time,
                        'end_time' => $event->end_time,
                    ];
                }

                DB::table('events')->where('id', $event->id)->update([
                    'dates' => json_encode($datesArray),
                ]);
            }
        });
    }

    public function down(): void
    {
        Schema::table('events', function (Blueprint $table) {
            $table->dropColumn('dates');
        });
    }
};
