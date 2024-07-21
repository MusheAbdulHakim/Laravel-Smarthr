<?php

namespace Modules\Project\Listeners;

use App\Events\AppMenuEvent;
use Spatie\Menu\Laravel\Html;
use Spatie\Menu\Laravel\Link;
use Spatie\Menu\Laravel\Menu;


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
        $activeClass = route_is(["projects.*","task-boards.*"]) ? "active" : "";
        $menu
            ->submenu(
                Html::raw('<a href="#" class="' . $activeClass . '"><i class="la la-rocket"></i><span> ' . __("Projects") . '</span><span class="menu-arrow"></span></a>'),
                Menu::new()
                    ->add(
                        Link::toRoute('projects.index', __('Projects'))->addClass(route_is(['projects.*']) ? 'active' : ''),
                    )->add(
                        Link::toRoute('task-boards.index', __('Default TaskBoards'))->addClass(route_is(['task-boards.index']) ? 'active' : '')
                    )
                    ->addParentClass('submenu')
            );
    }
}
