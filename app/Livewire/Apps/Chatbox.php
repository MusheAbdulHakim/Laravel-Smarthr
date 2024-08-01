<?php

namespace App\Livewire\Apps;

use Livewire\Component;
use RTippin\Janus\Facades\Janus;

class Chatbox extends Component
{
    public $default;

   
    
    public function render()
    {
        if($this->default == true){
            return view('livewire.apps.chat.index');
        }
        return view('livewire.apps.chat.index');
    }
}
