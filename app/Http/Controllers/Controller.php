<?php

namespace App\Http\Controllers;

use App\Traits\FlashMessages;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests, FlashMessages;

    protected $data = null;

    protected function setPageTitle($title, $subTitle){
        view()->share(['title' => $title, 'sub_title' => $subTitle]);
    }

    protected function showErrorPage($errorCode = 404, $message = null){
        $data['message'] = $message;
        return response()->view('errors.'.$errorCode, $data, $errorCode);
    }

    protected function responseJson($error = true, $responseCode = 200, $message = [], $data = null){
        return response()->json([
            'error'         => $error,
            'response_code' => $responseCode,
            'message'       => $message,
            'data'          => $data
        ]);
    }

    protected function responseRedirect($route, $message, $type = 'info', $error = false, $withOldInputWhenError = false){
        $this->setFlashMessage($message, $type);
        $this->showFlashMessages();

        if($error && $withOldInputWhenError){
            return redirect()->back()->withInput();
        }

        return redirect()->route($route);
    }

    protected function responseRedirectBack($message, $type = 'info', $error = false, $withOldInputWhenError = false){
        $this->setFlashMessage($message, $type);
        $this->showFlashMessages();

        return redirect()->back();
    }
}
