<header>
  <nav class="header_nav_links">
    <!-- Icono y logo -->
    @if (Route::is('home') || $currentSection != '')
      <a href="#start" class="header_logo" wire:click="setSection('home')">
        <i class="fas fa-film"></i>
        <span>Movie Plus</span>
      </a>
    @else
      <a href="/" class="header_logo">
        <i class="fas fa-film"></i>
        <span>Movie Plus</span>
      </a>
    @endif
    @if (!request()->routeIs('register') && !request()->routeIs('login'))
      <div class="flex items-center gap-x-3 btn_menu_toggle">
        <!--botón toggle menú responsive-->
        <i class="fa-solid fa-bars btn_menu_toggle-open btn_menu-active" id="btnMenuOpen"></i>
        <i class="fa-solid fa-xmark btn_menu_toggle-close" id="btnMenuClose"></i>
        {{-- botón con imágen para dispositivos móbiles - administración usuario --}}
        <button id="dropdownmobile" data-dropdown-toggle="dropdownMobile"
                class="flex text-sm bg-gray-800 rounded-full md:hidden md:me-0 focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600"
                type="button">
          <span class="sr-only">Open user menu</span>
          {{-- <img class="w-8 h-8 rounded-full" src="/docs/images/people/profile-picture-3.jpg" alt="user photo"> --}}
          <img src="https://flowbite.com/docs/images/people/profile-picture-5.jpg"
               alt="{{ Auth::user()->name }}"
               class="z-10 w-8 border-2 rounded-md drop-shadow-[0px_2px_3px_rgba(0,0,0,0.7)] hover:grayscale">
        </button>
        {{-- dropdown usuario dispositivos mobiles --}}
        <div id="dropdownMobile"
             class="z-10 hidden border-2 border-gray-400 drop-shadow-[0px_6px_24px_rgba(0,0,0,0.1)] divide-y divide-gray-100 rounded-lg shadow-md w-44 dark:bg-[#923041] dark:divide-gray-400">
          <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownmobile">
            <li>
              <a href="#"
                 class="block px-4 py-2 text-white dark:hover:bg-[#911b2e] dark:hover:text-white">{{ Str::title(auth()->user()->name) }}</a>
            </li>
            <li>
              <a href="#"
                 class="block px-4 text-white py-2 dark:hover:bg-[#911b2e] dark:hover:text-white">{{ auth()->user()->email }}</a>
            </li>
            <li class="border-t-[1px] border-gray-400 mt-2">
              <a href="{{ route('dashboard') }}"
                 class="block px-4 py-2 mt-2 dark:hover:bg-[#911b2e] dark:hover:text-white">Administrar</a>
            </li>
            <li>
              <a href="#"
                 class="block px-4 py-2 dark:hover:bg-[#911b2e] dark:hover:text-white">Configuración</a>
            </li>
          </ul>
          <div class="py-2">
            <a href="#"
               class="block px-4 py-2 text-sm text-gray-700 dark:hover:bg-[#911b2e] dark:text-gray-200 dark:hover:text-white">Cerrar
              Sesión</a>
          </div>
        </div>
      </div>
      <!-- Links de navegación -->
      {{-- Mostrar solo si la ruta es home --}}
      <ul class="header_list_links mt-md-3" id="headerListLinks">
        @if (!Route::is('movies.detail'))
          <li class="header_items">
            <a href="#novelties"
               class="header_link {{ $currentSection === 'novelties' ? 'btn-link' : 'text-white' }}"
               wire:click="setSection('novelties')">Novedades</a>
          </li>
          <li class="header_items">
            <a href="#trends"
               class="header_link {{ $currentSection === 'trends' ? 'btn-link' : 'text-white' }}"
               wire:click="setSection('trends')">Tendencias</a>
          </li>
          <li class="header_items">
            <a href="#acclaimeds"
               class="header_link {{ $currentSection === 'acclaimeds' ? 'btn-link' : 'text-white' }}"
               wire:click="setSection('acclaimeds')">Aclamadas</a>
          </li>
        @endif
        @if (auth()->check())
          <li class="flex items-center header_items gap-x-2">
                        <span><img src="https://flowbite.com/docs/images/people/profile-picture-5.jpg"
                                   alt="{{ Auth::user()->name }}"
                                   class="w-10 hidden md:inline-flex border-2 rounded-md drop-shadow-[0px_2px_3px_rgba(0,0,0,0.7)] hover:grayscale"></span>
            <button id="dropdownMenuIconButton" data-dropdown-toggle="dropdownDots"
                    class="items-center hidden px-1 py-2 text-sm font-medium text-center rounded-lg md:inline-flex focus:ring-2 focus:outline-none dark:text-white dark:focus:ring-gray-200"
                    type="button">
              <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                   fill="currentColor" viewBox="0 0 4 15">
                <path
                  d="M3.5 1.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Zm0 6.041a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Zm0 5.959a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Z"/>
              </svg>
            </button>

            <!-- Dropdown menu -->
            <div id="dropdownDots"
                 class="z-10 hidden border-2 border-gray-400 drop-shadow-[0px_6px_24px_rgba(0,0,0,0.1)] divide-y divide-gray-100 rounded-lg shadow-md w-44 dark:bg-[#923041] dark:divide-gray-400">
              <ul class="py-2 text-sm text-gray-700 dark:text-gray-200"
                  aria-labelledby="dropdownMenuIconButton">
                <li>
                  <a href="#"
                     class="block px-4 py-2 text-white dark:hover:bg-[#911b2e] dark:hover:text-white">{{ Str::title(auth()->user()->name) }}</a>
                </li>
                <li>
                  <a href="#"
                     class="block px-4 text-white py-2 dark:hover:bg-[#911b2e] dark:hover:text-white">{{ auth()->user()->email }}</a>
                </li>
                <li class="border-t-[1px] border-gray-400 mt-2">
                  <a href="{{ route('dashboard') }}"
                     class="block px-4 py-2 mt-2 dark:hover:bg-[#911b2e] dark:hover:text-white">Administrar</a>
                </li>
                <li>
                  <a href="#"
                     class="block px-4 py-2 dark:hover:bg-[#911b2e] dark:hover:text-white">Configuración</a>
                </li>
              </ul>
              <div class="py-2">
                <a href="#"
                   class="block px-4 py-2 text-sm text-gray-700 dark:hover:bg-[#911b2e] dark:text-gray-200 dark:hover:text-white">Cerrar
                  Sesión</a>
              </div>
            </div>
          </li>

          {{--                <li class="header_items"> --}}
          {{--                    <a href="{{ route('dashboard') }}" class="btn-link btn-admin">Administrar</a> --}}
          {{--                </li> --}}
        @else
          <li class="header_items">
            <a href="{{ route('login') }}" class="header_link-login" wire:navigate>Iniciar Sesión</a>
          </li>
        @endif
      </ul>
    @endif
  </nav>
</header>
