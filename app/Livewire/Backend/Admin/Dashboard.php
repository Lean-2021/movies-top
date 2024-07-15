<?php

  namespace App\Livewire\Backend\Admin;

  use App\Models\Actor;
  use App\Models\Director;
  use Livewire\Component;

  class Dashboard extends Component
  {
    public function render()
    {
      $directors = Director::all();
      $actors = Actor::all();
      return view('livewire.backend.admin.dashboard', [
        'directors' => $directors,
        'actors' => $actors
      ])->layout('layouts.dashboard');
    }
  }
