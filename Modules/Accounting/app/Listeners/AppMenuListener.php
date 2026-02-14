<?php

namespace Modules\Accounting\Listeners;

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
        if (auth()->user()->canAny(['view-budgetCategories', 'view-budgets', 'view-budgetExpenses', 'view-budgetRevenues'])) {
            $menu = $event->menu;
            $activeClass = route_is(["budget.categories.*", "budgets.*", "budget.expenses.*", "budget.revenue.*"]) ? "active" : "";
            $menu
                ->add([
                    'icon' => 'files-o',
                    'label' => __("Accounting"),
                    'order' => 17,
                    'items' => [
                        [
                            'label' => __('Categories'),
                            'route' => 'budget.categories.index',
                            'permission' => 'view-budgetCategories',
                        ],
                        [
                            'label' => __('Budgets'),
                            'route' => 'budgets.index',
                            'permission' => 'view-budgets',
                        ],
                        [
                            'label' => __('Budget Expenses'),
                            'route' => 'budget.expense.index',
                            'permission' => 'view-budgetExpenses',
                        ],
                        [
                            'label' => __('Budget Revenue'),
                            'route' => 'budget.revenue.index',
                            'permission' => 'view-budgetRevenues',
                        ],
                    ],
                ]);
        }
    }
}
