<?php

namespace App\Livewire\Backend\Admin;

use App\Models\Actor;
use App\Models\Cinema;
use App\Models\Director;
use App\Models\Genre;
use App\Models\Movie;
use Livewire\Component;

class Dashboard extends Component
{
  public function render()
  {
    $directors = Director::all();
    $actors = Actor::all();
    $cinemas = Cinema::all();
    $genres = Genre::all();
    $movies = Movie::all();
    return view('livewire.backend.admin.dashboard', [
      'directors' => $directors,
      'actors' => $actors,
      'cinemas' => $cinemas,
      'genres' => $genres,
      'movies' => $movies
    ])->layout('layouts.dashboard');
  }
}
