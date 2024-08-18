<?php

namespace App\Livewire;

use App\Models\Movie;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\Livewire;
use Livewire\WithPagination;

class Home extends Component
{
  public $search = '';
  public $searchResult = '';
  public $moviesSearch = [];
  public $searchMovies = [];
  public $showResult = false;

  public $currentPage = 1;

  use WithPagination;

  #[Layout('layouts.app')]
  public function render()
  {
    return view('livewire.home', [
      // filtrar peliculas por el título
      'moviesSearch' => $this->moviesSearch,
      // peliculas filtradas por sección tendencias activas y paginada de a 20 ordenadas por mas recientes - trae mas según se haga click en los botones siguientes/prev
      'moviesTrends' => Movie::where('status', 1)
        ->where('section', '=', 'tendencias')
        ->orderBy('created_at', 'desc')
        ->paginate(20, ['*'], 'page', $this->currentPage),
      // peliculas filtradas por sección novedades activas y paginadas para solo muestra las últimas 10
      'moviesNovelties' => Movie::where('status', 1)
        ->where('section', 'novedades')
        ->orderBy('created_at', 'desc')
        ->paginate(10),
      // péliculas filtradas por sección aclamadas activas , muestra solo las últimas 30
      'moviesAclaimed' => Movie::where('status', 1)
        ->where('section', 'aclamadas')
        ->orderBy('created_at', 'desc')
        ->paginate(30),
    ]);
  }

  // Actualizar valores de búsqueda según el estado de search
  public function updatedSearch()
  {
    $this->searchMovies = Movie::where('status', 1)
      ->where('title', 'like', '%' . $this->search . '%')->get();
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
    $this->searchResult = $this->search;
    $this->search = '';
  }

  // Ir a página anterior en tendencias siempre y cuando la página se mayor a 1
  public function prevPage()
  {
    if ($this->currentPage > 1) {
      $this->currentPage--;
    }
  }

  // Ir a página siguiente mientras haya registros disponibles
  public function nextPage()
  {
    $this->currentPage++;
  }

  // Eliminar resultados de búsqueda
  public function cleanSearch()
  {
    $this->showResult = false;
    $this->moviesSearch = [];
    $this->dispatch('scrollToSeachContainer');
  }
}
