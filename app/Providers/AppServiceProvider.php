<?php

namespace App\Providers;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Vite;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;
use LaravelLang\Routes\Events\LocaleHasBeenSetEvent;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Event::listen(static function (LocaleHasBeenSetEvent $event) {
            $lang = $event->locale->code;
            Log::info('Locale set to: ' . $lang);
        });
    }
}
