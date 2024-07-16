<?php

  namespace App\Livewire\Backend\Admin\Cinema;

  use App\Models\Cinema;
  use App\Models\Country;
  use Livewire\Attributes\On;
  use Livewire\Component;
  use App\Livewire\Backend\Admin\Cinema\CinemaTable;

  class Cinemas extends Component
  {
    public $openModal = false;
    public $cinema_id = '';
    public $action, $name, $country_id, $status, $order;

    public function render()
    {
      $countries = Country::all();
      return view('livewire.backend.admin.cinema.cinemas', [
        'countries' => $countries,
      ])->layout('layouts.dashboard');
    }

    // Validaciones
    public function rules()
    {
      return [
        'name' => $this->action === 'create' ? 'required|min:3|max:254|unique:cinemas,name' : 'required|min:3|max:254|unique:cinemas,name,' . $this->cinema_id,
        'country_id' => 'required|exists:countries,id',
      ];
    }

    // Mensajes de validaciones
    public function messages()
    {
      return [
        'name.required' => 'Ingrese un nombre',
        'name.min' => 'Ingrese al menos 3 caracteres',
        'name.max' => 'Máximo premitido de caracteres 254',
        'name.unique' => 'Ya existe un estudio con ese nombre',
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
      $cinema = Cinema::findOrFail($id);
      $this->cinema_id = $cinema->id;
      $this->name = $cinema->name;
      $this->country_id = $cinema->country_id;
      $this->status = $cinema->status;
      $this->order = $cinema->order;
      $this->showModal();
    }

    //Guardando los datos
    public function store()
    {
      // Validar datos utilizando el método rules
      $this->validate();
      // guardamos o actualizamos según la ocasión
      try {
        Cinema::updateOrCreate([
          'id' => $this->cinema_id
        ], [
          'name' => $this->name,
          'country_id' => $this->country_id,
          'status' => 1
        ]);
        // cerrar modal
        $this->closeModal();
        //limpiar campos
        $this->cleanFields();
        // Refrescar tabla
        $this->dispatch('refreshDatatable')->to(CinemaTable::class);
        // Mensajes de creación ó actualización según la ocasión
        if ($this->action === 'create') {
          $this->dispatch('create', message: 'Estudio creado', icon: 'success');
        } else if ($this->action === 'edit') {
          $this->dispatch('create', message: 'Estudio modificado', icon: 'success');
        }
      } catch (\Throwable $th) {
//        dd($th->getMessage());
        if ($this->action === 'create') {
          $this->dispatch('create', message: 'No se puedo crear el estudio', icon: 'error');
        } else if ($this->action === 'edit') {
          $this->dispatch('create', message: 'No se pudo modificar el estudio', icon: 'error');
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
        Cinema::destroy($id);
        // actualizar tabla
        $this->dispatch('refreshDatatable')->to(CinemaTable::class);
        // mostrar mensaje eliminacion correcta
        $this->dispatch('create', message: 'Estudio eliminado', icon: 'success');
      } catch (\Throwable $th) {
//        dd($th->getMessage());
        $this->dispatch('create', message: 'No se pudo eliminar el estudio', icon: 'error');
      }
    }

    // limpiar campos - order y status se podrian obviar ya que no se ingresan, por el momento se deja
    public function cleanFields()
    {
      $this->cinema_id = '';
      $this->name = '';
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
