<?php

namespace Modules\Roles\Listeners;

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
        $menu = $event->menu;
        $menu->add([
            'permission' => 'view-roles',
            'route' => 'roles.index',
            'icon' => 'key',
            'order' => 12,
            'label' => __('Roles & Permissions'),
        ]);
    }
}
