<?php

namespace App\Console\Commands;

use App\Models\Holiday;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;

class CheckUpcomingHolidays extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'holidays:check-approaching';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check for holidays starting in 3 days and dispatch notifications';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $targetDate = Carbon::now()->addDays(3)->format('Y-m-d');

        $holidays = Holiday::whereDate('startDate', $targetDate)->get();

        foreach ($holidays as $holiday) {
            \App\Jobs\SendHolidayNotifications::dispatch($holiday);
            $this->info("Dispatched notifications for: {$holiday->name}");
        }
    }
}
