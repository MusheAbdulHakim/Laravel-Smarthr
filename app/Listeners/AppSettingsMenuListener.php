<?php

namespace App\Listeners;

use App\Events\AppSettingsMenuEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

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
            ->addSettingsMenu(
                [
                    'label' => __("Back to Dashboard"),
                    'icon' => 'dashboard',
                    'order' => 1,
                    'route' => 'dashboard'
                ],
            )->addSettingsMenu([
                'label' =>  __("Company Settings"),
                'icon' => 'building',
                'order' => 2,
                'route' => 'settings.index',
            ])->addSettingsMenu([
                'label' => __("Localization"),
                'route' => 'settings.locale',
                'order' => 3,
                'icon' => 'clock-o',
            ])
            ->addSettingsMenu([
                'label' => __("Invoice Settings"),
                'route' => 'settings.invoice',
                'order' => 4,
                'icon' => 'pencil-square',
            ])
            ->addSettingsMenu([
                'label' => __("Salary Settings"),
                'route' => 'settings.salary',
                'order' => 5,
                'icon' => 'money',
            ])
            ->addSettingsMenu([
                'label' => __("Theme Settings"),
                'route' => 'settings.theme',
                'order' => 6,
                'icon' => 'photo',
            ])
            ->addSettingsMenu([
                'label' => __("App Logs"),
                'route' => 'app.logs',
                'order' => 7,
                'icon' => 'warning',
            ]);
    }
}
