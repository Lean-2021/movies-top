<?php

  namespace App\Livewire\Backend\Admin;

  use App\Models\Actor;
  use App\Models\Cinema;
  use App\Models\Director;
  use Livewire\Component;

  class Dashboard extends Component
  {
    public function render()
    {
      $directors = Director::all();
      $actors = Actor::all();
      $cinemas = Cinema::all();
      return view('livewire.backend.admin.dashboard', [
        'directors' => $directors,
        'actors' => $actors,
        'cinemas' => $cinemas
      ])->layout('layouts.dashboard');
    }
  }
