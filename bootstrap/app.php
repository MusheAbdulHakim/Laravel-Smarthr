<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use LaravelLang\Routes\Middlewares\LocalizationByCookie;
use LaravelLang\Routes\Middlewares\LocalizationByHeader;
use LaravelLang\Routes\Middlewares\LocalizationByModel;
use LaravelLang\Routes\Middlewares\LocalizationByParameter;
use LaravelLang\Routes\Middlewares\LocalizationByParameterWithRedirect;
use LaravelLang\Routes\Middlewares\LocalizationBySession;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
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
