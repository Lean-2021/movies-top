<?php

use App\Http\Middleware\CheckAdminRole;
use App\Livewire\Backend\Admin\Dashboard;
use App\Livewire\Backend\Admin\Director\Directors;
use App\Livewire\Backend\Admin\Actor\Actors;
use App\Livewire\Backend\Admin\Cinema\Cinemas;
use App\Livewire\Backend\Admin\Genre\Genres;
use App\Livewire\Backend\Admin\Movie\Movies;
use App\Livewire\Frontend\MovieDetail;
use App\Livewire\Home;
use Illuminate\Support\Facades\Route;


Route::get('/', Home::class)->name('home');

// Ruta para mostrar el detalle de la película
Route::get('/movie/{id}/detail', MovieDetail::class)->name('movies.detail');


Route::middleware([
  'auth:sanctum',
  config('jetstream.auth_session'),
  'verified',
  CheckAdminRole::class,
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
  // Peliculas
  Route::get('/peliculas', Movies::class)->name('movies');
});
