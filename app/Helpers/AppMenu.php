<?php

namespace App\Helpers;

final class AppMenu
{
    public array $settingsMenu = [];

    protected array $items = [];

    /**
     * Add Menu item to sidebar
     */
    public function add(array $item): void
    {
        $this->items[] = $item;
    }

    /**
     * Get Sidebar Menu items
     */
    public function all(): array
    {
        return $this->items;
    }

    /**
     * Add Item to Settings Sidebar
     *
     * @return static
     */
    public function addSettingsMenu(array $item)
    {
        $this->settingsMenu[] = $item;

        return $this;
    }

    /**
     * Get Settings Sidebar Menu Items
     *
     * @return array
     */
    public function getSettingsMenu()
    {
        return $this->settingsMenu;
    }
}
