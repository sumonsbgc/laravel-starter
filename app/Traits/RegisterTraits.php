<?php

namespace App\Traits;

use App\Events\EmailVerified;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

trait RegisterTraits
{

    public function validateRegisterData(array $data){

        return Validator::make($data, [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

    }

    public function createUser(array $data, string $role){

        if (!empty($data) && is_array($data)){

            $data['name'] = $data['first_name'].' '.$data['last_name'];
            $data['user_name'] = !empty($data['email']) ? explode("@", $data['email'])[0] : '';
            $data['last_login_ip'] = request()->ip();
            $data['password'] = Hash::make($data['password']);
            $user = User::create($data);

            $role = Role::where('nickname', $role)->first('id');
            $user->roles()->attach($role->id);
            return $user;
        }

    }

    public function register_user(Request $request){

        $this->validator($request->all())->validate();

        $urls = explode("/", ltrim($request->getPathInfo(), "/"));
        $guard = array_shift($urls);

        event(new EmailVerified($user = $this->create($request->all()), $guard ));

        if ($response = $this->registered($request, $user)) {
            return $response;
        }

        return $request->wantsJson()
            ? new JsonResponse([], 201)
            : redirect($this->redirectPath());


    }


}
