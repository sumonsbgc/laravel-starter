<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;

class IsVerifiedEmail
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $guard = null)
    {
        if (!$request->user() || ($request->user() instanceof MustVerifyEmail && !$request->user()->hasVerifiedEmail())) {
            if ($request->expectsJson()) {
                return abort(403, 'Your email address is not verified.');
            } else {

                if(!empty($guard)){

                    $redirectTo = '';

                    switch ($guard) {
                        case 'admin':
                            $redirectTo = RouteServiceProvider::ADMIN_VERIFICATION_NOTICE;
                        break;
                        case 'importer':
                            $redirectTo = RouteServiceProvider::IMPORTER_VERIFICATION_NOTICE;
                        break;
                        case 'merchant':
                            $redirectTo = RouteServiceProvider::MERCHANT_VERIFICATION_NOTICE;
                        break;
                        case 'courier':
                            $redirectTo = RouteServiceProvider::COURIER_VERIFICATION_NOTICE;
                        break;
                        case 'employee':
                            $redirectTo = RouteServiceProvider::EMPLOYEE_VERIFICATION_NOTICE;
                        break;
                    }

                    return redirect($redirectTo);

                }
            }
        }

        return $next($request);
    }
}
