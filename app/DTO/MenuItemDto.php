<?php

namespace App\DTO;

use App\Interfaces\MenuItem;

readonly class MenuItemDto implements MenuItem
{
    public string $label;

    public ?string $icon;

    public ?string $route;

    public ?string $title;

    public int $order;

    public ?array $items;

    public bool $visible;

    public function __construct(
        $label,
        ?string $route = null,
        ?string $icon = null,
        ?string $title = null,
        ?int $order = 0,
        ?array $items = [],
        bool $visible = true,
    ) {
        $this->label = $label;
        $this->route = $route;
        $this->icon = $icon;
        $this->title = $title;
        $this->order = $order;
        $this->items = $items;
        $this->visible = $visible;
    }

    public function getLabel(): string
    {
        return $this->label;
    }

    public function getRoute(): ?string
    {
        return $this->route;
    }

    public function getLink(): ?string
    {
        return $this->route ? route($this->route) : '#';
    }

    public function getIcon(): ?string
    {
        return $this->icon;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function getOrder(): int
    {
        return $this->order;
    }

    public function getSubMenu(): ?array
    {
        return $this->items;
    }

    public function getSubItems(): ?array
    {
        return $this->items;
    }

    public function hasSubmenu(): bool
    {
        return ! empty($this->items);
    }

    public function isVisible(): bool
    {
        return $this->visible;
    }
}
