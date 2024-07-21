<?php

namespace Modules\Sales\Listeners;

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
        $menu = $event->menu;
        $activeClass = route_is(["taxes.*",]) ? "active" : "";
        $menu
            ->submenu(
                Html::raw('<a href="#" class="' . $activeClass . '"><i class="la la-rocket"></i><span> ' . __("Sales") . '</span><span class="menu-arrow"></span></a>'),
                Menu::new()
                    ->add(
                        Link::toRoute('taxes.index', __('Taxes'))->addClass(route_is(['taxes.*']) ? 'active' : ''),
                    )
                    ->addParentClass('submenu')
            );
    }
}
