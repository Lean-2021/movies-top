<x-slot name="title">
    Panel Admin
</x-slot>
<div>
    {{--  Peliculas --}}
    <div class="grid gap-5 mt-20 lg:grid-cols-2">
        <div class="p-6 rounded-lg drop-shadow-[0px_8px_4px_rgba(0,0,0,0.5)] hover:bg-indigo-800 dark:bg-indigo-700">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="stroke-2 size-6 stroke-slate-300">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="m15.75 10.5 4.72-4.72a.75.75 0 0 1 1.28.53v11.38a.75.75 0 0 1-1.28.53l-4.72-4.72M4.5 18.75h9a2.25 2.25 0 0 0 2.25-2.25v-9a2.25 2.25 0 0 0-2.25-2.25h-9A2.25 2.25 0 0 0 2.25 7.5v9a2.25 2.25 0 0 0 2.25 2.25Z" />
            </svg>
            <div class="flex items-end justify-between mb-2">
                <h5 class="text-2xl font-semibold tracking-tight text-gray-900 dark:text-white">Películas
                </h5>
                <span class="text-3xl font-semibold">{{ count($movies) }}</span>
            </div>
            {{--    <p class="mb-3 font-normal text-gray-500 dark:text-slate-200">Panel de administración de películas</p> --}}
            <a href="{{ route('movies') }}" class="inline-flex items-center font-medium text-slate-100 hover:underline">
                Ver detalles
                <svg class="w-3 h-3 ms-2.5 rtl:rotate-[270deg]" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    fill="none" viewBox="0 0 18 18">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M15 11v4.833A1.166 1.166 0 0 1 13.833 17H2.167A1.167 1.167 0 0 1 1 15.833V4.167A1.166 1.166 0 0 1 2.167 3h4.618m4.447-2H17v5.768M9.111 8.889l7.778-7.778" />
                </svg>
            </a>
        </div>

        {{--  Géneros --}}
        <div class="p-6 rounded-lg drop-shadow-[0px_8px_4px_rgba(0,0,0,0.5)] hover:bg-teal-800 dark:bg-teal-700">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="stroke-2 size-6 stroke-slate-300">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="m3.75 13.5 10.5-11.25L12 10.5h8.25L9.75 21.75 12 13.5H3.75Z" />
            </svg>

            <div class="flex items-end justify-between mb-2">
                <h5 class="text-2xl font-semibold tracking-tight text-gray-900 dark:text-white">Géneros
                </h5>
                <span class="text-3xl font-semibold">{{ count($genres) }}</span>
            </div>
            {{--    <p class="mb-3 font-normal text-gray-500 dark:text-slate-200">Panel de administración de películas</p> --}}
            <a href="{{ route('genres') }}" class="inline-flex items-center font-medium text-slate-100 hover:underline">
                Ver detalles
                <svg class="w-3 h-3 ms-2.5 rtl:rotate-[270deg]" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    fill="none" viewBox="0 0 18 18">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M15 11v4.833A1.166 1.166 0 0 1 13.833 17H2.167A1.167 1.167 0 0 1 1 15.833V4.167A1.166 1.166 0 0 1 2.167 3h4.618m4.447-2H17v5.768M9.111 8.889l7.778-7.778" />
                </svg>
            </a>
        </div>

        {{--  Directores --}}
        <div class="p-6 rounded-lg drop-shadow-[0px_8px_4px_rgba(0,0,0,0.5)] hover:bg-violet-800 dark:bg-violet-700">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="stroke-2 size-6 stroke-slate-300">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
            </svg>
            <div class="flex items-end justify-between mb-2">
                <h5 class="text-2xl font-semibold tracking-tight text-gray-900 dark:text-white">Directores
                </h5>
                <span class="text-3xl font-semibold">{{ count($directors) }}</span>
            </div>
            {{--    <p class="mb-3 font-normal text-gray-500 dark:text-slate-200">Panel de administración de películas</p> --}}
            <a href="{{ route('directors') }}"
                class="inline-flex items-center font-medium text-slate-100 hover:underline">
                Ver detalles
                <svg class="w-3 h-3 ms-2.5 rtl:rotate-[270deg]" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    fill="none" viewBox="0 0 18 18">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M15 11v4.833A1.166 1.166 0 0 1 13.833 17H2.167A1.167 1.167 0 0 1 1 15.833V4.167A1.166 1.166 0 0 1 2.167 3h4.618m4.447-2H17v5.768M9.111 8.889l7.778-7.778" />
                </svg>
            </a>
        </div>
        {{--  Estudios --}}
        <div class="p-6 rounded-lg drop-shadow-[0px_8px_4px_rgba(0,0,0,0.5)] hover:bg-sky-800 dark:bg-sky-700">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="stroke-2 size-6 stroke-slate-300">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M2.25 21h19.5m-18-18v18m10.5-18v18m6-13.5V21M6.75 6.75h.75m-.75 3h.75m-.75 3h.75m3-6h.75m-.75 3h.75m-.75 3h.75M6.75 21v-3.375c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21M3 3h12m-.75 4.5H21m-3.75 3.75h.008v.008h-.008v-.008Zm0 3h.008v.008h-.008v-.008Zm0 3h.008v.008h-.008v-.008Z" />
            </svg>

            <div class="flex items-end justify-between mb-2">
                <h5 class="text-2xl font-semibold tracking-tight text-gray-900 dark:text-white">Estudios
                </h5>
                <span class="text-3xl font-semibold">{{ count($cinemas) }}</span>
            </div>
            {{--    <p class="mb-3 font-normal text-gray-500 dark:text-slate-200">Panel de administración de películas</p> --}}
            <a href="{{ route('cinemas') }}"
                class="inline-flex items-center font-medium text-slate-100 hover:underline">
                Ver detalles
                <svg class="w-3 h-3 ms-2.5 rtl:rotate-[270deg]" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    fill="none" viewBox="0 0 18 18">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M15 11v4.833A1.166 1.166 0 0 1 13.833 17H2.167A1.167 1.167 0 0 1 1 15.833V4.167A1.166 1.166 0 0 1 2.167 3h4.618m4.447-2H17v5.768M9.111 8.889l7.778-7.778" />
                </svg>
            </a>
        </div>
        {{--  Actores --}}
        <div class="p-6 rounded-lg drop-shadow-[0px_8px_4px_rgba(0,0,0,0.5)] hover:bg-orange-800 dark:bg-orange-700">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="stroke-2 size-6 stroke-slate-300">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.94-3.197a5.971 5.971 0 0 0-.94 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z" />
            </svg>

            <div class="flex items-end justify-between mb-2">
                <h5 class="text-2xl font-semibold tracking-tight text-gray-900 dark:text-white">Actores
                </h5>
                <span class="text-3xl font-semibold">{{ count($actors) }}</span>
            </div>
            <a href="{{ route('actors') }}"
                class="inline-flex items-center font-medium text-slate-100 hover:underline">
                Ver detalles
                <svg class="w-3 h-3 ms-2.5 rtl:rotate-[270deg]" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    fill="none" viewBox="0 0 18 18">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M15 11v4.833A1.166 1.166 0 0 1 13.833 17H2.167A1.167 1.167 0 0 1 1 15.833V4.167A1.166 1.166 0 0 1 2.167 3h4.618m4.447-2H17v5.768M9.111 8.889l7.778-7.778" />
                </svg>
            </a>
        </div>
    </div>
</div>
