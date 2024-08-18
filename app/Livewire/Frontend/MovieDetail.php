<?php

namespace App\Livewire\Frontend;

use App\Models\Movie;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;

class MovieDetail extends Component
{
  public $movies_votes, $votes;
  public $movie = '';
  public $id = '';
  public $showDescription = false;

  public function mount($id)
  {
    $this->id = $id;
    $this->movie = Movie::findOrFail(intval($this->id));
    $this->votes = $this->movie->votes ?? 0;
    if (Auth::check()) {
      $this->movies_votes = Auth::user()->movies_votes ?? [];
    }
    // dd($id);
  }

  #[Layout('layouts.app')]
  public function render()
  {
    return view('livewire.frontend.movie-detail', [
      'movies_votes' => $this->movies_votes
    ]);
  }

  public function changeShowDescription()
  {
    $this->showDescription = !$this->showDescription;
  }

  public function redirectLogin()
  {
    return redirect()->route('login');
  }

  public function add_votes($id)
  {
    $movie = Movie::findOrFail($id);
    $movie->increment('votes');
    $movie->save();
    $this->votes++;

    $user = Auth::user();
    $movies_votes = $user->movies_votes ?? [];

    if (!in_array($id, $movies_votes)) {
      $movies_votes[] = $id;
      $user->movies_votes = $movies_votes;
      $user->save();

      // Actualizar la propiedad de Livewire y recargar el modelo User
      $this->movies_votes = $user->refresh()->movies_votes;
    }
  }
}
