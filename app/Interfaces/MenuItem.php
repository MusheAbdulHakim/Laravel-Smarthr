<?php

namespace App\Interfaces;

interface MenuItem
{

    public function getLabel(): string;
    public function getLink(): ?string;
    public function getRoute(): ?string;
    public function getIcon(): ?string;
    public function getTitle(): ?string;
    public function getOrder(): int;
    public function getSubItems(): array | null;
    public function hasSubmenu(): bool;
    public function isVisible(): bool;
}
