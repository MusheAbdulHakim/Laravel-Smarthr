<?php

namespace App\Listeners;

use App\Enums\UserType;
use App\Events\AppMenuEvent;

class AppMenuListener
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
    public function handle(AppMenuEvent $event): void
    {
        $menu = config('menu');
        foreach ($menu as $item) {
            $event->menu->add($item);
        }
    }
}
