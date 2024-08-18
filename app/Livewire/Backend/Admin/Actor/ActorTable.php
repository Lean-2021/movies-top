<?php

namespace App\Livewire\Backend\Admin\Actor;

use App\Models\Country;
use Livewire\Attributes\On;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Actor;
use Rappasoft\LaravelLivewireTables\Views\Columns\BooleanColumn;
use Rappasoft\LaravelLivewireTables\Views\Columns\ImageColumn;
use Rappasoft\LaravelLivewireTables\Views\Filters\MultiSelectDropdownFilter;
use Rappasoft\LaravelLivewireTables\Views\Filters\SelectFilter;
use Rappasoft\LaravelLivewireTables\Views\Filters\TextFilter;

class ActorTable extends DataTableComponent
{
  protected $model = Actor::class;
  protected $actor;
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
      Actor::find($item[$this->getPrimaryKey()])->update(['order' => (int)$item[$this->getDefaultReorderColumn()]]);
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

      // // ordenar por pais
      // MultiSelectDropdownFilter::make('País')
      //   ->options(
      //     Country::query()
      //       ->orderBy('name')
      //       ->get()
      //       ->keyBy('id')
      //       ->map(fn($tag) => $tag->name)
      //       ->toArray()
      //   )
      //   ->setFirstOption('Todos los paises')
      //   ->filter(function (\Illuminate\Database\Eloquent\Builder $builder, $values) {
      //     $builder->whereHas('country', function ($query) use ($values) {
      //       $query->whereIn('country_id', $values);
      //     });
      //   }),

      // buscar por apellido
      // TextFilter::make('Apellido')
      //   ->config([
      //     'placeholder' => 'Buscar por apellido',
      //     'maxlength' => '25',
      //   ])
      //   ->filter(function (\Illuminate\Database\Eloquent\Builder $builder, string $value) {
      //     $builder->where('last_name', 'like', '%' . $value . '%');
      //   }),
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

  // LLamar al método edit del controlador actor
  public function edit($row)
  {
    $this->dispatch('edit', $row)->to(Actors::class);
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
        Actor::destroy($item);
      };
      $this->dispatch('create', message: 'Actores eliminados', icon: 'success');
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
        $director = Actor::find($item);
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
        $director = Actor::find($item);
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

  // Mostrar modal de vista previa
  public function openPreview($id)
  {
    $this->showPreview = true;
    $this->actor = Actor::findOrFail($id);
  }

  // cerrar modal de vista previa
  public function closePreview()
  {
    $this->showPreview = false;
  }

  // construir la tabla directores
  public function columns(): array
  {
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
          $actors = Actor::all();
          return asset('storage/flags/' . $actors->find($row->id)->country->flag);
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
            return view('livewire.backend.admin.actor.actors-actions', ['row' => $row->id, 'showPreview' => $this->showPreview, 'actor' => $this->actor]);
          }
        ),
    ];
  }
}
