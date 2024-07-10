<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Livewire;

class Home extends Component
{
    public function render()
    {
        return view('livewire.home')->layout('layouts.app');
    }
}
