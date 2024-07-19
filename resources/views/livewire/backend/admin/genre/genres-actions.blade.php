<div class="flex justify-center gap-x-5 items-center">
  <button wire:click="edit({{ $row }})" title="Editar"><i
      class="fa-regular fa-pen-to-square dark:text-cyan-600 dark:hover:text-cyan-700"></i></button>
  <button wire:click="$dispatch('delete',{{$row}})" title="Eliminar"><i
      class="fa-regular fa-trash-can dark:text-red-400 dark:hover:text-red-500"></i></button>
</div>
