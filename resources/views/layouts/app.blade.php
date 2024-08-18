<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark html_front" id="start">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>CAC-MOVIES | @yield('title')</title>

        {{-- Font Awesome --}}
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
            integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
            crossorigin="anonymous" referrerpolicy="no-referrer" />
        {{-- Icono pestaña --}}
        <link rel="shortcut icon" href="{{ asset('images/film.ico') }}" type="image/x-icon">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <!-- Fuente Nunito - Google Fonts -->
        <link rel="pre<connect" href="https://fonts.googleapis.com" />
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
        <link href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,200..1000;1,200..1000&display=swap"
            rel="stylesheet" />

        <!-- Animate CSS - animaciones -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Styles -->
        @livewireStyles
    </head>

    <body class="font-sans antialiased">
        {{--    <x-banner /> --}}

        <div>
            {{-- @livewire('navigation-menu') --}}

            <!-- Page Heading -->
            {{-- @if (isset($header))
          <header class="bg-white shadow dark:bg-gray-800">
              <div class="px-4 py-6 mx-auto max-w-7xl sm:px-6 lg:px-8">
                  {{ $header }}
              </div>
          </header>
      @endif --}}

            <!-- Page Content -->
            <!-- Encabezado - logo - nombre y menú -->
            {{--        <header> --}}
            <livewire:navbar />
            {{--        </header> --}}
            <!-- Fin encabezado-->
            <!-- Contenido principal del sitio -->
            <main class="min-h-screen">
                {{ $slot }}
            </main>
        </div>

        <footer>
            <!-- links de navagación - footer -->
            <div class="container relative h-auto py-2 mx-auto md:h-32">
                <nav class="flex items-center justify-center w-full py-10 mx-auto">
                    <ul
                        class="flex flex-col items-center justify-center w-full footer_list_links sm:flex-row gap-y-5 sm:gap-y-0 sm:justify-around">
                        <li class="footer_item">
                            <a href="#" class="footer_link">Términos y condiciones</a>
                        </li>
                        <li class="footer_item">
                            <a href="#" class="footer_link">Preguntas frecuentes</a>
                        </li>
                        <li class="footer_item">
                            <a href="#" class="footer_link">Ayuda</a>
                        </li>
                        <li class="footer_item">
                            <a href="#" class="footer_link">Contáctanos</a>
                        </li>
                    </ul>
                </nav>

                <!-- CopyRight -->
                <div class="absolute bottom-0 w-full text-center">
                    <p class="footer_copyRight">&copy; CAC - Leandro Wagner - 2024</p>
                </div>
            </div>

            @if (Route::is('home'))
                <!-- Botón ir arriba-->
                <a class="btn_top" id="btnTop" wire:click="$dispatch('clean-section')">
                    <img src="./images/flecha-hacia-arriba.svg" alt="Ir arriba flecha" class="btn_top_image" />
                </a>
            @endif
        </footer>



        @stack('modals')

        @livewireScripts
        <script src="https://cdn.jsdelivr.net/npm/flowbite@2.4.1/dist/flowbite.min.js"></script>
    </body>

</html>
