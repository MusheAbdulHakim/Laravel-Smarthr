<?php

namespace App\Services;

use App\Events\AppMenuEvent;
use Illuminate\Support\Facades\Auth;

class MenuService
{
    public function build(array $items): array
    {
        $user = Auth::user();
        $menu = [];

        foreach ($items as $data) {

            if (isset($data['permission']) && ! $user->can($data['permission'])) {
                continue;
            }
            if (isset($data['permissions']) && ! $user->can($data['permissions'])) {
                continue;
            }

            $subMenuItems = [];
            if (isset($data['items'])) {
                $subMenuItems = $this->build($data['items']);
                if (count($subMenuItems) <= 0) {
                    continue;
                }
            }

            $menu[] = new \App\DTO\MenuItemDto(
                label: $data['label'],
                route: $data['route'] ?? null,
                icon: $data['icon'] ?? null,
                title: $data['title'] ?? null,
                order: $data['order'] ?? 0,
                items: $subMenuItems,
                visible: $data['visible'] ?? true
            );
        }
        usort($menu, fn ($a, $b) => $a->getOrder() <=> $b->getOrder());

        return $menu;
    }

    public function getFilteredMenu(array $items)
    {
        return collect($items)
            ->filter(fn (\App\DTO\MenuItemDto $item) => $item->isVisible())
            ->sortBy(fn ($item) => $item->getOrder());
    }

    public function getMenu()
    {
        $appMenu = new \App\Helpers\AppMenu;
        event(new AppMenuEvent($appMenu));

        return $this->build($appMenu->all());
    }

    public function renderSettingsMenu()
    {
        $appMenu = new \App\Helpers\AppMenu;
        event(new \App\Events\AppSettingsMenuEvent($appMenu));

        return $this->build($appMenu->getSettingsMenu());
    }
}
