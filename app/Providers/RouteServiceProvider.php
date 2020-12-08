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
     * The path to the "dashboard" route for your application.
     *
     * This is used by Laravel authentication to redirect users after login.
     *
     * @var string
     */

    public const ADMIN_DASHBOARD    = '/admin/dashboard';
    public const COURIER_DASHBOARD  = '/courier/dashboard';
    public const IMPORTER_DASHBOARD = '/importer/dashboard';
    public const MERCHANT_DASHBOARD = '/merchant/dashboard';
    public const EMPLOYEE_DASHBOARD = '/employee/dashboard';

    /**
     * The path to the "login" route for your application.
     *
     * This is used by Laravel authentication to redirect users after logout.
     *
     * @var string
     */

    public const ADMIN_LOGIN    = '/admin/login';
    public const COURIER_LOGIN  = '/courier/login';
    public const IMPORTER_LOGIN = '/importer/login';
    public const MERCHANT_LOGIN = '/merchant/login';
    public const EMPLOYEE_LOGIN = '/employee/login';

        /**
     * The path to the "Verification Notice" route for your application.
     *
     * This is used by Laravel Email Verification to redirect users after logout.
     *
     * @var string
     */

    public const ADMIN_VERIFICATION_NOTICE    = '/admin/email/verify';
    public const COURIER_VERIFICATION_NOTICE  = '/courier/email/verify';
    public const IMPORTER_VERIFICATION_NOTICE = '/importer/email/verify';
    public const MERCHANT_VERIFICATION_NOTICE = '/merchant/email/verify';
    public const EMPLOYEE_VERIFICATION_NOTICE = '/employee/email/verify';

    /**
     * The controller namespace for the application.
     *
     * When present, controller route declarations will automatically be prefixed with this namespace.
     *
     * @var string|null
     */

    // protected $namespace = 'App\\Http\\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        $this->configureRateLimiting();

        $this->routes(function () {
            Route::prefix('api')
                ->middleware('api')
                ->namespace($this->namespace)
                ->group(base_path('routes/api.php'));

            Route::middleware('web')
                ->namespace($this->namespace)
                ->group(base_path('routes/web.php'));
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
            return Limit::perMinute(60)->by(optional($request->user())->id ?: $request->ip());
        });
    }
}
