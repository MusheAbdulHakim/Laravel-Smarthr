<?php

namespace Modules\Sales\Listeners;

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
        if (auth()->user()->canAny(['view-taxes', 'view-expenses', 'view-estimates', 'view-invoices'])) {
            $menu->add([
                'label' => __('Sales'),
                'icon' => 'files-o',
                'order' => 15,
                'items' => [
                    [
                        'label' => __('Taxes'),
                        'permission' => 'view-taxes',
                        'route' => 'taxes.index',
                    ],
                    [
                        'label' => __('Expenses'),
                        'permission' => 'view-expenses',
                        'route' => 'expenses.index',
                    ],
                    [
                        'label' => __('Estimates'),
                        'permission' => 'view-estimates',
                        'route' => 'estimates.index',
                    ],
                    [
                        'label' => __('Invoices'),
                        'permission' => 'view-invoices',
                        'route' => 'invoices.index',
                    ],
                ],
            ]);
        }
    }
}
