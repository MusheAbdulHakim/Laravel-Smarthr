<?php

namespace App\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use RTippin\Messenger\Events\BroadcastFailedEvent;
use App\Events\RTippinMessengerEventsBroadcastFailedEvent;

class BroadcastError
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(BroadcastFailedEvent $event): void
    {
        //
    }
}
