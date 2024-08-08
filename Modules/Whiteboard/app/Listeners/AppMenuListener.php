<?php

namespace Modules\Whiteboard\Listeners;

use App\Events\AppMenuEvent;
use Spatie\Menu\Laravel\Html;
use Spatie\Menu\Laravel\Link;
use Spatie\Menu\Laravel\Menu;

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
        
        if(auth()->user()->canAny(['view-tldraw','view-excalidraw'])){
            $menu = $event->menu;
            $menu->html('<span>'.__('Drawing Apps').'</span>', ['class' => 'menu-title']);
            $activeClass = route_is(['tldraw.index','excalidraw.index']) ? "active" : "";
            $menu->submenu(
                Html::raw('<a href="#" class="' . $activeClass . '"><i class="la la-pencil"></i><span> ' . __("Whiteboard") . '</span><span class="menu-arrow"></span></a>'),
                Menu::new()
                    ->addParentClass('submenu')
                    ->addIfCan('view-tldraw',Link::toRoute('tldraw.index', __('TlDraw App'))->addClass(route_is('tldraw.index') ? 'active' : ''))
                    ->addIfCan('view-excalidraw',Link::toRoute('excalidraw.index', __('ExcaliDraw'))->addClass(route_is('excalidraw.index') ? 'active' : ''))
            );

        }

    }
}
