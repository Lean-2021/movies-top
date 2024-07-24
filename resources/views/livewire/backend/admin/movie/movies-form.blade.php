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
            {{ $action === 'create' ? 'Agregar Director' : 'Modificar Director' }}
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
            <div class="col mb-2">
              <label for="title"
                     class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Título</label>
              <input type="text" id="title"
                     class="@error('title') focus:ring-red-500 focus:border-red-500 dark:border-red-500 @enderror bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                     wire:model="title">
              @error('title')
              <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
              @enderror
            </div>
            {{--  descripción --}}
            <div class="col mb-2">
              <label for="description"
                     class="@error('description') focus:ring-red-500 focus:border-red-500 dark:border-red-500 @enderror block mb-2 text-sm font-medium text-gray-900 dark:text-white">descripción</label>
              <textarea id="description" cols="30" rows="3"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500 @error('description') focus:ring-red-500 focus:border-red-500 dark:border-red-500 @enderror"
                        wire:model="description">
              </textarea>
              @error('description')
              <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
              @enderror
            </div>
            {{--  géneros  --}}
            <div class="col mb-2">
              <div class="grid grid-cols-2 gap-x-3">
                <div class="col">
                  <label for="genres"
                         class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Género</label>
                  {{-- botón--}}
                  <button id="genresButton" data-dropdown-toggle="genres"
                          class="text-white justify-between w-full border dark:border-gray-500 focus:ring-2 focus:outline-none font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-gray-900 dark:hover:bg-gray-800 dark:focus:border-blue-600"
                          type="button">Géneros
                    <svg class="w-2.5 h-2.5 ms-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                         viewBox="0 0 10 6">
                      <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 4 4 4-4"/>
                    </svg>
                  </button>
                  <!-- Dropdown menu -->
                  <div id="genres"
                       class="z-10 hidden divide-y divide-gray-100 rounded-lg shadow dark:bg-gray-900 dark:divide-gray-500 border-2 border-blue-600 w-64">
                    <ul
                      class="py-2 text-sm text-gray-700 dark:text-gray-200 max-h-72 overflow-scroll"
                      aria-labelledby="genresButton">
                      @forelse($genres as $genre)
                        <li>
                          <label for="genre-{{$genre->id}}"
                                 class="flex items-center px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                            <input id="genre-{{$genre->id}}" type="checkbox" wire:model="{{$genres}}"
                                   class="w-4 h-4 me-2 text-blue-600 border-blue-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-blue-800 focus:ring-1 dark:bg-blue-700 dark:border-blue-600">Comedia
                          </label>
                        </li>
                      @empty
                        <li class="px-4 py-2 dark:text-white">no disponibles</li>
                      @endforelse
                    </ul>
                    <div class="py-2">
                      <a href="#"
                         class="block px-4 py-2 text-sm hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-cyan-400 dark:hover:text-white">Agregar
                        género
                      </a>
                    </div>
                  </div>
                  @error('genres')
                  <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                  @enderror
                </div>
                {{--  Idioma  --}}
                <div class="col">
                  <label for="language_id"
                         class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Idioma</label>
                  <select id="language_id" wire:model="language_id"
                          class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-900 dark:hover:bg-gray-800 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500 @error('language_id') focus:ring-red-500 focus:border-red-500 dark:border-red-500 @enderror">
                    <option selected="">Seleccione un idioma</option>
                    @foreach ($languages as $language)
                      <option value="{{ $language->id }}">
                        {{ \Illuminate\Support\Str::title($language->name) }}</option>
                    @endforeach
                  </select>
                  @error('language_id')
                  <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                  @enderror
                </div>
              </div>
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
