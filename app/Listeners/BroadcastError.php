<?php

namespace App\Listeners;

use RTippin\Messenger\Events\BroadcastFailedEvent;

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
