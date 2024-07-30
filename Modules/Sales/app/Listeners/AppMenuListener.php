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
        if(auth()->user()->canAny(['view-taxes','view-expenses','view-estimates','view-invoices'])){

            $activeClass = route_is(["taxes.*","expenses.*","estimates.*","invoices.*"]) ? "active" : "";
            $menu
                ->submenu(
                    Html::raw('<a href="#" class="' . $activeClass . '"><i class="la la-files-o"></i><span> ' . __("Sales") . '</span><span class="menu-arrow"></span></a>'),
                    Menu::new()
                        ->addIfCan('view-taxes',
                            Link::toRoute('taxes.index', __('Taxes'))->addClass(route_is(['taxes.*']) ? 'active' : ''),
                        )
                        ->addIfCan('view-expenses',
                            Link::toRoute('expenses.index', __('Expenses'))->addClass(route_is(['expenses.*']) ? 'active' : ''),
                        )
                        ->addIfCan('view-estimates',
                            Link::toRoute('estimates.index', __('Estimates'))->addClass(route_is(['estimates.*']) ? 'active' : ''),
                        )
                        ->addIfCan('view-invoices',
                            Link::toRoute('invoices.index', __('Invoices'))->addClass(route_is(['invoices.*']) ? 'active' : ''),
                        )
                        ->addParentClass('submenu')
                );
        }
    }
}
