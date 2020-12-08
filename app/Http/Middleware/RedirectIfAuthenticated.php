<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  ...$guards
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$guards)
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                switch ($guard){
                    case 'admin':{
                        return redirect(RouteServiceProvider::ADMIN_DASHBOARD);
                    }
                    case 'merchant': {
                        return redirect(RouteServiceProvider::MERCHANT_DASHBOARD);
                    }
                    case 'importer':{
                        return redirect(RouteServiceProvider::IMPORTER_DASHBOARD);
                    }
                    case 'courier':{
                        return redirect(RouteServiceProvider::COURIER_DASHBOARD);
                    }
                    case 'employee':{
                        return redirect(RouteServiceProvider::EMPLOYEE_DASHBOARD);
                    }
                }
            }
        }

        return $next($request);
    }
}
