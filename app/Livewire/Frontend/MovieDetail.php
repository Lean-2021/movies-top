<?php

namespace App\Livewire\Frontend;

use App\Models\Movie;
use Livewire\Attributes\Layout;
use Livewire\Component;

class MovieDetail extends Component
{
  public $movie = '';
  public $id = '';
  public $showDescription = false;

  public function mount($id)
  {
    $this->id = $id;
    $this->movie = Movie::findOrFail(intval($this->id));
    // dd($id);
  }

  #[Layout('layouts.app')]
  public function render()
  {
    return view('livewire.frontend.movie-detail');
  }

  public function changeShowDescription()
  {
    $this->showDescription = !$this->showDescription;
  }
}