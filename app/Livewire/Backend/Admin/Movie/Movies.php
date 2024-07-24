<?php

namespace App\Livewire\Backend\Admin\Movie;

use App\Livewire\Backend\Admin\Director\DirectorTable;
use App\Models\Country;
use App\Models\Director;
use App\Models\Genre;
use App\Models\Language;
use App\Rules\UniqueDirector;
use App\Rules\UniqueMovie;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Component;

class Movies extends Component
{
  public $openModal = false;
  public $imagePreview = false;
  public $movie_id = '';
  public $action, $title, $description, $language_id, $duration, $year, $votes, $section, $image, $cinema_id, $country_id, $status, $order;
  public $genres = [];
  public $actors = [];
  public $directors = [];


  #[Layout('layouts.dashboard')]
  public function render()
  {
    $countries = Country::all();
    $genres = Genre::all();
    $languages = Language::all();
    return view('livewire.backend.admin.movie.movies', [
      'countries' => $countries,
      'genres' => $genres,
      'languages' => $languages,
    ]);
  }

  public function rules()
  {
    return [
      'title' => $this->action === 'create' ? ['required', 'min:2', new UniqueMovie([
        'title' => $this->title,
        'description' => $this->description,
        'language_id' => $this->language_id,
        'duration' => $this->duration,
        'year' => $this->year,
        'section' => $this->section,
        'cinema_id' => $this->cinema_id,
        'country_id' => $this->country_id
      ])] : 'required|min:2',
      'description' => 'required',
      'language_id' => 'required|exists:languages,id',
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
    $this->title = '';
    $this->description = '';
    $this->genres = [];
    $this->language_id = '';
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
