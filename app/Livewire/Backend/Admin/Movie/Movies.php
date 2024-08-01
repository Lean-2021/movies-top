<?php

namespace App\Livewire\Backend\Admin\Movie;

use App\Livewire\Backend\Admin\Director\DirectorTable;
use App\Models\Actor;
use App\Models\Cinema;
use App\Models\Country;
use App\Models\Director;
use App\Models\Genre;
use App\Models\Language;
use App\Models\Movie;
use App\Rules\UniqueDirector;
use App\Rules\UniqueMovie;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithFileUploads;

class Movies extends Component
{
  public $openModal = false;
  public $imagePreview = false;
  public $movie_id = '';
  public $action,
    $title,
    $description,
    $language_id,
    $duration,
    $year,
    $votes,
    $section,
    $image,
    $cinema_id,
    $country_id,
    $status,
    $order,
    $current_year;
  public $genres = [];
  public $actors = [];
  public $directors = [];

  use WithFileUploads;

  #[Layout('layouts.dashboard')]
  public function render()
  {

    $today = Carbon::now();
    $this->current_year = intval($today->format('Y'));

    $countries = Country::all();
    $genres = Genre::where('status', 1)->get();
    $languages = Language::all();
    $actors = Actor::where('status', 1)->get();
    $directors = Director::where('status', 1)->get();
    $cinemas = Cinema::where('status', 1)->get();

    return view('livewire.backend.admin.movie.movies', [
      'countries' => $countries,
      'genres_movie' => $genres,
      'languages' => $languages,
      'actors_movie' => $actors,
      'directors_movie' => $directors,
      'cinemas' => $cinemas,
    ]);
  }

  public function rules()
  {
    return [
      'title' => $this->action === 'create' ? ['required', 'min:2', 'max:254', new UniqueMovie([
        'title' => $this->title,
        'description' => $this->description,
        'language_id' => $this->language_id,
        'duration' => $this->duration,
        'year' => $this->year,
        'section' => $this->section,
        'cinema_id' => $this->cinema_id,
        'country_id' => $this->country_id,
      ])] : 'required|min:2|max:254',
      'description' => 'required',
      'language_id' => 'required|exists:languages,id',
      'country_id' => 'required|exists:countries,id',
      'year' => 'required|integer|digits:4|min:1920|max:' . $this->current_year,
      'genres' => 'required|array',
      'genres.*' => 'exists:genres,id|integer',
      'duration' => 'required|integer|min:1|max:50000',
      'section' => 'required|in:general,aclamadas,novedades,tendencias',
      'actors' => 'required|array',
      'actors.*' => 'exists:actors,id|integer',
      'directors' => 'required|array',
      'directors.*' => 'exists:directors,id|integer',
      'cinema_id' => 'required|exists:cinemas,id',
      'image' => $this->action === 'edit' && !$this->imagePreview ? 'nullable' : 'nullable|mimes:svg,png,jpg,jpeg|max:1024|dimensions:min_width=500,min_height=500'
    ];
  }

  // Mensajes de validaciones
  public function messages()
  {
    return [
      'title.required' => 'Ingrese un nombre',
      'title.min' => 'Ingrese al menos 2 caracteres',
      'title.max' => 'Máximo premitido de caracteres 254',
      'description.required' => 'Ingrese una descripción',
      'language_id.required' => 'Ingrese un idioma',
      'language_id.exists' => 'Ingrese un idioma válido',
      'country_id.required' => 'Ingrese un país',
      'country_id.exists' => 'Ingrese un país válido',
      'year.required' => 'Ingrese el año',
      'year.integer' => 'Ingrese un año válido',
      'year.digits' => 'Ingrese un año válido',
      'year.min' => 'El año debe ser mayora 1920',
      'year.max' => 'El año supera el año actual',
      'genres.required' => 'Seleccione un género',
      'genres.array' => 'Género incorrecto',
      'genres.*.exists' => 'Género incorrecto',
      'genres.*.integer' => 'Género incorrecto',
      'duration.required' => 'Ingrese la duración',
      'duration.integer' => 'Dato incorrecto',
      'duration.min' => 'Mínimo 1 min',
      'duration.max' => 'Máximo 50000 min',
      'section.required' => 'Seleccione una sección',
      'section.in' => 'Sección inválida',
      'actors.required' => 'Seleccione un actor',
      'actors.array' => 'Actor incorrecto',
      'actors.*.exists' => 'Actor incorrecto',
      'actors.*.integer' => 'Actor incorrecto',
      'directors.required' => 'Seleccione un director',
      'directors.array' => 'Director incorrecto',
      'directors.*.exists' => 'Director incorrecto',
      'directors.*.integer' => 'Director incorrecto',
      'cinema_id.required' => 'Ingrese un estudio',
      'cinema_id.exists' => 'Estudio inválido',
      'image.mimes' => 'Formato no permitido',
      'image.max' => 'Tamaño no permitido',
      'image.dimensions' => 'Resolución no permitida'
    ];
  }

  public function changeImage()
  {
    $this->imagePreview = true;
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
    $movie = Movie::findOrFail($id);
    $this->movie_id = $movie->id;
    $this->title = $movie->title;
    $this->description = $movie->description;
    $this->language_id = $movie->language_id;
    $this->duration = $movie->duration;
    $this->year = $movie->year;
    $this->section = $movie->section;
    $this->cinema_id = $movie->cinema_id;
    $this->country_id = $movie->country_id;
    $this->image = $movie->image;
    $this->status = $movie->status;
    $this->order = $movie->order;

    // Seleccionar los géneros que fueron elegidos
    $this->genres = $movie->genres()->pluck('genre_id')->toArray();
    // Seleccionar los actores que fueron elegidos
    $this->actors = $movie->actors()->pluck('actor_id')->toArray();
    // Seleccionar los directores que fueron elegidos
    $this->directors = $movie->directors()->pluck('director_id')->toArray();

    $this->showModal();
  }

  //Guardando los datos
  public function store()
  {
    // Validar datos utilizando el método rules
    $this->validate();

    // Si se selecciona una imágen le cambiamos el nombre original y la guardamos - Solo las que tengan imágen tendrán estado activo al cargarlas
    if ($this->imagePreview) {
      $image_name = nameImage($this->image->extension());
      $status_now = 1;
      $this->image->storeAs('movies', $image_name);
      // Si estamos editando  y cambiamos la imágen borramos la anterior antes de guardar la nueva
      if ($this->action === 'edit') {
        $movie = Movie::findOrFail($this->movie_id);
        if ($movie->image && Storage::exists('movies/' . $movie->image)) {
          Storage::delete('movies/' . $movie->image);
        };
        $image_name = nameImage($this->image->extension());
        $this->image->storeAs('movies', $image_name);
        $status_now = 1;
      }
    } else {
      $image_name = '';
      $status_now = 0;
    }

    if (!$this->imagePreview && $this->action === 'edit') {
      $movie = Movie::findOrFail($this->movie_id);
      $image_name = $movie->image;
      $status_now = $movie->status;
    }

    // guardamos o actualizamos según la ocasión
    try {
      $movie = Movie::updateOrCreate([
        'id' => $this->movie_id
      ], [
        'title' => $this->title,
        'description' => $this->description,
        'language_id' => $this->language_id,
        'country_id' => $this->country_id,
        'duration' => $this->duration,
        'year' => $this->year,
        'section' => $this->section,
        'image' => $image_name,
        'cinema_id' => $this->cinema_id,
        'country_id' => $this->country_id,
        'status' => $status_now,
      ]);

      $movie->genres()->sync($this->genres); //sincronizar géneros
      $movie->actors()->sync($this->actors); // sincronizar actores
      $movie->directors()->sync($this->directors); // sincronizar directores

      // cerrar modal
      $this->closeModal();
      //limpiar campos
      $this->cleanFields();
      // Refrescar tabla
      $this->dispatch('refreshDatatable')->to(MovieTable::class);
      // Mensajes de creación ó actualización según la ocasión
      if ($this->action === 'create') {
        $this->dispatch('create', message: 'Película creada', icon: 'success');
      } else if ($this->action === 'edit') {
        $this->dispatch('create', message: 'Película modificada', icon: 'success');
      }
    } catch (\Throwable $th) {
      dd($th->getMessage());
      if ($this->action === 'create') {
        $this->dispatch('create', message: 'No se puedo crear la película', icon: 'error');
      } else if ($this->action === 'edit') {
        $this->dispatch('create', message: 'No se pudo modificar la película', icon: 'error');
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
      // Buscar la película para eliminar la imágen y desasociar tablas pibot antes de eliminarla
      $movie = Movie::findOrFail($id);
      if (Storage::exists('movies/' . $movie->image)) {
        Storage::delete('movies/' . $movie->image);
      }
      $movie->genres()->detach(); // eliminar registros asociados
      $movie->delete(); //eliminar la pelicula
      // actualizar tabla
      $this->dispatch('refreshDatatable')->to(MovieTable::class);
      // mostrar mensaje eliminacion correcta
      $this->dispatch('create', message: 'Película eliminada', icon: 'success');
    } catch (\Throwable $th) {
      //        dd($th->getMessage());
      $this->dispatch('create', message: 'No se pudo eliminar la película', icon: 'error');
    }
  }

  public function cleanFields()
  {
    $this->title = '';
    $this->description = '';
    $this->language_id = '';
    $this->duration = '';
    $this->year = '';
    $this->section = '';
    $this->image = '';
    $this->cinema_id = '';
    $this->country_id = '';
    $this->status = '';
    $this->order = '';
    $this->imagePreview = false;
    $this->genres = [];
    $this->actors = [];
    $this->directors = [];
    $this->resetErrorBag();
  }

  public function showModal()
  {
    $this->openModal = true;
  }

  public function closeModal()
  {
    $this->openModal = false;
    $this->cleanFields();
  }
}
