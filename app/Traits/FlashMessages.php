<?php 

namespace App\Traits;

/**
 * Trait FlashMessages
 * @package App\Traits
 */
trait FlashMessages
{    
    protected $errorMessages = [];
    protected $infoMessages = [];
    protected $successMessages = [];
    protected $warningMessages = [];

    protected function setFlashMessage($message, $type){
        $model = 'infoMessages';
        switch ($type) {
            case 'info':
                $model = 'infoMessages';
                break;
            case 'error':
                $model = 'errorMessages';
                break;
            case 'success':
                $model = 'successMessages';
                break;
            case 'warning':
                $model = 'warningMessages';
                break;            
            default:
                $model = 'infoMessages';
                break;
        }

        if(is_array($message)){
            foreach ($message as $key => $value) {
                array_push($this->model, $value);
            }
        }else{
            array_push($this->model, $message);
        }

    }

    protected function getFlashMessage(){
        return [
            'error'   => $this->errorMessages,
            'info'    => $this->infoMessages,
            'warning' => $this->warningMessages,
            'success' => $this->successMessages,
        ];
    }

    protected function showFlashMessages(){
        session()->flash('error', $this->errorMessages);
        session()->flash('info', $this->infoMessages);
        session()->flash('warning', $this->warningMessages);
        session()->flash('success', $this->successMessages);
    }
}



?>