<?php

namespace App\Livewire;

use Livewire\Component;

class SideBar extends Component
{

    public function spotlight(){
        $this->dispatch('toggle-spotlight');
    }
    public function render()
    {
        return view('livewire.side-bar');
    }
}
