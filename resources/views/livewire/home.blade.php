@section('title', 'Inicio')
<div>

    <main class="main_container" id="mainContainer">
        <!-- Registrarse -->
        <section class="main_register animate__animated animate__zoomIn animate_faster">
            <h1 class="main_register-title">
                Películas y series ilimitadas
                <br />
                en un solo lugar
            </h1>
            <h2 class="main_register-subTitle no-margin">
                Disfruta donde quieras.
            </h2>
            <h2 class="main_register-subTitle">
                Cancela en cualquier momento.
            </h2>
            @if (!Auth::check())
                <a href="{{ route('register') }}" class="main_register_btn" wire:navigate>Registrate</a>
            @endif
        </section>

        <!-- Buscar películas -->
        <section class="container py-24 text-center main_search_container">
            <h2 class="main_search_title">¿Qué estas buscando para ver?</h2>
            <!-- Formulario para buscar películas -->
            <div class="container max-w-xl mx-auto">
                <form class="flex flex-col items-center justify-center gap-4 px-10 mt-4 sm:flex-row sm:px-0">
                    <input type="search" wire:model.live="search" id="search" placeholder="Buscar..."
                        class="w-full relative h-12 rounded-md text-black px-5 border-4 border-[#9f3647] focus:border-2 focus:border-[#9f3647] focus:ring-2 focus:ring-[#9f3647] hover:ring-2 hover:ring-[#9f3647]" />
                    <button type="button" value="Buscar" wire:click='searchByTitle' @disabled(!$search || count($searchMovies) === 0)
                        class="{{ $showResult && $search !== '' ? 'hidden' : 'block' }} w-full h-12 border-2 rounded-md main_search_btn border-slate-50 sm:w-24 disabled:opacity-50 disabled:cursor-not-allowed">
                        <span class="-ms-1">Buscar</span>
                    </button>
                </form>
                @if ($search && $showResult)
                    <section class="p-2 mx-10 text-left bg-white rounded-md sm:mx-0">
                        <ul class="text-gray-600 ms-2">
                            @foreach ($searchMovies as $movie)
                                <li class="cursor-pointer hover:text-gray-900"
                                    wire:click="searchSelected('{{ $movie->title }}')">
                                    {{ $movie->title }}
                                </li>
                            @endforeach
                        </ul>
                    </section>
                @endif
            </div>
            @if (!$showResult && $search && count($searchMovies) === 0)
                <p class="mt-10 text-xl text-center text-gray-300">No existen coincidencias para el término:
                    {{ $search }}</p>
            @endif
        </section>

        <!-- Separar sección con línea -->
        <hr class="line_divisor" />
        <section class="invisible" id="goToSearch"></section>
        @if (!$showResult && count($moviesSearch) > 0)
            {{-- sección search --}}
            <section class="container grid min-h-screen grid-cols-1 mx-auto my-24 search-container"
                id="searchContainer">
                <h3 class="m-auto text-3xl text-center sm:text-4xl 2xl:text-6xl">Resultados</h3>
                <h4 class="px-20 mt-4 text-lg text-center md:px-0">Resultados para la búsqueda con el término: <span
                        class="text-gray-300">{{ $searchResult }}</span><button title="borrar resultados"
                        wire:click='cleanSearch'><i
                            class="text-red-500 align-middle ms-2 fa-solid fa-xmark"></i></button>
                </h4>
                {{-- card de película --}}
                <div class="flex flex-wrap justify-center gap-16 mb-24 mt-14 align-center">
                    @foreach ($moviesSearch as $movie)
                        <div class="trend_container w-[15rem]">
                            <a href="{{ route('movies.detail', $movie->id) }}" class="trend_container_link">
                                <img src="./images/peliculas/peli_1.jpg" alt="The Beekeeper" class="trend_image" />
                                <div class="trend_container-hover">
                                    <h4 class="trend_title-hover" title="The Beekeeper">
                                        The Beekeeper
                                    </h4>
                                    <p class="trend_review-hover">⭐⭐⭐</p>
                                    <img src="./images/film.ico" alt="icono pelicula" class="-mt-2 trend_image-hover" />
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </section>
            <!-- Separar sección con línea -->
            <hr class="line_divisor" />
        @endif

        {{-- Sección Novedades --}}
        <section class="container grid min-h-screen grid-cols-1 mx-auto my-24 novelties-container" id="novelties">
            <h3 class="m-auto text-3xl text-center sm:text-4xl 2xl:text-6xl">Novedades</h3>
            <div class="flex flex-wrap justify-center gap-16 my-24 align-center">
                @forelse ($moviesNovelties as $movie)
                    <div class="trend_container w-[15rem]">
                        <a href="{{ route('movies.detail', $movie->id) }}" class="trend_container_link">
                            <img src="{{ $movie->image && asset('storage/movies/' . $movie->image) ? asset('storage/movies/' . $movie->image) : asset('images/no-image.jpg') }}"
                                alt="{{ $movie->title }}" class="trend_image" />
                            <div class="trend_container-hover">
                                <h4 class="trend_title-hover" title="{{ Str::title($movie->title) }}">
                                    {{ Str::title($movie->title) }}
                                </h4>
                                <p class="trend_review-hover">⭐⭐⭐</p>
                                <img src="{{ $movie->image && asset('storage/movies/' . $movie->image) ? asset('storage/movies/' . $movie->image) : asset('images/no-image.jpg') }}"
                                    alt="{{ $movie->title }}" class="trend_image-hover" />
                            </div>
                        </a>
                    </div>
                @empty
                    <h3 class="mt-5 text-xl">Próximamente contenido disponible en novedades</h3>
                @endforelse
                {{-- <div class="trend_container w-[15rem]">
                    <a href="#" class="trend_container_link">
                        <img src="./images/peliculas/peli_1.jpg" alt="The Beekeeper" class="trend_image" />
                        <div class="trend_container-hover">
                            <h4 class="trend_title-hover" title="The Beekeeper">
                                The Beekeeper
                            </h4>
                            <p class="trend_review-hover">⭐⭐⭐</p>
                            <img src="./images/film.ico" alt="icono pelicula" class="-mt-2 trend_image-hover" />
                        </div>
                    </a>
                </div> --}}
                {{-- <div class="trend_container w-[15rem]">
                    <a href="#" class="trend_container_link">
                        <img src="./images/peliculas/peli_1.jpg" alt="The Beekeeper" class="trend_image" />
                        <div class="trend_container-hover">
                            <h4 class="trend_title-hover" title="The Beekeeper">
                                The Beekeeper
                            </h4>
                            <p class="trend_review-hover">⭐⭐⭐</p>
                            <img src="./images/film.ico" alt="icono pelicula" class="-mt-2 trend_image-hover" />
                        </div>
                    </a>
                </div> --}}
                {{-- <div class="trend_container w-[15rem]">
                    <a href="#" class="trend_container_link">
                        <img src="./images/peliculas/peli_1.jpg" alt="The Beekeeper" class="trend_image" />
                        <div class="trend_container-hover">
                            <h4 class="trend_title-hover" title="The Beekeeper">
                                The Beekeeper
                            </h4>
                            <p class="trend_review-hover">⭐⭐⭐</p>
                            <img src="./images/film.ico" alt="icono pelicula" class="-mt-2 trend_image-hover" />
                        </div>
                    </a>
                </div> --}}
                {{-- <div class="trend_container w-[15rem]">
                    <a href="#" class="trend_container_link">
                        <img src="./images/peliculas/peli_1.jpg" alt="The Beekeeper" class="trend_image" />
                        <div class="trend_container-hover">
                            <h4 class="trend_title-hover" title="The Beekeeper">
                                The Beekeeper
                            </h4>
                            <p class="trend_review-hover">⭐⭐⭐</p>
                            <img src="./images/film.ico" alt="icono pelicula" class="-mt-2 trend_image-hover" />
                        </div>
                    </a>
                </div> --}}
            </div>
        </section>

        <!-- Separar sección con línea -->
        <hr class="line_divisor" />

        <!-- Sección de películas Tendencias-->
        <!-- Contenedor Tendencias -->
        <section class="container grid min-h-screen grid-cols-1 mx-auto my-24 trends_container" id="trends">

            <h3 class="text-3xl text-center sm:text-4xl 2xl:text-6xl">Las tendencias de hoy</h3>

            <!-- Contenedor Películas    -->
            <div class="flex flex-wrap justify-center my-24 align-center gap-14">
                <!-- Pelicula 1 -->
                @forelse ($moviesTrends as $movieTrend)
                    <div class="trend_container">
                        <a href="{{ route('movies.detail', $movieTrend->id) }}" class="trend_container_link">
                            <img src="{{ asset('storage/movies/' . $movieTrend->image) }}"
                                alt="{{ $movieTrend->title }}" class="trend_image" />
                            <div class="trend_container-hover">
                                <h4 class="trend_title-hover" title="The Beekeeper">
                                    {{ Str::title($movieTrend->title) }}
                                </h4>
                                <p class="trend_review-hover">⭐⭐⭐</p>
                                <img src="{{ asset('storage/movies/' . $movieTrend->image) }}"
                                    alt="{{ $movieTrend->title }}" class="trend_image-hover" />
                            </div>
                        </a>
                    </div>
                @empty
                    <h3 class="mt-5 text-xl">Próximamente contenido disponible en tendencias</h3>
                @endforelse
            </div>
            <!-- Fin peliculas tendencias-->
            <!-- Botones anterior - siguiente -->
            <div class="flex items-center justify-center gap-4 my-12">
                <button class="main_trends_btn disabled:opacity-50 disabled:cursor-not-allowed" id="btnTrendPrev"
                    wire:click='prevPage' @disabled($moviesTrends->onFirstPage())>Anterior</button>
                <button class="main_trends_btn disabled:cursor-not-allowed disabled:opacity-50" id="btnTrendNext"
                    wire:click='nextPage' @disabled(!$moviesTrends->hasMorePages())>Siguiente</button>
            </div>
        </section>
        <!-- Fin contenedor tendencias -->

        <!-- Separar sección con línea -->
        <hr class="line_divisor" />

        <!-- Las más aclamadas -->
        <section
            class="container relative grid grid-cols-1 mx-auto overflow-hidden sm:min-h-screen main_acclaimed my-28 sm:my-10"
            id="acclaimeds">
            <h3 class="m-auto text-3xl text-center sm:text-4xl 2xl:text-6xl">Las más aclamadas</h3>

            <!-- Contenedor aclamadas -->
            <div class="flex gap-[1rem] my-16 sm:my-0 sm:gap-[2rem] items-start acclaimeds_container px-3 sm:px-0 group/acclaimeds"
                id="acclaimedsContainer">
                <div class="absolute items-center hidden w-full mt-24 sm:block sm:min-h-screen">
                    <button class="absolute z-20 w-10 h-10 left-8 acclaimed_btn" id="acclaimedBtnPrev">
                        <i class="fa-solid fa-angle-left"></i>
                    </button>
                    <button class="absolute z-10 w-10 h-10 right-8 acclaimed_btn" id="acclaimedBtnNext">
                        <i class="fa-solid fa-angle-right"></i>
                    </button>
                </div>
                <!-- aclamada 1 -->
                @forelse ($moviesAclaimed as $movie)
                    <div class="acclaimed_container">
                        <a href="{{ route('movies.detail', $movie->id) }}">
                            <img src="{{ $movie->image && asset('storage/movies/' . $movie->image) ? asset('storage/movies/' . $movie->image) : asset('images/no-image.jpg') }}"
                                alt="{{ $movie->title }}" class="acclaimed_image">
                        </a>
                    </div>
                @empty
                    <h3 class="m-auto mt-5 text-xl">Próximamente contenido disponible en aclamadas</h3>
                @endforelse


                <!-- aclamada 6 -->
                {{-- <div class="acclaimed_container">
                    <a href="#">
                        <img src="./images/peliculas/aclamada_6.jpg" alt="aclamada 6" class="acclaimed_image" />
                    </a>
                </div> --}}
                <!-- aclamada 7 -->
                {{-- <div class="acclaimed_container">
                    <a href="#">
                        <img src="./images/peliculas/aclamada_7.jpg" alt="aclamada 7" class="acclaimed_image" />
                    </a>
                </div> --}}
                <!-- aclamada 8 -->
                {{-- <div class="acclaimed_container">
                    <a href="#">
                        <img src="./images/peliculas/aclamada_8.jpg" alt="aclamada 8" class="acclaimed_image" />
                    </a>
                </div> --}}
                <!-- aclamada 9 -->
                {{-- <div class="acclaimed_container">
                    <a href="#">
                        <img src="./images/peliculas/aclamada_9.jpg" alt="aclamada 9" class="acclaimed_image" />
                    </a>
                </div> --}}
                <!-- aclamada 10 -->
                {{-- <div class="acclaimed_container">
                    <a href="#">
                        <img src="./images/peliculas/aclamada_10.jpg" alt="aclamada 10" class="acclaimed_image" />
                    </a>
                </div> --}}
                <!-- aclamada 11 -->
                {{-- <div class="acclaimed_container">
                    <a href="#">
                        <img src="./images/peliculas/aclamada_11.jpg" alt="aclamada 11" class="acclaimed_image" />
                    </a>
                </div> --}}
                <!-- aclamada 12 -->
                {{-- <div class="acclaimed_container">
                    <a href="#">
                        <img src="./images/peliculas/aclamada_12.jpg" alt="aclamada 12" class="acclaimed_image" />
                    </a>
                </div> --}}
            </div>
            <!-- Fin contenedor aclamadas-->
        </section>
        <!-- Fin peliculas aclamadas -->
    </main>
    <!-- Fin contenido principal -->
    <!-- Footer - Links de navegación - Botón ir a top  -->
    {{-- <footer>
      <!-- links de navagación - footer -->
      <div class="container relative py-5 mx-auto">
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

      <!-- Botón ir arriba-->
      <a class="btn_top" id="btnTop" wire:click="$dispatch('clean-section')">
          <img src="./images/flecha-hacia-arriba.svg" alt="Ir arriba flecha" class="btn_top_image" />
      </a>
  </footer> --}}
</div>
