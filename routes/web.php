<?php

use App\Livewire\Backend\Admin\Dashboard;
use App\Livewire\Backend\Admin\Director\Directors;
use App\Livewire\Backend\Admin\Actor\Actors;
use App\Livewire\Backend\Admin\Cinema\Cinemas;
use App\Livewire\Backend\Admin\Genre\Genres;
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
  // Generos
  Route::get('generos', Genres::class)->name('genres');
});
