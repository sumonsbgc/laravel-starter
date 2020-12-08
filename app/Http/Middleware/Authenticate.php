<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
            $urls = explode("/", ltrim($request->getPathInfo(), "/"));
            $guard = array_shift($urls);

            switch ($guard){
                case 'admin': {
                    return route('admin.login');
                }
                case 'merchant': {
                    return route('merchant.login');
                }
                case 'importer': {
                    return route('importer.login');
                }
                case 'courier': {
                    return route('courier.login');
                }
                case 'employee': {
                    return route('employee.login');
                }
            }
        }
    }
}
