<?php

namespace App\Listeners;

use App\Events\AppSettingsMenuEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Spatie\Menu\Laravel\Link;

class AppSettingsMenuListener
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
    public function handle(AppSettingsMenuEvent $event): void
    {
        $menu = $event->menu;
        $menu
            ->add(
                Link::toRoute('dashboard', '<i class="la la-dashboard"></i> <span>' . __("Back to Dashboard") . '</span>')->setActive(route_is('dashboard'))
            )->add(
                Link::toRoute('settings.index', '<i class="la la-building"></i> <span>' . ("Company Settings") . '</span>')->setActive(route_is('settings.index'))
            )
            ->add(
                Link::toRoute('settings.locale', '<i class="la la-clock-o"></i> <span>' . ("Localization") . '</span>')->setActive(route_is('settings.locale'))
            )
            ->add(
                Link::toRoute('settings.invoice', '<i class="la la-pencil-square"></i> <span>' . ("Invoice Settings") . '</span>')->setActive(route_is('settings.invoice'))
            )
            ->add(
                Link::toRoute('settings.salary', '<i class="la la-money"></i> <span>' . ("Salary Settings") . '</span>')->setActive(route_is('settings.salary'))
            )
            ->add(
                Link::toRoute('settings.theme', '<i class="la la-photo"></i> <span>' . ("Theme Settings") . '</span>')->setActive(route_is('settings.theme'))
            )
            ->add(
                Link::toRoute('app.logs', '<i class="la la-warning"></i> <span>' . ("App Logs") . '</span>')->setActive(route_is('app.logs'))
            )
            ;
    }
}
