<div>
  <!-- Main modal -->
  <div id="crud-modal" tabindex="-1" aria-hidden="true"
       class="{{ !$openModal ? 'hidden' : '' }} overflow-y-auto overflow-x-hidden fixed z-50 justify-center bg-gray-900/95 content-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 max-w-xl max-h-full m-auto">
      <!-- Modal content -->
      <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
        <!-- Modal header -->
        <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
          <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
            {{ $action === 'create' ? 'Agregar Estudio' : 'Modificar Estudio' }}
          </h3>
          <button type="button"
                  class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                  data-modal-toggle="crud-modal" wire:click="closeModal">
            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                 viewBox="0 0 14 14">
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
            </svg>
            <span class="sr-only">Close modal</span>
          </button>
        </div>
        <!-- Modal body -->
        <form class="p-4 md:p-5">
          <div class="grid gap-4 mb-4 grid-cols-1">
            {{-- Nombre --}}
            <div class="col">
              <label for="name"
                     class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nombre</label>
              <input type="text" id="name"
                     class="@error('name') focus:ring-red-500 focus:border-red-500 dark:border-red-500 @enderror bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                     wire:model="name">
              @error('name')
              <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
              @enderror
            </div>
            {{--  Pais  --}}
            <div class="col">
              <label for="country"
                     class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">País</label>
              <select id="country" wire:model="country_id"
                      class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500 @error('last_name') focus:ring-red-500 focus:border-red-500 dark:border-red-500 @enderror">
                <option selected="">Seleccione un país</option>
                @foreach ($countries as $country)
                  <option value="{{ $country->id }}">
                    {{ \Illuminate\Support\Str::title($country->name) }}</option>
                @endforeach
              </select>
              @error('country_id')
              <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
              @enderror
            </div>
          </div>
          <button type="button"
                  class="text-white inline-flex mt-5 w-full justify-center items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-800 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                  wire:click="store">
            <i class="fa-regular fa-floppy-disk me-2 align-middle"></i>
            {{ $action === 'create' ? 'Guardar cambios' : 'Actualizar cambios' }}
          </button>
        </form>
      </div>
    </div>
  </div>
</div>
