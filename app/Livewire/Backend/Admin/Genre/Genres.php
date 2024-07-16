<?php

namespace App\Livewire\Backend\Admin\Genre;

use Livewire\Component;

class Genres extends Component
{
  public function render()
  {
    return view('livewire.backend.admin.genre.genres')->layout('layouts.dashboard');
  }
}
