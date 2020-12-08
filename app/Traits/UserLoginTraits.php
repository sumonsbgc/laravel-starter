<?php


namespace App\Traits;


use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

trait UserLoginTraits
{
    public function userLogout(Request $request)
    {

        $this->guard()->logout();

        $request->session()->regenerateToken();

        if ($response = $this->loggedOut($request)) {
            return $response;
        }

        if ($request->wantsJson()) {
            return new JsonResponse([], 204);
        }

        return redirect($this->loginRedirectTo);
    }
}
