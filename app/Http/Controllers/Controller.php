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
    
    protected function responseJson( $message = [] ){
        return response()->json($message);
    }

    protected function redirectRoute($route, $message, $type = 'info'){

        if(!empty($message)){
            $this->setFlashMessage($message, $type);
            $this->showFlashMessages();
        }

        return redirect()->route($route);

    }

    protected function redirectBack($message, $type = 'info'){

        if(!empty($message)){
            $this->setFlashMessage($message, $type);
            $this->showFlashMessages();
        }

        return redirect()->back();

    }

    protected function redirectBackWithInput( $error = false ){

        if( !empty($error) ){
            return redirect()->back()->withInput()->withErrors( $error );
        }

        return redirect()->back()->withInput();

    }

}
