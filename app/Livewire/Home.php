<?php

namespace App\Livewire;

use App\Models\Movie;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\Livewire;

class Home extends Component
{
  public $search = '';
  public $moviesSearch = [];
  public $searchMovies = [];
  public $showResult = false;

  #[Layout('layouts.app')]
  public function render()
  {
    return view('livewire.home', [
      // filtrar peliculas por el título
      'moviesSearch' => $this->moviesSearch,
    ]);
  }

  // Actualizar valores de búsqueda según el estado de search
  public function updatedSearch()
  {
    $this->searchMovies = Movie::where('title', 'like', '%' . $this->search . '%')->get();
    $this->showResult = $this->searchMovies->isNotEmpty();
  }
  // en el menú de busqueda al hacer click sobre una coincidencia asignarle el valor al input
  public function searchSelected($item)
  {
    $this->search = $item;
    $this->showResult = false;
  }

  // buscar peliculas por el título
  public function searchByTitle()
  {
    $this->dispatch('scrollToSearch');
    $this->moviesSearch = Movie::where('title', 'like', '%' . $this->search . '%')->get();
    $this->showResult = false;
  }
}