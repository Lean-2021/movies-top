<?php

namespace App\View\Components\modal;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\Component;

class Generic extends Component
{
  public $showModal = false;
  public $showResponse;
  public $title, $name;
  public $faqs = [];
  /**
   * Create a new component instance.
   */
  public function __construct($modal, $name, $title, $response)
  {
    $this->showModal = $modal;
    $this->title = $title;
    $this->name = $name;
    if ($name === 'faqs') {
      $data = Storage::get('faqs/faqs.json');
      $this->faqs = json_decode($data, true);
    }
    $this->showResponse = $response;
  }


  /**
   * Get the view / contents that represent the component.
   */
  public function render(): View|Closure|string
  {
    return view('components.modal.generic', [
      'showModal' => $this->showModal,
      'title' => $this->title,
      'name' => $this->name,
      'faqs' => $this->faqs,
      'showResponse' => $this->showResponse,
    ]);
  }
}
