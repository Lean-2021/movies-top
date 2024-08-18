@section('title', $movie->title)

<div class="container mx-auto detail_container">
    <div class="grid grid-cols-1 p-10 md:grid-cols-2 md:gap-x-10 lg:gap-x-2">
        <div>
            <img src="{{ $movie->image && storage_path('movies/' . $movie->image) ? asset('storage/movies/' . $movie->image) : asset('images/no-available.png') }}"
                alt="imágen de la película"
                class="image_detail object-cover object-center w-full m-auto rounded-lg h-[600px] md:w-96">
        </div>
        @php
            $movies_votes = $movies_votes ?? [];
        @endphp
        <div class="mt-10 md:mt-0">
            <h1 class="mb-3 text-3xl">{{ Str::title($movie->title) }}</h1>
            <p class="mb-3">{{ stars_movies($votes) }} <span class="text-gray-400">({{ $votes }}
                    {{ $votes === 1 ? ' voto' : ' votos' }})</span><button class="disabled:cursor-not-allowed"
                    @if (Auth::check()) wire:click='add_votes({{ $movie->id }}) @else wire:click='redirectLogin' @endif
                    {{ in_array($movie->id, $movies_votes ?? []) ? 'disabled' : '' }}><i
                        class="align-middle ms-2 {{ in_array($movie->id, $movies_votes ?? []) ? 'fa-solid text-red-500' : 'fa-regular' }} fa-heart"></i></button>
                @if (in_array($movie->id, $movies_votes ?? []))
                    <span class="text-gray-400">Ya votaste!</span>
                @endif
            </p>
            <p class="mb-3">Año: <span class="text-gray-400">{{ $movie->year }}</span></p>
            <p class="mb-3">Duración: <span class="text-gray-400">{{ $movie->duration }} min</span></p>
            <p class="mb-3">Género: <span
                    class="text-gray-400">{{ implode(' | ', $movie->genres->pluck('name')->toArray()) }}</span>
            </p>
            <p class="flex mb-3">Idioma Original: <span
                    class="flex text-gray-400 ms-1">{{ Str::title($movie->language->name) }}
                    <img src="{{ asset('storage/flags/' . $movie->language->flag) }}" class="w-8 h-6 rounded ms-2"
                        alt="{{ $movie->language->name }}"></span></p>
            <p class="mb-3">Actores: <span class="text-gray-400">
                    {{ implode(', ', $movie->actors->pluck('full_name')->toArray()) }}</span>
            </p>
            <p class="mb-3">Dirección: <span
                    class="text-gray-400">{{ implode(', ', $movie->directors->pluck('full_name')->toArray()) }}</span>
            </p>
            <p class="mb-3">Estudio: <span class="text-gray-400">{{ Str::title($movie->cinema->name) }}</span></p>
            <p class="flex mb-3">País de Orígen: <span
                    class="flex text-gray-400 ms-1">{{ Str::title($movie->country->name) }}
                    <img src="{{ asset('storage/flags/' . $movie->country->flag) }}" class="w-8 h-6 rounded ms-2"
                        alt="{{ $movie->country->name }}"></span></p>
            <span wire:click='changeShowDescription' class="mb-3 text-gray-400 cursor-pointer hover:text-gray-300">Ver
                Detalles <i
                    class="text-gray-400 {{ $showDescription ? '-rotate-180 align-middle' : 'rotate-0' }} transition-transform duration-300 fa-solid fa-caret-down"></i></span>
            <p class="{{ $showDescription ? 'block' : 'hidden' }} mt-2 text-gray-300 transition-opacity duration-500">
                {{ Str::ucfirst($movie->description) }}</p>
        </div>
    </div>
</div>
