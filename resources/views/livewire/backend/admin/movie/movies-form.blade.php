<div>
    <!-- Main modal -->
    <div id="crud-modal" tabindex="-1" aria-hidden="true"
        class="{{ !$openModal ? 'hidden' : '' }} overflow-y-auto overflow-x-hidden fixed z-50 justify-center bg-gray-900/95 content-center w-full inset-0 md:inset-0 max-h-full">
        <div class="relative max-w-xl max-h-full p-4 m-auto">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 border-b rounded-t md:p-5 dark:border-gray-600">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                        {{ $action === 'create' ? 'Agregar Película' : 'Modificar Película' }}
                    </h3>
                    <button type="button"
                        class="inline-flex items-center justify-center w-8 h-8 text-sm text-gray-400 bg-transparent rounded-lg hover:bg-gray-200 hover:text-gray-900 ms-auto dark:hover:bg-gray-600 dark:hover:text-white"
                        data-modal-toggle="crud-modal" wire:click="closeModal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <form class="p-4 md:p-5">
                    <div class="grid grid-cols-1 gap-4 mb-4">
                        {{-- Nombre --}}
                        <div class="mb-2 col">
                            <label for="title"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Título</label>
                            <input type="text" id="title"
                                class="@error('title') focus:ring-red-500 focus:border-red-500 dark:border-red-500 @enderror bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-900 dark:hover:bg-gray-800 dark:focus:bg-gray-900 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                wire:model="title">
                            @error('title')
                                <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                        {{--  descripción --}}
                        <div class="mb-2 col">
                            <label for="description"
                                class="@error('description') focus:ring-red-500 focus:border-red-500 dark:border-red-500 @enderror block mb-2 text-sm font-medium text-gray-900 dark:text-white">Descripción</label>
                            <textarea id="description" cols="30" rows="3"
                                class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-900 dark:hover:bg-gray-800 dark:border-gray-500 dark:focus:bg-gray-900 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500 @error('description') focus:ring-red-500 focus:border-red-500 dark:border-red-500 @enderror"
                                wire:model="description">
                            </textarea>
                            @error('description')
                                <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="grid grid-cols-1 mb-2 sm:grid-cols-2 sm:gap-x-3 gap-y-5 sm:gap-y-0">
                            {{--  géneros  --}}
                            <div class="col">
                                <label for="genres"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Género</label>
                                {{-- botón --}}
                                <button id="genresButton" data-dropdown-toggle="genres"
                                    class="@error('genres') dark:focus:ring-2 dark:focus:ring-red-500 focus:border-none dark:border-red-500 @enderror text-white justify-between w-full border dark:border-gray-500 focus:ring-2 focus:outline-none font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-gray-900 dark:hover:bg-gray-800 dark:focus:border-blue-600"
                                    type="button">Géneros
                                    <svg class="w-2.5 h-2.5 ms-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                        fill="none" viewBox="0 0 10 6">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="m1 1 4 4 4-4" />
                                    </svg>
                                </button>
                                <!-- Dropdown menu -->
                                <div id="genres"
                                    class="@error('genres') focus:ring-red-500 focus:border-red-500 dark:border-red-500 @enderror z-10 hidden divide-y divide-gray-100 rounded-lg shadow dark:bg-gray-900 dark:divide-gray-500 border-2 border-blue-600 w-[94%] sm:w-64">
                                    <ul class="py-2 overflow-scroll text-sm text-gray-700 dark:text-gray-200 max-h-72"
                                        aria-labelledby="genresButton">
                                        @forelse($genres_movie as $genre)
                                            <li>
                                                <label for="genre-{{ $genre->id }}"
                                                    class="flex items-center px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                                    <input id="genre-{{ $genre->id }}" type="checkbox"
                                                        wire:model="genres" value="{{ $genre->id }}"
                                                        class="w-4 h-4 text-blue-600 border-blue-300 rounded me-2 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-blue-800 focus:ring-1 dark:bg-blue-700 dark:border-blue-600">{{ $genre->name }}
                                                </label>
                                            </li>
                                        @empty
                                            <li class="px-4 py-2 dark:text-white">no disponibles</li>
                                        @endforelse
                                    </ul>
                                    <div class="py-2">
                                        <a href="{{ route('genres') }}"
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
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-900 dark:hover:bg-gray-800 dark:focus:bg-gray-900 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500 @error('language_id') focus:ring-red-500 focus:border-red-500 dark:border-red-500 @enderror">
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
                    <div class="grid grid-cols-1 mb-5 sm:grid-cols-3 sm:gap-x-3 gap-y-5 sm:gap-y-0">
                        {{-- Duración --}}
                        <div class="col">
                            <label for="duration"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Duración
                                (min)</label>
                            <input type="number" id="duration"
                                class="@error('duration') focus:ring-red-500 focus:border-red-500 dark:border-red-500 @enderror bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-900 dark:hover:bg-gray-800 dark:focus:bg-gray-900 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                wire:model="duration">
                            @error('duration')
                                <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                        {{-- año --}}
                        <div class="col">
                            <label for="year"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Año
                            </label>
                            <input type="number" id="year"
                                class="@error('year') focus:ring-red-500 focus:border-red-500 dark:border-red-500 @enderror bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-900 dark:hover:bg-gray-800 dark:focus:bg-gray-900 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                wire:model="year">
                            @error('year')
                                <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                        {{-- sección --}}
                        <div class="col">
                            <label for="section"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Sección
                            </label>
                            <select id="section"
                                class="@error('section') focus:ring-red-500 focus:border-red-500 dark:border-red-500 @enderror bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-900 dark:focus:bg-gray-900 dark:hover:bg-gray-800 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                wire:model="section">
                                <option value="" selected>Seleccionar</option>
                                <option value="general" selected>General</option>
                                <option value="novedades" selected>Novedades</option>
                                <option value="tendencias" selected>Tendencias</option>
                                <option value="aclamadas" selected>Aclamadas</option>
                            </select>
                            @error('section')
                                <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="grid grid-cols-1 mb-5 sm:grid-cols-2 gap-y-5 sm:gap-x-3 sm:gap-y-0">
                        {{--  actores  --}}
                        <div class="col">
                            <label for="actors"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Actores</label>
                            {{-- botón --}}
                            <button id="actorsButton" data-dropdown-toggle="actors"
                                class="@error('actors') dark:focus:ring-2 dark:focus:ring-red-500 focus:border-none dark:border-red-500 @enderror text-white justify-between w-full border dark:border-gray-500 focus:ring-2 focus:outline-none font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-gray-900 dark:hover:bg-gray-800 dark:focus:border-blue-600"
                                type="button">Actores
                                <svg class="w-2.5 h-2.5 ms-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    fill="none" viewBox="0 0 10 6">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m1 1 4 4 4-4" />
                                </svg>
                            </button>
                            <!-- Dropdown menu -->
                            <div id="actors"
                                class="@error('actors') focus:ring-red-500 focus:border-red-500 dark:border-red-500 @enderror z-10 hidden divide-y divide-gray-100 rounded-lg shadow dark:bg-gray-900 dark:divide-gray-500 border-2 border-blue-600 w-[94%] sm:w-64">
                                <ul class="py-2 overflow-scroll text-sm text-gray-700 dark:text-gray-200 max-h-72"
                                    aria-labelledby="actorsButton">
                                    @forelse($actors_movie as $actor)
                                        <li>
                                            <label for="actor-{{ $actor->id }}"
                                                class="flex items-center px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                                <input id="actor-{{ $actor->id }}" type="checkbox"
                                                    wire:model="actors" value="{{ $actor->id }}"
                                                    class="w-4 h-4 text-blue-600 border-blue-300 rounded me-2 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-blue-800 focus:ring-1 dark:bg-blue-700 dark:border-blue-600">{{ Str::title($actor->first_name . ' ' . $actor->last_name) }}
                                            </label>
                                        </li>
                                    @empty
                                        <li class="px-4 py-2 dark:text-white">no disponibles</li>
                                    @endforelse
                                </ul>
                                <div class="py-2">
                                    <a href="{{ route('actors') }}"
                                        class="block px-4 py-2 text-sm hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-cyan-400 dark:hover:text-white">Agregar
                                        actor
                                    </a>
                                </div>
                            </div>
                            @error('actors')
                                <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                        {{--  directores  --}}
                        <div class="col">
                            <label for="directors"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Directores</label>
                            {{-- botón --}}
                            <button id="directorsButton" data-dropdown-toggle="directors"
                                class="@error('directors') dark:focus:ring-2 dark:focus:ring-red-500 focus:border-none dark:border-red-500 @enderror text-white justify-between w-full border dark:border-gray-500 focus:ring-2 focus:outline-none font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-gray-900 dark:hover:bg-gray-800 dark:focus:border-blue-600"
                                type="button">Directores
                                <svg class="w-2.5 h-2.5 ms-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    fill="none" viewBox="0 0 10 6">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m1 1 4 4 4-4" />
                                </svg>
                            </button>
                            <!-- Dropdown menu -->
                            <div id="directors"
                                class="@error('directors') focus:ring-red-500 focus:border-red-500 dark:border-red-500 @enderror z-10 hidden divide-y divide-gray-100 rounded-lg shadow dark:bg-gray-900 dark:divide-gray-500 border-2 border-blue-600 w-[94%] sm:w-64">
                                <ul class="py-2 overflow-scroll text-sm text-gray-700 dark:text-gray-200 max-h-72"
                                    aria-labelledby="directorsButton">
                                    @forelse($directors_movie as $director)
                                        <li>
                                            <label for="director-{{ $director->id }}"
                                                class="flex items-center px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                                <input id="director-{{ $director->id }}" type="checkbox"
                                                    wire:model="directors" value="{{ $director->id }}"
                                                    class="w-4 h-4 text-blue-600 border-blue-300 rounded me-2 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-blue-800 focus:ring-1 dark:bg-blue-700 dark:border-blue-600">{{ Str::title($director->first_name . ' ' . $director->last_name) }}
                                            </label>
                                        </li>
                                    @empty
                                        <li class="px-4 py-2 dark:text-white">no disponibles</li>
                                    @endforelse
                                </ul>
                                <div class="py-2">
                                    <a href="{{ route('directors') }}"
                                        class="block px-4 py-2 text-sm hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-cyan-400 dark:hover:text-white">Agregar
                                        director
                                    </a>
                                </div>
                            </div>
                            @error('directors')
                                <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="grid grid-cols-1 mb-5 sm:grid-cols-2 gap-y-5 sm:gap-x-3 sm:gap-y-0">
                        {{-- estudio --}}
                        <div class="col">
                            <label for="cinema_id"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Estudio
                            </label>
                            <select id="cinema_id"
                                class="@error('cinema_id') focus:ring-red-500 focus:border-red-500 dark:border-red-500 @enderror bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-900 dark:focus:bg-gray-900 dark:hover:bg-gray-800 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                wire:model="cinema_id">
                                <option value="" selected>Seleccionar</option>
                                @forelse ($cinemas as $cinema)
                                    <option value="{{ $cinema->id }}">{{ $cinema->name }}</option>
                                @empty
                                    <option class="px-4 py-2 dark:text-white" disabled>no disponibles</option>
                                @endforelse
                            </select>
                            @error('cinema_id')
                                <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                        {{-- país --}}
                        <div class="col">
                            <label for="country_id"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">País
                            </label>
                            <select id="country_id"
                                class="@error('country_id') focus:ring-red-500 focus:border-red-500 dark:border-red-500 @enderror bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-900 dark:focus:bg-gray-900 dark:hover:bg-gray-800 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                wire:model="country_id">
                                <option value="" selected>Seleccionar</option>
                                @forelse ($countries as $country)
                                    <option value="{{ $country->id }}">{{ Str::title($country->name) }}</option>
                                @empty
                                    <option class="px-4 py-2 dark:text-white" disabled>no disponibles</option>
                                @endforelse
                            </select>
                            @error('country_id')
                                <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-5 col">
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                            for="image">Imágen</label>
                        <input
                            class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-900 dark:border-gray-600 dark:placeholder-gray-400"
                            aria-describedby="image_help" id="image" type="file" wire:model='image'
                            wire:change='changeImage'>
                        <p class="mt-1 text-xs text-gray-500 ms-1 dark:text-gray-400" id="image_help">SVG, PNG, JPG or
                            JPEG (MIN 500 x 750px) 1MB.</p>
                        @error('image')
                            <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="w-full mt-2 text-center rtl:text-center" wire:loading wire:target='image'>
                        <div role="status">
                            <svg aria-hidden="true"
                                class="inline w-10 h-10 text-gray-200 animate-spin dark:text-gray-600 fill-blue-500"
                                viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                                    fill="currentColor" />
                                <path
                                    d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                                    fill="currentFill" />
                            </svg>
                        </div>
                    </div>
                    {{-- Mostrar vista previa imágen --}}
                    @if ($imagePreview)
                        <div class="mt-2 mb-2 col" wire:loading.class='hidden' wire:target='image'>
                            <img src="{{ $image->temporaryURL() }}" alt="imágen previa"
                                class="object-cover w-full rounded-lg">
                        </div>
                    @endif
                    {{-- En modo edición mostrar imágen si existe --}}
                    @if (!$imagePreview && $action === 'edit' && $image)
                        <div class="mt-2 mb-2 col" wire:loading.class='hidden' wire:target='image'>
                            <img src="{{ asset('storage/movies/' . $image) }}" alt="{{ $title }}"
                                class="object-cover w-full rounded-lg">
                        </div>
                    @endif
                    <button type="button"
                        class="text-white inline-flex mt-5 w-full justify-center items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-800 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                        wire:click="store">
                        <i class="align-middle fa-regular fa-floppy-disk me-2"></i>
                        {{ $action === 'create' ? 'Guardar cambios' : 'Actualizar cambios' }}
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
