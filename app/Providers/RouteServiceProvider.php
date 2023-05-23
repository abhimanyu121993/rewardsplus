<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to your application's "home" route.
     *
     * Typically, users are redirected here after authentication.
     *
     * @var string
     */
    public const HOME = '/home';

    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     */
    public function boot(): void
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });

        $this->routes(function () {
            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('routes/api.php'));

                // admin route
            Route::middleware('web')->name('admin.')
            ->group(base_path('routes/admin.php'))->domain('admin.'. env('APP_URL'));
                 //company route
            Route::middleware('web')->name('company.')
                ->group(base_path('routes/company.php'))->domain('company.'. env('APP_URL'));
     
            // Employee route
            Route::middleware('web')->name('employee.')->prefix('employee')
            ->group(base_path('routes/employee.php'))->domain('employee.'. env('APP_URL'));

            Route::middleware('web')
                ->group(base_path('routes/web.php'));

         });
    }
}
