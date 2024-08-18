<x-slot name="title">
    Peliculas
</x-slot>
<div>
    <section class="mt-20">
        <div class="flex flex-col mt-10 md:justify-between md:flex-row mb-14">
            <h1 class="order-2 mt-5 text-2xl md:order-1 md:mt-0">Administración de Peliculas</h1>
            <button wire:click="create"
                class="flex items-center self-end justify-center order-1 px-4 py-2 text-sm bg-gray-700 rounded md:order-2 w-28 md:w-auto hover:bg-gray-600"><i
                    class="align-middle fa-regular fa-file me-2"></i>Agregar
            </button>
        </div>
        {{-- Incluir tabla  --}}
        <livewire:backend.admin.movie.movie-table />
        {{-- Incluir formulario de registro   --}}
        @include('livewire.backend.admin.movie.movies-form')
    </section>
</div>
