<?php

namespace Modules\Project\Listeners;

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
        if (auth()->user()->canAny(['view-projects', 'view-taskboards'])) {
            $event->menu->add([
                'label' => __("Projects"),
                'icon' => 'rocket',
                'permissions' => ['view-projects', 'view-taskboards'],
                'order' => 13,
                'items' => [
                    [
                        'label' => __('Projects'),
                        'route' => 'projects.index',
                        'permission' => 'view-projects',
                    ],
                    [
                        'label' => __('Default TaskBoards'),
                        'route' => 'task-boards.index',
                        'permission' => 'view-taskboards'
                    ],
                ]
            ]);
        }
    }
}
