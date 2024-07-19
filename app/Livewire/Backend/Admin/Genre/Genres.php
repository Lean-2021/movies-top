<?php

namespace App\Livewire\Backend\Admin\Genre;

use App\Livewire\Backend\Admin\Cinema\CinemaTable;
use App\Models\Cinema;
use App\Models\Genre;
use Livewire\Attributes\On;
use Livewire\Component;

class Genres extends Component
{
  public $openModal = false;
  public $genre_id = '';
  public $action, $name, $status, $order;

  public function render()
  {
    return view('livewire.backend.admin.genre.genres')->layout('layouts.dashboard');
  }
  
  // Validaciones
  public function rules()
  {
    return [
      'name' => $this->action === 'create' ? 'required|min:3|max:254|unique:genres,name' : 'required|min:3|max:254|unique:genres,name,' . $this->genre_id,
    ];
  }

  // Mensajes de validaciones
  public function messages()
  {
    return [
      'name.required' => 'Ingrese un nombre',
      'name.min' => 'Ingrese al menos 3 caracteres',
      'name.max' => 'Máximo premitido de caracteres 254',
      'name.unique' => 'Ya existe un género con ese nombre',
    ];
  }

  // Crear un nuevo director
  public function create()
  {
    $this->action = 'create';
    $this->cleanFields();
    $this->showModal();
  }

  // Editar director
  #[On('edit')]
  public function edit($id)
  {
    $this->action = 'edit';
    $genre = Genre::findOrFail($id);
    $this->genre_id = $genre->id;
    $this->name = $genre->name;
    $this->status = $genre->status;
    $this->order = $genre->order;
    $this->showModal();
  }

  //Guardando los datos
  public function store()
  {
    // Validar datos utilizando el método rules
    $this->validate();
    // guardamos o actualizamos según la ocasión
    try {
      Genre::updateOrCreate([
        'id' => $this->genre_id
      ], [
        'name' => $this->name,
        'status' => 1
      ]);
      // cerrar modal
      $this->closeModal();
      //limpiar campos
      $this->cleanFields();
      // Refrescar tabla
      $this->dispatch('refreshDatatable')->to(GenreTable::class);
      // Mensajes de creación ó actualización según la ocasión
      if ($this->action === 'create') {
        $this->dispatch('create', message: 'Género creado', icon: 'success');
      } else if ($this->action === 'edit') {
        $this->dispatch('create', message: 'Género modificado', icon: 'success');
      }
    } catch (\Throwable $th) {
//        dd($th->getMessage());
      if ($this->action === 'create') {
        $this->dispatch('create', message: 'No se puedo crear el género', icon: 'error');
      } else if ($this->action === 'edit') {
        $this->dispatch('create', message: 'No se pudo modificar el género', icon: 'error');
      }
      // cerrar modal
      $this->closeModal();
      //limpiar campos
      $this->cleanFields();
    }
  }

  #[On('destroy')]
  public function destroy($id)
  {
    try {
      Genre::destroy($id);
      // actualizar tabla
      $this->dispatch('refreshDatatable')->to(GenreTable::class);
      // mostrar mensaje eliminacion correcta
      $this->dispatch('create', message: 'Género eliminado', icon: 'success');
    } catch (\Throwable $th) {
//        dd($th->getMessage());
      $this->dispatch('create', message: 'No se pudo eliminar el género', icon: 'error');
    }
  }

  // limpiar campos - order y status se podrian obviar ya que no se ingresan, por el momento se deja
  public function cleanFields()
  {
    $this->genre_id = '';
    $this->name = '';
    $this->status = '';
    $this->order = '';
    $this->resetErrorBag();
  }

  public function showModal()
  {
    $this->openModal = true;
  }

  public function closeModal()
  {
    $this->openModal = false;
  }
}
