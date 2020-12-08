<?php


namespace App\Traits;


use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

trait VerificationTrait
{
    public function resendLink(Request $request){

        $urls = explode("/", ltrim($request->getPathInfo(), "/"));
        $guard = array_shift($urls);

        if ($request->user()->hasVerifiedEmail()) {
            return $request->wantsJson()
                ? new JsonResponse([], 204)
                : redirect($this->redirectPath());
        }

        $request->user()->sendEmailVerificationNotification($guard);

        return $request->wantsJson()
            ? new JsonResponse([], 202)
            : back()->with('resent', true);
    }

}
