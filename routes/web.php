<?php

  use App\Livewire\Backend\Admin\Dashboard;
  use App\Livewire\Backend\Admin\director\Directors;
  use App\Livewire\Backend\Admin\Actor\Actors;
  use App\Livewire\Backend\Admin\Cinema\Cinemas;
  use App\Livewire\Home;
  use Illuminate\Support\Facades\Route;


  Route::get('/', Home::class)->name('home');


  Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
  ])->prefix('admin')->group(function () {
    // Dashboard
    Route::get('/', Dashboard::class)->name('dashboard');
    // Directores
    Route::get('/directores', Directors::class)->name('directors');
    // Actores
    Route::get('/actores', Actors::class)->name('actors');
    // Estudios
    Route::get('/estudios', Cinemas::class)->name('cinemas');
  });
