<?php

namespace App\Jobs;

use App\Enums\UserType;
use App\Models\Holiday;
use App\Models\User;
use App\Notifications\HolidayNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendHolidayNotifications implements ShouldQueue
{
    use Queueable, Dispatchable, SerializesModels, InteractsWithQueue;

    /**
     * Create a new job instance.
     */
    public function __construct(public Holiday $holiday)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        User::whereIn('type', [UserType::EMPLOYEE, UserType::CLIENT])->chunk(200, function ($users) {
            foreach ($users as $user) {
                $user->notify(new HolidayNotification($this->holiday));
            }
        });
    }
}
