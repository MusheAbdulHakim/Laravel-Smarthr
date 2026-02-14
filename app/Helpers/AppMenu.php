<?php

namespace App\Helpers;


final class AppMenu
{
    public array $settingsMenu = [];

    protected array $items = [];

    /**
     * Add Menu item to sidebar
     *
     * @param array $item
     * @return void
     */
    public function add(array $item): void
    {
        $this->items[] = $item;
    }

    /**
     * Get Sidebar Menu items
     * @return array
     */
    public function all(): array
    {
        return $this->items;
    }


    /**
     * Add Item to Settings Sidebar
     * @param array $item
     * @return static
     */
    public function addSettingsMenu(array $item)
    {
        $this->settingsMenu[] = $item;
        return $this;
    }

    /**
     * Get Settings Sidebar Menu Items
     * @return array
     */
    public function getSettingsMenu()
    {
        return $this->settingsMenu;
    }
}
