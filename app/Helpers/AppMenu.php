<?php

namespace App\Helpers;

use Spatie\Menu\Laravel\Menu;

final class AppMenu
{
    public $menu;

    public $settingsMenu;

    public function get()
    {
        $this->menu = Menu::new()->addClass('sidebar-vertical');
        return $this->menu;
    }

    public function getSettingsMenu()
    {
        $this->settingsMenu = Menu::new();
        return $this->settingsMenu;
    }
}
