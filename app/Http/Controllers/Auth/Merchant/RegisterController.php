<?php

namespace App\Http\Controllers\Auth\Merchant;

use Illuminate\Http\Request;
use App\Traits\RegisterTraits;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers, RegisterTraits;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */

    protected $redirectTo = RouteServiceProvider::MERCHANT_LOGIN;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:merchant');
    }

    public function showRegistrationForm()
    {
        return view("auth.merchant.register");
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return $this->validateRegisterData($data);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        return $this->createUser($data, 'merchant');
    }

    protected function guard()
    {
        return Auth::guard('merchant');
    }

    public function register(Request $request)
    {
        return $this->register_user($request);
    }
}
