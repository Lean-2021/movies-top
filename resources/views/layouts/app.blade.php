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
        crossorigin="anonymous" referrerpolicy="no-referrer"/>
  {{-- Icono pestaña --}}
  <link rel="shortcut icon" href="{{ asset('images/film.ico') }}" type="image/x-icon">

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.bunny.net">
  <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet"/>
  <!-- Fuente Nunito - Google Fonts -->
  <link rel="pre<connect" href="https://fonts.googleapis.com"/>
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin/>
  <link href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,200..1000;1,200..1000&display=swap"
        rel="stylesheet"/>

  <!-- Animate CSS - animaciones -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

  <!-- Scripts -->
  @vite(['resources/css/app.css', 'resources/js/app.js'])

  <!-- Styles -->
  @livewireStyles
</head>

<body class="font-sans antialiased">
{{--    <x-banner />--}}

<div class="min-h-screen bg-gray-100 dark:bg-gray-900">
  {{-- @livewire('navigation-menu') --}}

  <!-- Page Heading -->
  {{-- @if (isset($header))
          <header class="bg-white dark:bg-gray-800 shadow">
              <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                  {{ $header }}
              </div>
          </header>
      @endif --}}

  <!-- Page Content -->
  <!-- Encabezado - logo - nombre y menú -->
  {{--        <header>--}}
  <livewire:navbar/>
  {{--        </header>--}}
  <!-- Fin encabezado-->
  <!-- Contenido principal del sitio -->
  <main>
    {{ $slot }}
  </main>
</div>

@stack('modals')

@livewireScripts
</body>

</html>
