<?php

namespace Modules\Whiteboard\Listeners;

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

        if (auth()->user()->canAny(['view-tldraw', 'view-excalidraw'])) {
            $menu = $event->menu;
            $menu->add([
                'icon' => 'pencil',
                'title' => __('Drawing Apps'),
                'label' => __('Whiteboard'),
                'order' => 14,
                'items' => [
                    [
                        'label' => __('TlDraw App'),
                        'route' => 'tldraw.index',
                        'permission' => 'view-tldraw',
                    ],
                    [
                        'label' => __('ExcaliDraw'),
                        'route' => 'excalidraw.index',
                        'permission' => 'view-excalidraw',
                    ],
                ],
            ]);
        }
    }
}
