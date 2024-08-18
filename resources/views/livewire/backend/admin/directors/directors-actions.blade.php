<div class="flex items-center justify-between">
    <button title="Vista Previa" wire:click="openPreview({{ $row }})"><i
            class="fa-regular fa-eye dark:text-slate-300 dark:hover:text-slate-400"></i></button>
    <button wire:click="edit({{ $row }})" title="Editar" class=""><i
            class="fa-regular fa-pen-to-square dark:text-cyan-600 dark:hover:text-cyan-700"></i></button>
    <button wire:click="$dispatch('delete',{{ $row }})" title="Eliminar" class=""><i
            class="fa-regular fa-trash-can dark:text-red-400 dark:hover:text-red-500"></i></button>

    {{--  Modal vista previa del usuario --}}
    @include('livewire.backend.admin.directors.directors-modal-preview')
</div>
