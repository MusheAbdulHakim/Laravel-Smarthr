<?php

namespace Modules\Sales\Providers;


use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Modules\Sales\Listeners\AppMenuListener;
use App\Events\AppMenuEvent;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event handler mappings for the application.
     *
     * @var array<string, array<int, string>>
     */
    protected $listen = [
        AppMenuEvent::class => [
            AppMenuListener::class,
        ]
    ];

    /**
     * Indicates if events should be discovered.
     *
     * @var bool
     */
    protected static $shouldDiscoverEvents = true;

}
