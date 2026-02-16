<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\HtmlString;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;

class MacrosServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        Blade::directive('employee', function () {
            return "<?php if(auth()->check() && auth()->user()->type === \App\Enums\UserType::EMPLOYEE): ?>";
        });

        Blade::directive('endemployee', function () {
            return '<?php endif; ?>';
        });

        Blade::directive('superadmin', function () {
            return "<?php if(auth()->check() && auth()->user()->type === \App\Enums\UserType::SUPERADMIN): ?>";
        });

        Blade::directive('endsuperadmin', function () {
            return '<?php endif; ?>';
        });

        Blade::directive('client', function () {
            return "<?php if(auth()->check() && auth()->user()->type === \App\Enums\UserType::CLIENT): ?>";
        });

        Blade::directive('endclient', function () {
            return '<?php endif; ?>';
        });

        Str::macro('userAvatar', function ($name, $src, $link = 'javascript:void(0)', $alt = '') {
            return new HtmlString(

                '<h2 class="table-avatar">
    <a href="'.$link.'" class="avatar">
        <img src="'.$src.'" alt="'.$alt.'">
    </a>
    <a href="'.$link.'"><span>'.htmlspecialchars($name).'</span></a>
</h2>'
            );
        });
    }
}
