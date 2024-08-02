<?php

namespace App\Livewire\Backend\Admin\Movie;

use App\Models\Country;
use Livewire\Attributes\On;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Movie;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Columns\BooleanColumn;
use Rappasoft\LaravelLivewireTables\Views\Columns\ImageColumn;
use Rappasoft\LaravelLivewireTables\Views\Filters\MultiSelectDropdownFilter;
use Rappasoft\LaravelLivewireTables\Views\Filters\SelectFilter;

class MovieTable extends DataTableComponent
{
  protected $model = Movie::class;
  protected $movie;
  public $showPreview = false;

  public function configure(): void
  {
    $this->setPrimaryKey('id');
    $this->setDefaultReorderSort('order', 'desc');
    $this->setReorderEnabled();
    $this->setSortingPillsStatus(true);
  }

  //Refresca la tabla
  #[On('refreshDatatable')]
  public function refreshTable()
  {
    '$refresh';
  }

  // Cambiar el numero de orden entre registros
  public function reorder(array $items): void
  {
    foreach ($items as $item) {
      Movie::find($item[$this->getPrimaryKey()])->update(['order' => (int)$item[$this->getDefaultReorderColumn()]]);
    }
  }

  // Aplicar filtros
  public function filters(): array
  {
    return [
      // ordenar por estado
      SelectFilter::make('Activo')
        ->options([
          '' => 'Todos',
          '1' => 'Activos',
          '0' => 'Inactivos',
        ])
        ->filter(function (\Illuminate\Database\Eloquent\Builder $builder, string $value) {
          if ($value === '1') {
            $builder->where('status', 1);
          } elseif ($value === '0') {
            $builder->where('status', 0);
          }
        }),
    ];
  }

  // Acciones masivas - estados activos / inactivos
  public function bulkActions(): array
  {
    return [
      'statusOff' => 'Desactivar Todos',
      'statusOn' => 'Activar Todos',
      'delete' => 'Eliminar Todos'
    ];
  }

  public function openModalPreview($id)
  {
    $this->showPreview = true;
    $this->movie = Movie::findOrFail($id);
//    dd($th->movie);
  }

  public function closeModalPreview()
  {
    $this->showPreview = false;
  }


  // LLamar al método edit del controlador director
  public function edit($row)
  {
    $this->dispatch('edit', $row)->to(Movies::class);
  }

  public function delete()
  {
    $deleteItems = [];
    foreach ($this->getSelected() as $item) {
      array_push($deleteItems, $item);
    }
    $this->dispatch('deleteSelected', $deleteItems);
  }

  #[On('destroyAll')]
  public function destroySelected($selected)
  {
    try {
      foreach ($selected as $item) {
        Movie::destroy($item);
      };
      $this->dispatch('create', message: 'Películas eliminadas', icon: 'success');
      // deseleccionar todos los elementos
      $this->clearSelected();
    } catch (\Throwable $th) {
      //        dd($th->getMessage());
      $this->dispatch('create', message: 'No se pudieron eliminar los registros', icon: 'error');
    }
  }

  // poner estados inactivos
  public function statusOff()
  {
    try {
      foreach ($this->getSelected() as $item) {
        $director = Movie::find($item);
        $director->update([
          'status' => 0
        ]);
      }
      // deseleccionar todos los elementos
      $this->clearSelected();
    } catch (\Throwable $th) {
      //        dd($th->getMessage());
      $this->dispatch('create', message: 'No se pudieron actualizar los registros', icon: 'error');
    }
  }

  // poner estados activos
  public function statusOn()
  {
    try {
      foreach ($this->getSelected() as $item) {
        $director = Movie::find($item);
        $director->update([
          'status' => 1
        ]);
      }
      // deseleccionar elementos
      $this->clearSelected();
    } catch (\Throwable $th) {
      //        dd($th->getMessage());
      $this->dispatch('create', message: 'No se pudieron actualizar los registros', icon: 'error');
    }
  }

  public function columns(): array
  {
//    $this->movie = Movie::all();
    return [
      Column::make("Id", "id")
        ->sortable(),
      Column::make("Título", "title")
        ->sortable()
        ->searchable(),
      Column::make("Descripción", "description")
        ->sortable()
        ->isHidden(),
      Column::make("Género/s")
        ->label(fn($row) => implode(' | ', $row->genres()->pluck('name')->toArray()))
        ->searchable(),
      Column::make("Idioma", "language.name")
        ->sortable()
        ->searchable(),
      Column::make("Duración (Min)", "duration")
        ->sortable(),
      Column::make("Año", "year")
        ->sortable()
        ->searchable(),
      Column::make("Votos", "votes")
        ->sortable()
        ->isHidden(),
      Column::make("Sección", "section")
        ->sortable(),
      ImageColumn::make("Imagen", 'image')
        ->location(
          function ($row) {
            $movie = Movie::findOrFail($row->id);
            return $movie->image && asset('storage/movies/' . $movie->image) ? asset('storage/movies/' . $movie->image) : asset('images/no-available.png');
          }
        )
        ->attributes(fn($row) => [
          'class' => 'w-10 h-10 object-cover',
        ]),
      Column::make("Image url", "image_url")
        ->isHidden(),
      Column::make("Image url id", "image_url_id")
        ->isHidden(),
      // Column::make("Actores", "actor_id")
      //   ->sortable(),
      // Column::make("Director", "director_id")
      //   ->sortable(),
      Column::make("Estudio", "cinema.name")
        ->sortable(),
      Column::make("País", "country.name")
        ->sortable()
        ->searchable(),
      Column::make("Orden", "order")
        ->sortable(),
      BooleanColumn::make("Activo", "status")
        ->sortable(),
      Column::make("Acciones")
        ->label(
          function ($row) {
            return view('livewire.backend.admin.movie.movies-actions',
              [
                'row' => $row->id,
                'showPreview' => $this->showPreview,
                'movie' => $this->movie,
              ]);
          }
        ),
    ];
  }
}
