<?php

namespace App\Jobs;

use App\Models\AttendanceTimestamp;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class AutoClockoutUnsignedAttendances implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $timestamps = AttendanceTimestamp::whereNotNull('attendance_id')
            ->whereNull('endTime')
            ->get();
        
        foreach($timestamps as $timestamp){
            $timestamp->update([
                'endTime' => now(),
            ]);
            $timestamp->attendance->update([
                'endDate' => now(),
            ]);
        }
    }
}
