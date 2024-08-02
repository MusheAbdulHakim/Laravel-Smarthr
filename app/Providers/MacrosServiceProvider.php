<?php

namespace App\Providers;

use App\Models\User;
use Spatie\Menu\Laravel\Html;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

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
        
        Html::macro('userAvatar', function ($name, $src, $link = 'javascript:void(0)', $alt = '') {
            return Html::raw(
                '<h2 class="table-avatar">
                    <a href="'.$link.'" class="avatar">
                        <img src="'.$src.'" alt="'.$alt.'">
                    </a>
                    <a href="'.$link.'"><span>'.$name.'</span></a>
                </h2>'
            )->render();
        });
    }
}
