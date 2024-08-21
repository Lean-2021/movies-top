<?php

namespace App\Livewire;

use App\View\Components\modal\GenericModal;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;

class Footer extends Component
{
  public $showModal = false;
  public $showResponse = null;
  public $title, $name;

  public function openModal($showModal, $name, $title)
  {
    $this->name =  $name;
    $this->title = $title;
    $this->showModal = $showModal;
  }

  public function closeModal()
  {
    $this->showModal = false;
  }

  public function toggleResponse($index)
  {
    // dd($index);
    if ($this->showResponse === $index) {
      $this->showResponse = null;
    } else {
      $this->showResponse = $index;
    }
  }

  public function render()
  {
    return view('livewire.footer');
  }
}
