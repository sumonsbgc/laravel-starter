<?php

namespace App\Http\Controllers\Auth\Courier;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Traits\UserLoginTraits;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers, UserLoginTraits;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::COURIER_DASHBOARD;
    protected $loginRedirectTo = RouteServiceProvider::COURIER_LOGIN;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:courier')->except('logout');
    }

    public function showLoginForm()
    {
        return view('auth.courier.login');
    }

    public function logout(Request $request)
    {
        return $this->userLogout($request);
    }

    protected function guard()
    {
        return Auth::guard('courier');
    }


}
