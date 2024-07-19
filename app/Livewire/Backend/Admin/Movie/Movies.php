<?php

namespace App\Livewire\Backend\Admin\Movie;

use App\Livewire\Backend\Admin\Director\DirectorTable;
use App\Models\Country;
use App\Models\Director;
use App\Rules\UniqueDirector;
use Livewire\Attributes\On;
use Livewire\Component;

class Movies extends Component
{
  public $openModal = false;
  public $movie_id = '';
  public $action, $title, $description, $genre_id, $language_id, $duration, $year, $votes, $section, $image, $actor_id, $director_id, $cinema_id, $country_id, $status, $order;

  public function render()
  {
    $countries = Country::all();
    return view('livewire.backend.admin.movie.movies', [
      'countries' => $countries,
    ])->layout('layouts.dashboard');
  }

  public function rules()
  {
    return [
      'first_name' => ['required', 'min:3', 'max:100', 'regex:/^[a-zA-Z\s]+$/', new UniqueDirector($this->first_name, $this->last_name, $this->country_id)],
      'last_name' => 'required|min:3|max:100|regex:/^[a-zA-Z\s]+$/',
      'country_id' => 'required|exists:countries,id',
    ];
  }

  // Mensajes de validaciones
  public function messages()
  {
    return [
      'first_name.required' => 'Ingrese un nombre',
      'first_name.min' => 'Ingrese al menos 3 caracteres',
      'first_name.max' => 'Máximo premitido de caracteres 100',
      'first_name.regex' => 'Ingrese un nombre válido',
      'last_name.required' => 'Ingrese un apellido',
      'last_name.min' => 'Ingrese al menos 3 caracteres',
      'last_name.max' => 'Máximo premitido de caracteres 100',
      'last_name.regex' => 'Ingrese un apellido válido',
      'country_id.required' => 'Seleccione un páis',
      'country_id.exists' => 'Seleccione un país válido',
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
    $director = Director::findOrFail($id);
    $this->director_id = $director->id;
    $this->first_name = $director->first_name;
    $this->last_name = $director->last_name;
    $this->country_id = $director->country_id;
    $this->status = $director->status;
    $this->order = $director->order;
    $this->showModal();
  }

  //Guardando los datos
  public function store()
  {
    // Validar datos utilizando el método rules
    $this->validate();
    // guardamos o actualizamos según la ocasión
    try {
      Director::updateOrCreate([
        'id' => $this->director_id
      ], [
        'first_name' => $this->first_name,
        'last_name' => $this->last_name,
        'country_id' => $this->country_id,
        'status' => 1
      ]);
      // cerrar modal
      $this->closeModal();
      //limpiar campos
      $this->cleanFields();
      // Refrescar tabla
      $this->dispatch('refreshDatatable')->to(DirectorTable::class);
      // Mensajes de creación ó actualización según la ocasión
      if ($this->action === 'create') {
        $this->dispatch('create', message: 'Director creado', icon: 'success');
      } else if ($this->action === 'edit') {
        $this->dispatch('create', message: 'Director modificado', icon: 'success');
      }
    } catch (\Throwable $th) {
//        dd($th->getMessage());
      if ($this->action === 'create') {
        $this->dispatch('create', message: 'No se puedo crear el director', icon: 'error');
      } else if ($this->action === 'edit') {
        $this->dispatch('create', message: 'No se pudo modificar el director', icon: 'error');
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
      Director::destroy($id);
      // actualizar tabla
      $this->dispatch('refreshDatatable')->to(DirectorTable::class);
      // mostrar mensaje eliminacion correcta
      $this->dispatch('create', message: 'Director eliminado', icon: 'success');

    } catch (\Throwable $th) {
//        dd($th->getMessage());
      $this->dispatch('create', message: 'No se pudo eliminar el director', icon: 'error');
    }
  }

  public function cleanFields()
  {
    $this->director_id = '';
    $this->first_name = '';
    $this->last_name = '';
    $this->country_id = '';
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
