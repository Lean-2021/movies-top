<div class="flex justify-between items-center">
  <button title="Vista Previa" data-modal-toggle="actors{{$row}}-card" data-modal-target="actors{{$row}}-card"
          class=""><i
      class="fa-regular fa-eye dark:text-slate-300 dark:hover:text-slate-400"></i></button>
  <button wire:click="edit({{$row}})" title="Editar" class=""><i
      class="fa-regular fa-pen-to-square dark:text-cyan-600 dark:hover:text-cyan-700"></i></button>
  <button wire:click="$dispatch('delete',{{$row}})" title="Eliminar" class=""><i
      class="fa-regular fa-trash-can dark:text-red-400 dark:hover:text-red-500"></i></button>

  {{--  Modal vista previa del usuario --}}
  @include('livewire.backend.admin.actor.actors-modal-preview')
</div>

