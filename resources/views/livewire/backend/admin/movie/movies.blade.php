<x-slot name="title">
  Peliculas
</x-slot>
<div>
  <section class="mt-20">
    <div class="flex justify-between mb-14 mt-10">
      <h1 class="text-2xl">Administración de Peliculas</h1>
      <button wire:click="create" class="bg-gray-700 px-4 py-2 text-sm rounded hover:bg-gray-600"><i
          class="fa-regular fa-file me-2 align-middle"></i>Agregar
      </button>
    </div>
    <livewire:backend.admin.movie.movie-table/>
    @include('livewire.backend.admin.movie.movies-form')
  </section>
</div>
