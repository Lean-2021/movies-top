<?php

namespace App\Livewire\Backend\Admin\Director;

use App\Models\Country;
use App\Models\Director;
use Livewire\Attributes\On;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Columns\BooleanColumn;
use Rappasoft\LaravelLivewireTables\Views\Columns\ImageColumn;
use Rappasoft\LaravelLivewireTables\Views\Filters\MultiSelectDropdownFilter;
use Rappasoft\LaravelLivewireTables\Views\Filters\SelectFilter;
use Rappasoft\LaravelLivewireTables\Views\Filters\TextFilter;

class DirectorTable extends DataTableComponent
{
  protected $model = Director::class;
  protected $director;
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

  // Mostrar vista previa
  public function openPreview($id)
  {
    $this->showPreview = true;
    $this->director = Director::findOrFail($id);
  }

  // Cerrar vista previa
  public function closePreview()
  {
    $this->showPreview = false;
  }

  // Cambiar el numero de orden entre registros
  public function reorder(array $items): void
  {
    foreach ($items as $item) {
      Director::find($item[$this->getPrimaryKey()])->update(['order' => (int)$item[$this->getDefaultReorderColumn()]]);
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

  // LLamar al método edit del controlador director
  public function edit($row)
  {
    $this->dispatch('edit', $row)->to(Directors::class);
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
        Director::destroy($item);
      };
      $this->dispatch('create', message: 'Directores eliminados', icon: 'success');
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
    // Director::query()->update([
    //   'status' => 0,
    // ]);
    try {
      foreach ($this->getSelected() as $item) {
        $director = Director::find($item);
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
    // Director::query()->update([
    //   'status' => 1,
    // ]);
    try {
      foreach ($this->getSelected() as $item) {
        $director = Director::find($item);
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

  // construir la tabla directores
  public function columns(): array
  {
    // $this->director = Director::all();
    return [
      Column::make("Id", "id")
        ->sortable(),
      Column::make("Nombre", "first_name")
        ->sortable()
        ->searchable(),
      Column::make("Apellido", "last_name")
        ->sortable()
        ->searchable(),
      ImageColumn::make('Bandera')
        ->location(function ($row) {
          $director = Director::findOrFail($row->id);
          return asset('storage/flags/' . $director->country->flag);
        })
        ->attributes(fn($row) => [
          'class' => 'w-16 object-cover',
        ]),
      Column::make("País", 'country.name')
        ->sortable()
        ->searchable(),
      Column::make("Orden", "order")
        ->sortable(),
      BooleanColumn::make("Activo", "status")
        ->sortable(),
      Column::make("Acciones")
        ->label(
          function ($row) {
            return view(
              'livewire.backend.admin.directors.directors-actions',
              [
                'row' => $row->id,
                'showPreview' => $this->showPreview,
                'director' => $this->director,
              ]
            );
          }
        ),
    ];
  }
}
