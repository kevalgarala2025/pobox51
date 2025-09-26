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
     * The path to the "home" route for your application.
     *
     * Typically, users are redirected here after authentication.
     */
    public const HOME = '/home';

    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     *
     * @return void
     */
    public function boot()
    {
        $this->configureRateLimiting();

        $this->routes(function () {
            Route::middleware('api')
                ->prefix('api')
                ->namespace($this->namespace)
                ->group(base_path('routes/api.php'));

            Route::middleware('web')
                ->group(base_path('routes/test.php'));

            Route::middleware('web')
                ->group(base_path('routes/web.php'));

            Route::prefix(PREFIX_SUPERADMIN)
                ->middleware(['web','cors'])
                ->namespace($this->namespace)
                ->group(base_path('routes/superadmin.php'));

            Route::prefix(PREFIX_USER)
                ->middleware(['web','cors'])
                ->namespace($this->namespace)
                ->group(base_path('routes/user.php'));

            Route::prefix(PREFIX_CRON)
                ->middleware(['web','cors'])
                ->namespace($this->namespace)
                ->group(base_path('routes/cron.php'));
        });
    }

    /**
     * Configure the rate limiters for the application.
     *
     * @return void
     */
    protected function configureRateLimiting()
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });
    }
}
