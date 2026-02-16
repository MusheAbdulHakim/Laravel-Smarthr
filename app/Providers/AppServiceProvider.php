<?php

namespace App\Providers;

use App\Services\MenuService;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\View;
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
        Gate::before(function ($user, $ability) {
            return $user->hasRole('Super Admin') ? true : null;
        });
        Event::listen(static function (LocaleHasBeenSetEvent $event) {
            $lang = $event->locale->code;
            Log::info('Locale set to: '.$lang);
        });
        View::composer('partials.sidebar', function ($view) {
            $view->with('menuItems', (new MenuService)->getMenu());
        });
        View::composer('pages.settings.index', function ($view) {
            $view->with('menuItems', (new MenuService)->renderSettingsMenu());
        });
    }
}
