<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{

    public const HOME = "/user/dashboard";
    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        Route::middleware('web')
            ->group(base_path('routes/web.php'));

        Route::middleware(['web', 'auth', \App\Http\Middleware\RoleMiddleware::class . ':admin'])
            ->prefix('admin')
            ->as('admin.')
            ->group(base_path('routes/admin.php'));

        Route::middleware(['web', 'auth', \App\Http\Middleware\RoleMiddleware::class . ':vendor'])
            ->prefix('vendor')
            ->as('vendor.')
            ->group(base_path('routes/vendor.php'));
    }

    protected $middlewareGroups = [
        'web' => [
            \App\Http\Middleware\SetLocale::class,
        ],
    ];
}
