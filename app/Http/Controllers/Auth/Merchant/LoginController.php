<?php

namespace App\Http\Controllers\Auth\Merchant;

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

    protected $redirectTo = RouteServiceProvider::MERCHANT_DASHBOARD;
    protected $loginRedirectTo = RouteServiceProvider::MERCHANT_LOGIN;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:merchant')->except('logout');
    }

    public function showLoginForm()
    {
        return view('auth.merchant.login');
    }

    public function logout(Request $request)
    {
        return $this->userLogout($request);
    }

    protected function guard()
    {
        return Auth::guard('merchant');
    }
}
