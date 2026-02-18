<?php

use App\Jobs\AutoClockoutUnsignedAttendances;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Schedule::job(new AutoClockoutUnsignedAttendances)->cron('0 */8 * * *');
Schedule::command(\App\Console\Commands\CheckUpcomingHolidays::class)->daily();
