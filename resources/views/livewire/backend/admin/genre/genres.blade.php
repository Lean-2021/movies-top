<x-slot name="title">
  Géneros
</x-slot>
<div>
  <section class="mt-20">
    <div class="flex justify-between mb-14 mt-10">
      <h1 class="text-2xl">Administración de Géneros</h1>
      <button wire:click="create" class="bg-gray-700 px-4 py-2 text-sm rounded hover:bg-gray-600"><i
          class="fa-regular fa-file me-2 align-middle"></i>Agregar
      </button>
    </div>
    <livewire:backend.admin.genre.genre-table/>
    @include('livewire.backend.admin.genre.genres-form')
  </section>
</div>
