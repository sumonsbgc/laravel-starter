<?php 

namespace App\Traits;

/**
 * Trait FlashMessages
 * @package App\Traits
 */
trait FlashMessages
{    
    protected $messages;
    protected $type;

    protected function setFlashMessage($message, $type){
        if(is_array($message)){
            $this->messages = $message['message'];
            $this->type = $message['status'];
        }else{
            $this->messages = $message['message'];
            $this->type = $type ?? 'error';
        }
    }

    protected function getFlashMessage(){
        return $this->messages;
    }

    protected function showFlashMessages(){        
        session()->flash('status', $this->type);
        session()->flash('message', $this->messages);
    }
}



?>