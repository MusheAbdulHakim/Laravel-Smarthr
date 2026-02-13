<?php

use Illuminate\Foundation\Application;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use LaravelLang\Routes\Middlewares\LocalizationByModel;
use LaravelLang\Routes\Middlewares\LocalizationByCookie;
use LaravelLang\Routes\Middlewares\LocalizationByHeader;
use LaravelLang\Routes\Middlewares\LocalizationBySession;
use LaravelLang\Routes\Middlewares\LocalizationByParameter;
use LaravelLang\Routes\Middlewares\LocalizationByParameterWithRedirect;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        channels: __DIR__ . '/../routes/channels.php',
        health: '/up',
    )
    ->withSchedule(function (Schedule $schedule) {
        $schedule->command('queue:work --stop-when-empty')
            ->everyMinute();
    })
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'localization.parameter' => LocalizationByParameter::class,
            'localization.redirect'  => LocalizationByParameterWithRedirect::class,
            'localization.header'    => LocalizationByHeader::class,
            'localization.cookie'    => LocalizationByCookie::class,
            'localization.session'   => LocalizationBySession::class,
            'localization.model'     => LocalizationByModel::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
