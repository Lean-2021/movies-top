@section('title', 'Inicio')
<div>

  <main class="main_container" id="mainContainer">
    <!-- Registrarse -->
    <section class="main_register animate__animated animate__zoomIn animate_faster">
      <h1 class="main_register-title">
        Películas y series ilimitadas
        <br/>
        en un solo lugar
      </h1>
      <h2 class="main_register-subTitle no-margin">
        Disfruta donde quieras.
      </h2>
      <h2 class="main_register-subTitle">
        Cancela en cualquier momento.
      </h2>
      @if(!Auth::check())
        <a href="{{route('register')}}" class="main_register_btn" wire:navigate>Registrate</a>
      @endif
    </section>

    <!-- Buscar películas -->
    <section class="container text-center main_search_container" id="searchContainer">
      <h2 class="main_search_title">¿Qué estas buscando para ver?</h2>
      <!-- Formulario para buscar películas -->
      <div class="container max-w-xl mx-auto">
        <form
          class="flex flex-col sm:flex-row mt-4 px-10 sm:px-0 items-center justify-center gap-4">
          <input type="search" name="search" id="search" placeholder="Buscar..."
                 class="w-full h-12 rounded-md text-black px-5 border-4 border-[#9f3647] focus:border-2 focus:border-[#9f3647] focus:ring-2 focus:ring-[#9f3647] hover:ring-2 hover:ring-[#9f3647]"/>
          <button type="button" value="Buscar"
                  class="main_search_btn h-12 rounded-md border-2 border-slate-50 w-full sm:w-24">
            <span class="-ms-1">Buscar</span>
          </button>
        </form>

      </div>
    </section>

    <!-- Separar sección con línea -->
    <hr class="line_divisor"/>

    {{-- Sección Novedades --}}
    <section class="container mx-auto mb-14 mt-12 novelties-container" id="novelties">
      <h3 class="text-center text-3xl">Novedades</h3>
      <div class="flex flex-wrap justify-center align-center gap-16 mt-10">
        <div class="trend_container w-[15rem]">
          <a href="#" class="trend_container_link">
            <img src="./images/peliculas/peli_1.jpg" alt="The Beekeeper" class="trend_image"/>
            <div class="trend_container-hover">
              <h4 class="trend_title-hover" title="The Beekeeper">
                The Beekeeper
              </h4>
              <p class="trend_review-hover">⭐⭐⭐</p>
              <img src="./images/film.ico" alt="icono pelicula" class="trend_image-hover"/>
            </div>
          </a>
        </div>
        <div class="trend_container w-[15rem]">
          <a href="#" class="trend_container_link">
            <img src="./images/peliculas/peli_1.jpg" alt="The Beekeeper" class="trend_image"/>
            <div class="trend_container-hover">
              <h4 class="trend_title-hover" title="The Beekeeper">
                The Beekeeper
              </h4>
              <p class="trend_review-hover">⭐⭐⭐</p>
              <img src="./images/film.ico" alt="icono pelicula" class="trend_image-hover"/>
            </div>
          </a>
        </div>
        <div class="trend_container w-[15rem]">
          <a href="#" class="trend_container_link">
            <img src="./images/peliculas/peli_1.jpg" alt="The Beekeeper" class="trend_image"/>
            <div class="trend_container-hover">
              <h4 class="trend_title-hover" title="The Beekeeper">
                The Beekeeper
              </h4>
              <p class="trend_review-hover">⭐⭐⭐</p>
              <img src="./images/film.ico" alt="icono pelicula" class="trend_image-hover"/>
            </div>
          </a>
        </div>
        <div class="trend_container w-[15rem]">
          <a href="#" class="trend_container_link">
            <img src="./images/peliculas/peli_1.jpg" alt="The Beekeeper" class="trend_image"/>
            <div class="trend_container-hover">
              <h4 class="trend_title-hover" title="The Beekeeper">
                The Beekeeper
              </h4>
              <p class="trend_review-hover">⭐⭐⭐</p>
              <img src="./images/film.ico" alt="icono pelicula" class="trend_image-hover"/>
            </div>
          </a>
        </div>
        <div class="trend_container w-[15rem]">
          <a href="#" class="trend_container_link">
            <img src="./images/peliculas/peli_1.jpg" alt="The Beekeeper" class="trend_image"/>
            <div class="trend_container-hover">
              <h4 class="trend_title-hover" title="The Beekeeper">
                The Beekeeper
              </h4>
              <p class="trend_review-hover">⭐⭐⭐</p>
              <img src="./images/film.ico" alt="icono pelicula" class="trend_image-hover"/>
            </div>
          </a>
        </div>
      </div>
    </section>

    <!-- Separar sección con línea -->
    <hr class="line_divisor"/>

    <!-- Sección de películas Tendencias-->
    <!-- Contenedor Tendencias -->
    <section class="container mx-auto trends_container mt-10" id="trends">

      <h3 class="text-center text-3xl">Las tendencias de hoy</h3>

      <!-- Contenedor Películas    -->
      <div class="flex flex-wrap justify-center align-center gap-14 mt-10">
        <!-- Pelicula 1 -->
        <div class="trend_container">
          <a href="#" class="trend_container_link">
            <img src="./images/peliculas/peli_1.jpg" alt="The Beekeeper" class="trend_image"/>
            <div class="trend_container-hover">
              <h4 class="trend_title-hover" title="The Beekeeper">
                The Beekeeper
              </h4>
              <p class="trend_review-hover">⭐⭐⭐</p>
              <img src="./images/film.ico" alt="icono pelicula" class="trend_image-hover"/>
            </div>
          </a>
        </div>
        <!-- Pelicula 2 -->
        <div class="trend_container">
          <a href="#" class="trend_container_link">
            <img src="./images/peliculas/peli_2.jpg" alt="Badland Hunters" class="trend_image"/>
            <div class="trend_container-hover">
              <h4 class="trend_title-hover" title="Badland Hunters">
                Badland Hunters
              </h4>
              <p class="trend_review-hover">⭐⭐⭐⭐⭐</p>
              <img src="./images/film.ico" alt="icono pelicula" class="trend_image-hover"/>
            </div>
          </a>
        </div>
        <!-- Pelicula 3 -->
        <div class="trend_container">
          <a href="#" class="trend_container_link">
            <img src="./images/peliculas/peli_3.jpg" alt="The Marvels" class="trend_image"/>
            <div class="trend_container-hover">
              <h4 class="trend_title-hover" title="The Marvels">
                The Marvels
              </h4>
              <p class="trend_review-hover">⭐⭐⭐⭐⭐</p>
              <img src="./images/film.ico" alt="icono pelicula" class="trend_image-hover"/>
            </div>
          </a>
        </div>
        <!-- Pelicula 4 -->
        <div class="trend_container">
          <a href="#" class="trend_container_link">
            <img src="./images/peliculas/peli_4.jpg" alt="Wonka" class="trend_image"/>
            <div class="trend_container-hover">
              <h4 class="trend_title-hover" title="Wonka">Wonka</h4>
              <p class="trend_review-hover">⭐⭐⭐⭐</p>
              <img src="./images/film.ico" alt="icono pelicula" class="trend_image-hover"/>
            </div>
          </a>
        </div>
        <!-- Pelicula 5 -->
        <div class="trend_container">
          <a href="#" class="trend_container_link">
            <img src="./images/peliculas/peli_5.jpg" alt="Aquaman Lost kingdom"
                 class="trend_image"/>
            <div class="trend_container-hover">
              <h4 class="trend_title-hover" title="Aquaman and The lost kingdom">
                Aquaman and The lost kingdom
              </h4>
              <p class="trend_review-hover">⭐⭐</p>
              <img src="./images/film.ico" alt="icono pelicula" class="trend_image-hover"/>
            </div>
          </a>
        </div>
        <!-- Pelicula 6 -->
        <div class="trend_container">
          <a href="#" class="trend_container_link">
            <img src="./images/peliculas/peli_6.jpg" alt="Migration" class="trend_image"/>
            <div class="trend_container-hover">
              <h4 class="trend_title-hover" title="Migration">Migration</h4>
              <p class="trend_review-hover">⭐⭐⭐</p>
              <img src="./images/film.ico" alt="icono pelicula" class="trend_image-hover"/>
            </div>
          </a>
        </div>
        <!-- Pelicula 7 -->
        <div class="trend_container">
          <a href="#" class="trend_container_link">
            <img src="./images/peliculas/peli_7.jpg" alt="60 minutes" class="trend_image"/>
            <div class="trend_container-hover">
              <h4 class="trend_title-hover" title="60 minutes">
                60 minutes
              </h4>
              <p class="trend_review-hover">⭐⭐⭐⭐⭐</p>
              <img src="./images/film.ico" alt="icono pelicula" class="trend_image-hover"/>
            </div>
          </a>
        </div>
        <!-- Pelicula 8 -->
        <div class="trend_container">
          <a href="#" class="trend_container_link">
            <img src="./images/peliculas/peli_8.jpg" alt="Wish" class="trend_image"/>
            <div class="trend_container-hover">
              <h4 class="trend_title-hover" title="Wish">Wish</h4>
              <p class="trend_review-hover">⭐⭐⭐⭐</p>
              <img src="./images/film.ico" alt="icono pelicula" class="trend_image-hover"/>
            </div>
          </a>
        </div>
        <!-- Pelicula 9 -->
        <div class="trend_container">
          <a href="#" class="trend_container_link">
            <img src="./images/peliculas/peli_9.jpg" alt="The Masked Saint" class="trend_image"/>
            <div class="trend_container-hover">
              <h4 class="trend_title-hover" title="The Masked Saint">
                The Masked Saint
              </h4>
              <p class="trend_review-hover">⭐⭐⭐⭐⭐</p>
              <img src="./images/film.ico" alt="icono pelicula" class="trend_image-hover"/>
            </div>
          </a>
        </div>
        <!-- Pelicula 10 -->
        <div class="trend_container">
          <a href="#" class="trend_container_link">
            <img src="./images/peliculas/peli_10.jpg" alt="Due Justice" class="trend_image"/>
            <div class="trend_container-hover">
              <h4 class="trend_title-hover" title="Due Justice">
                Due Justice
              </h4>
              <p class="trend_review-hover">⭐⭐⭐⭐⭐</p>
              <img src="./images/film.ico" alt="icono pelicula" class="trend_image-hover"/>
            </div>
          </a>
        </div>
        <!-- Pelicula 11 -->
        <div class="trend_container">
          <a href="#" class="trend_container_link">
            <img src="./images/peliculas/peli_11.jpg" alt="Orion And The Dark" class="trend_image"/>
            <div class="trend_container-hover">
              <h4 class="trend_title-hover" title="Orion And The Dark">
                Orion And The Dark
              </h4>
              <p class="trend_review-hover">⭐⭐⭐⭐</p>
              <img src="./images/film.ico" alt="icono pelicula" class="trend_image-hover"/>
            </div>
          </a>
        </div>
        <!-- Pelicula 12 -->
        <div class="trend_container">
          <a href="#" class="trend_container_link">
            <img src="./images/peliculas/peli_12.jpg" alt="Genghis Khan" class="trend_image"/>
            <div class="trend_container-hover">
              <h4 class="trend_title-hover" title="TGenghis Khan">
                Genghis Khan
              </h4>
              <p class="trend_review-hover">⭐⭐⭐⭐</p>
              <img src="./images/film.ico" alt="icono pelicula" class="trend_image-hover"/>
            </div>
          </a>
        </div>
      </div>
      <!-- Fin peliculas tendencias-->
      <!-- Botones anterior - siguiente -->
      <div class="flex gap-4 justify-center items-center my-12">
        <button class="main_trends_btn" id="btnTrendPrev">Anterior</button>
        <button class="main_trends_btn" id="btnTrendNext">Siguiente</button>
      </div>
    </section>
    <!-- Fin contenedor tendencias -->

    <!-- Separar sección con línea -->
    <hr class="line_divisor"/>

    <!-- Las más aclamadas -->
    <section class="relative container mx-auto main_acclaimed mt-10 mb-10"
             id="acclaimeds">
      <h3 class="text-center text-3xl">Las más aclamadas</h3>

      <!-- Contenedor aclamadas -->
      <div
        class="flex gap-[1rem] sm:gap-[2rem] items-center mx-auto my-12 acclaimeds_container px-3 sm:px-0  group/acclaimeds"
        id="acclaimedsContainer">
        <button class="absolute left-8 w-10 h-10 z-10 acclaimed_btn" id="acclaimedBtnPrev">
          <i class="fa-solid fa-angle-left"></i>
        </button>
        <button class="absolute right-8 w-10 h-10 acclaimed_btn z-10" id="acclaimedBtnNext">
          <i class="fa-solid fa-angle-right"></i>
        </button>
        <!-- aclamada 1 -->
        <div class="acclaimed_container">
          <a href="#">
            <img src="./images/peliculas/aclamada_1.jpg" alt="aclamada 1"
                 class="acclaimed_image"/>
          </a>
        </div>
        <!-- aclamada 2 -->
        <div class="acclaimed_container">
          <a href="#">
            <img src="./images/peliculas/aclamada_2.jpg" alt="aclamada 2"
                 class="acclaimed_image"/>
          </a>
        </div>
        <!-- aclamada 3 -->
        <div class="acclaimed_container">
          <a href="#">
            <img src="./images/peliculas/aclamada_3.jpg" alt="aclamada 3"
                 class="acclaimed_image"/>
          </a>
        </div>
        <!-- aclamada 4 -->
        <div class="acclaimed_container">
          <a href="#">
            <img src="./images/peliculas/aclamada_4.jpg" alt="aclamada 4"
                 class="acclaimed_image"/>
          </a>
        </div>
        <!-- aclamada 5 -->
        <div class="acclaimed_container">
          <a href="#">
            <img src="./images/peliculas/aclamada_5.jpg" alt="aclamada 5"
                 class="acclaimed_image"/>
          </a>
        </div>
        <!-- aclamada 6 -->
        <div class="acclaimed_container">
          <a href="#">
            <img src="./images/peliculas/aclamada_6.jpg" alt="aclamada 6"
                 class="acclaimed_image"/>
          </a>
        </div>
        <!-- aclamada 7 -->
        <div class="acclaimed_container">
          <a href="#">
            <img src="./images/peliculas/aclamada_7.jpg" alt="aclamada 7"
                 class="acclaimed_image"/>
          </a>
        </div>
        <!-- aclamada 8 -->
        <div class="acclaimed_container">
          <a href="#">
            <img src="./images/peliculas/aclamada_8.jpg" alt="aclamada 8"
                 class="acclaimed_image"/>
          </a>
        </div>
        <!-- aclamada 9 -->
        <div class="acclaimed_container">
          <a href="#">
            <img src="./images/peliculas/aclamada_9.jpg" alt="aclamada 9"
                 class="acclaimed_image"/>
          </a>
        </div>
        <!-- aclamada 10 -->
        <div class="acclaimed_container">
          <a href="#">
            <img src="./images/peliculas/aclamada_10.jpg" alt="aclamada 10"
                 class="acclaimed_image"/>
          </a>
        </div>
        <!-- aclamada 11 -->
        <div class="acclaimed_container">
          <a href="#">
            <img src="./images/peliculas/aclamada_11.jpg" alt="aclamada 11"
                 class="acclaimed_image"/>
          </a>
        </div>
        <!-- aclamada 12 -->
        <div class="acclaimed_container">
          <a href="#">
            <img src="./images/peliculas/aclamada_12.jpg" alt="aclamada 12"
                 class="acclaimed_image"/>
          </a>
        </div>
      </div>
      <!-- Fin contenedor aclamadas-->
    </section>
    <!-- Fin peliculas aclamadas -->
  </main>
  <!-- Fin contenido principal -->
  <!-- Footer - Links de navegación - Botón ir a top  -->
  <footer>
    <!-- links de navagación - footer -->
    <div class="container mx-auto py-5 relative">
      <nav class="w-full mx-auto flex justify-center items-center py-10">
        <ul
          class="w-full footer_list_links flex flex-col sm:flex-row items-center gap-y-5 sm:gap-y-0 justify-center sm:justify-around">
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
          {{--                        <li class="footer_item">--}}
          {{--                            <a href="#" class="footer_link-active">Administrador Peliculas</a>--}}
          {{--                        </li>--}}
        </ul>
      </nav>

      <!-- CopyRight -->
      <div class="w-full text-center bottom-0 absolute">
        <p class="footer_copyRight">&copy; CAC - Leandro Wagner - 2024</p>
      </div>
    </div>

    <!-- Botón ir arriba-->
    <a class="btn_top" id="btnTop" wire:click="$dispatch('clean-section')">
      <img src="./images/flecha-hacia-arriba.svg" alt="Ir arriba flecha" class="btn_top_image"/>
    </a>
  </footer>
  <!-- Fin footer-->
  <!-- Enlace script index.js-->
  {{--        <script src="./js/index.js"></script>--}}
</div>
