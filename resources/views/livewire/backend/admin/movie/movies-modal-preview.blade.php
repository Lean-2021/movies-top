<!-- Main modal -->
<div tabindex="-1" aria-hidden="true"
     class="{{$showPreview ? 'block' : 'hidden'}} overflow-y-auto overflow-x-hidden fixed z-50 place-content-center bg-gray-800/85 w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
  <div class="relative w-full max-w-lg max-h-full p-2 m-auto">
    <!-- Modal content -->
    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700 drop-shadow-lg">
      <!-- Modal header -->
      <div class="flex items-center justify-between p-2 border-b rounded-t md:p-2 dark:border-gray-600">
        <button type="button"
                class="inline-flex items-center justify-center w-8 h-8 text-sm text-gray-400 bg-transparent rounded-lg hover:bg-gray-200 hover:text-gray-900 ms-auto dark:hover:bg-gray-600 dark:hover:text-white"
                wire:click="closeModalPreview">
          <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
               viewBox="0 0 14 14">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
          </svg>
          <span class="sr-only">Close modal</span>
        </button>
      </div>
      <!-- Modal body -->
      @if($movie)
        <div class="p-2 space-y-4 md:p-5">
          <div
            class="w-full max-w-lg bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
            <div class="grid grid-cols-2 px-5 py-12 gap-x-8">
              <div>
                {{-- imágen --}}
                <div class="mb-3">
                  <img class="object-cover h-64 rounded-lg shadow-lg w-80"
                       {{--                     {{dd($movie)}}--}}
                       src="{{ $movie->image && Storage::exists('movies/' . $movie->image) ? asset('storage/movies/' . $movie->image) : asset('images/no-image.jpg') }}"
                       alt="{{ $movie->title }}"/>
                </div>
                {{-- descripción --}}
                <div class="mb-3">
                  <div class="group/description">
                    <p>Descripción:</p>
                    <p
                      class="mt-2 text-justify text-gray-400 transition-all duration-300 text-wrap line-clamp-3 group-hover/description:line-clamp-none">
                      {{ $movie->description }}
                    </p>
                  </div>
                </div>
              </div>
              <div>
                {{-- título --}}
                <h5 class="mb-2 text-xl font-medium text-gray-900 dark:text-white">
                  {{ Str::title($movie->title) }}
                </h5>
                {{-- duracion, puntaje --}}
                <div class="flex items-center mb-3">
                  <span>⭐⭐⭐</span>
                  <span class="text-gray-400 ms-2">{{ $movie->duration }} min</span>
                </div>
                {{-- idioma  --}}
                <p class="flex items-center mb-3">Idioma:<span
                    class="text-gray-400 ms-1">{{ Str::title($movie->language->name) }}</span><img
                    src="{{ asset('storage/flags/' . $movie->language->flag) }}" class="w-6 ms-2"
                    alt="{{ $movie->language->name }}">
                </p>
                {{-- año --}}
                <p class="mb-3">Año:<span class="text-gray-400 ms-1">{{ $movie->year }}</span></p>
                {{-- género --}}
                <p class="mb-3">Género:<span
                    class="text-gray-400 ms-1">{{ implode(' | ', $movie->genres()->pluck('name')->toArray()) }}</span>
                </p>
                {{-- votos --}}
                <p class="mb-3">Puntaje:<span class="text-gray-400 ms-1">-</span></p>
                {{-- sección --}}
                <p class="mb-3">Sección:<span
                    class="text-gray-400 ms-1">{{ Str::ucfirst($movie->section) }}</span></p>
                {{-- estudio --}}
                <p class="mb-3">Estudio:<span
                    class="text-gray-400 ms-1">{{ Str::title($movie->cinema->name) }}</span></p>
                {{-- país --}}
                <p class="flex items-center mb-3">País:<span
                    class="text-gray-400 ms-1">{{ Str::title($movie->country->name) }}</span><img
                    src="{{ asset('storage/flags/' . $movie->country->flag) }}" class="w-6 ms-2"
                    alt="{{ $movie->country->name }}">
                </p>
                {{-- estado --}}
                <p class="mb-3">
                  Estado:<span
                    class="ms-1 {{ $movie->status === 1 ? 'text-green-400' : 'text-red-400' }}">{{ $movie->status === 1 ? 'Activa' : 'Inactiva' }}</span>
                </p>
                {{-- actores --}}
                <p>Actores:</p>
                <ul class="mt-2 mb-3">
                  @forelse ($movie->actors as $actor)
                    <li class="text-gray-400 ms-2">
                      {{ Str::title($actor->first_name . ' ' . $actor->last_name) }}</li>
                  @empty
                    <li class="text-gray-400 ms-2">No disponible</li>
                  @endforelse
                </ul>
                {{-- directores --}}
                <p>Directores:</p>
                <ul class="mt-2 mb-3">
                  @forelse ($movie->directors as $director)
                    <li class="text-gray-400 ms-2">
                      {{ Str::title($director->first_name . ' ' . $director->last_name) }}</li>
                  @empty
                    <li class="text-gray-400 ms-2">No disponible</li>
                  @endforelse
                </ul>
              </div>
            </div>
          </div>
        </div>
      @endif
    </div>
  </div>
</div>
