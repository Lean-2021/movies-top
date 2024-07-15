<?php

  namespace App\Livewire\Backend\Admin\Actor;

  use App\Livewire\Backend\Admin\director\DirectorTable;
  use App\Models\Actor;
  use App\Models\Country;
  use App\Rules\UniqueActor;
  use Livewire\Attributes\On;
  use Livewire\Component;

  class Actors extends Component
  {
    public $openModal = false;
    public $actor_id = '';
    public $action, $first_name, $last_name, $country_id, $status, $order;

    public function render()
    {
      $countries = Country::all();
      return view('livewire.backend.admin.actor.actors',
        ['countries' => $countries])
        ->layout('layouts.dashboard');
    }

    // Validaciones
    public function rules()
    {
      return [
        'first_name' => ['required', 'min:3', 'max:100', 'regex:/^[a-zA-Z\s]+$/', new UniqueActor($this->first_name, $this->last_name, $this->country_id)],
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
      $actor = Actor::findOrFail($id);
      $this->actor_id = $actor->id;
      $this->first_name = $actor->first_name;
      $this->last_name = $actor->last_name;
      $this->country_id = $actor->country_id;
      $this->status = $actor->status;
      $this->order = $actor->order;
      $this->showModal();
    }

    //Guardando los datos
    public function store()
    {
      // Validar datos utilizando el método rules
      $this->validate();
      // guardamos o actualizamos según la ocasión
      try {
        Actor::updateOrCreate([
          'id' => $this->actor_id
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
        $this->dispatch('refreshDatatable')->to(ActorTable::class);
        // Mensajes de creación ó actualización según la ocasión
        if ($this->action === 'create') {
          $this->dispatch('create', message: 'Actor creado', icon: 'success');
        } else if ($this->action === 'edit') {
          $this->dispatch('create', message: 'Actor modificado', icon: 'success');
        }
      } catch (\Throwable $th) {
//        dd($th->getMessage());
        if ($this->action === 'create') {
          $this->dispatch('create', message: 'No se puedo crear el actor', icon: 'error');
        } else if ($this->action === 'edit') {
          $this->dispatch('create', message: 'No se pudo modificar el actor', icon: 'error');
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
        Actor::destroy($id);
        // actualizar tabla
        $this->dispatch('refreshDatatable')->to(ActorTable::class);
        // mostrar mensaje eliminacion correcta
        $this->dispatch('create', message: 'Actor eliminado', icon: 'success');
      } catch (\Throwable $th) {
//        dd($th->getMessage());
        $this->dispatch('create', message: 'No se pudo eliminar el actor', icon: 'error');
      }
    }

    // limpiar campos - order y status se podrian obviar ya que no se ingresan, por el momento se deja
    public function cleanFields()
    {
      $this->actor_id = '';
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
