// import './bootstrap';
import 'flowbite';


document.addEventListener('DOMContentLoaded', () => {
  // Referencias
  const btnMenuOpen = document.querySelector("#btnMenuOpen"); // referencia Botón abrir menú nav
  const btnMenuClose = document.querySelector("#btnMenuClose"); // referencia Botón cerrar menú nav
  const headerListLinks = document.querySelector("#headerListLinks"); // referencia menú links nav
  const navLinks = document.querySelectorAll(".header_items"); // referencia items links del nav
  const btnTop = document.querySelector("#btnTop"); // referencia botón top


  // funcion que muetra/oculta el botón top
  const showHideBtnTop = () => {
    if (document.body.scrollTop > 100 || document.documentElement.scrollTop > 100) {
      btnTop.style.display = "block";
    } else {
      btnTop.style.display = "none";
    }
    ;
  };

  //Evento scroll para llamar a función que muetra/oculta el botón top
  window.onscroll = () => showHideBtnTop();

  // Función para hacer scroll hacia arriba
  const goToTop = () => {
    document.body.scrollTop = 0; // Ir hacia arriba - opción para unos navegadores
    document.documentElement.scrollTop = 0; // Ir hacia arriba - optimo para otros navegadores
  };

  //Escuchar evento click en botón Top y llamar a función para hacer scroll hacia arriba
  btnTop.addEventListener('click', goToTop);

  // abrir menu de navegación responsive
  btnMenuOpen.addEventListener('click', () => {
    headerListLinks.classList.remove('hide_links-animation');
    headerListLinks.classList.add('show_links');
    headerListLinks.classList.add('show_links-animation');
    btnMenuOpen.classList.remove('btn_menu-active');
    btnMenuClose.classList.add('btn_menu-active');
  });

  // cerrar menu de navegación responsive
  btnMenuClose.addEventListener('click', () => {
    headerListLinks.classList.add('hide_links-animation');
    setTimeout(() => {
      headerListLinks.classList.remove('show_links');
    }, 500);
    btnMenuOpen.classList.add('btn_menu-active');
    btnMenuClose.classList.remove('btn_menu-active');
  });

  // Cerrar menú de navegación responsive cuando se hace click en un link
  for (let link of navLinks) {
    link.addEventListener('click', () => {
      headerListLinks.classList.add('hide_links-animation');
      setTimeout(() => {
        headerListLinks.classList.remove('show_links');
      }, 500);
      btnMenuOpen.classList.add('btn_menu-active');
      btnMenuClose.classList.remove('btn_menu-active');
    });
  }

  // acceder al botón tendencias anterior
  const btnTrendPrev = document.querySelector("#btnTrendPrev");
  // acceder al botón tendencias siguiente
  const btnTrendNext = document.querySelector("#btnTrendNext");

  // Escuchar evento resize al cargar la pagina
  // Escuchar el evento resize para cambiar contenido de botón anterior/siguiente en index tendencias
  window.addEventListener('resize', () => {
    const widthWindow = window.innerWidth; // obtener el ancho de la ventana
    // Si el ancho es inferior a 576px mostrar iconos en botones
    if (widthWindow < 576) {
      if (btnTrendPrev && btnTrendNext) { // si existen los botones mostrar iconos

        btnTrendPrev.innerHTML = "<i class=\"fa-solid fa-angle-left\"></i>";
        btnTrendNext.innerHTML = "<i class=\"fa-solid fa-angle-right\"></i>";
      }
    } else { // si es mayor a 576px mostrar el texto
      if (btnTrendPrev && btnTrendNext) { // si existen los botones mostrar texto

        btnTrendPrev.innerText = "Anterior";
        btnTrendNext.innerText = "Siguiente";
      }
      ;
    }
  });
  // disparar el evento resize cuando cargar el navegador
  window.dispatchEvent(new Event('resize'));

  // Conteneder peliculas aclamadas
  const acclaimedsContainer = document.querySelector("#acclaimedsContainer");
  //  Botón next slice peliculas aclamadas
  const acclaimedBtnNext = document.querySelector("#acclaimedBtnNext");
  //  Botón prev slice peliculas aclamadas
  const acclaimedBtnPrev = document.querySelector("#acclaimedBtnPrev");
  // Evento click botón next - mover slice hacia la izquierda
  if (acclaimedBtnNext && acclaimedBtnPrev) { // si existen los botones escuchar el evento click
    acclaimedBtnNext.addEventListener('click', () => {
      acclaimedsContainer.scrollLeft += 400;
    });
    // Evento click botón prev - mover slice hacia la izquierda
    acclaimedBtnPrev.addEventListener('click', () => {
      acclaimedsContainer.scrollLeft -= 400;
    });
  }
  ;

  //Scroll aclamadas - detectar inicio/fin para mostrar/ocultar botones next ó prev
  if (acclaimedsContainer) { // si el contenedor aclamadas existe escuchar y verificar el evento scroll
    function verifyScrollAcclaimed() {
      // Verificar la posición final del contenedor
      if (acclaimedsContainer.scrollWidth - acclaimedsContainer.scrollLeft === acclaimedsContainer.clientWidth) {
        acclaimedBtnNext.disabled = true;
        acclaimedBtnNext.classList.add('acclaimed_btn-hide');
      } else {
        acclaimedBtnNext.disabled = false;
        acclaimedBtnNext.classList.remove('acclaimed_btn-hide');
      }
      // Verificar la posicion inicial del contenedor
      if (acclaimedsContainer.scrollLeft === 0) {
        acclaimedBtnPrev.disabled = true;
        acclaimedBtnPrev.classList.add('acclaimed_btn-hide');
      } else {
        acclaimedBtnPrev.disabled = false;
        acclaimedBtnPrev.classList.remove('acclaimed_btn-hide');
      }
    };
    // Llamar a función verificar scroll position y escuchar el evento scroll haciendo la verificación
    verifyScrollAcclaimed();
    acclaimedsContainer.addEventListener('scroll', verifyScrollAcclaimed);
  }
  ;

  // window.addEventListener('scroll', () => {
  //   /* escuchar evento scroll para que detecte en que sección del index estoy y aplique la animación correspondiente
  //     según donde este */
  //   const noveltiesContainer = document.querySelector("#novelties"); //contenedor novedeades
  //   const searchContainer = document.querySelector("#searchContainer"); //contenedor search
  //   const trendsContainer = document.querySelector('#trends'); // contenedor peliculas - tendencias
  //   const acclaimedContainer = document.querySelector('#acclaimeds') // contenedor peliculas - aclamadas
  //   // Escuchar evento scroll
  //   let scrollPos = window.scrollY || window.scrollTop;
  //   // Obtener posicion scroll contenedor search
  //   if (searchContainer) { // si el contenedor existe obtener posicion scroll contenedor search y aplicar animación
  //     const searchHeight = searchContainer.offsetHeight;
  //     const rectSearch = searchContainer.getBoundingClientRect(); // obtener posicion scroll contenedor search
  //     // Si el contenedor está a la altura de la ventana desde el borde superior
  //     if (rectSearch.top - scrollPos < searchHeight) {
  //       Livewire.dispatch('select-section', ['home']);
  //       searchContainer.classList.add('anim_slice_up');
  //     } else {
  //       searchContainer.classList.remove('anim_slice_up');
  //
  //     }
  //   }
  //   ;
  //
  //   // Obtener posicion scroll contenedor novedades
  //   if (noveltiesContainer) { // si el contenedor existe obtener posicion scroll contenedor search y aplicar animación
  //     const noveltiesSearch = noveltiesContainer.getBoundingClientRect(); // obtener posicion scroll contenedor search
  //     const noveltiesHeight = noveltiesContainer.offsetHeight;
  //
  //     // Si el contenedor está a la altura de la ventana desde el borde superior
  //     if (noveltiesSearch.top - scrollPos < noveltiesHeight) {
  //       Livewire.dispatch('select-section', ['novelties']);
  //       noveltiesContainer.classList.add('anim_slice_up');
  //     } else {
  //       noveltiesContainer.classList.remove('anim_slice_up');
  //     }
  //   }
  //   ;
  //
  //   // Obtener posicion scroll contenedor peliculas - tendencias
  //   if (trendsContainer) { // si el contenedor existe obtener posicion scroll contenedor peliculas - tendencias
  //     const trendsHeight = trendsContainer.offsetHeight;
  //     const rectTrends = trendsContainer.getBoundingClientRect();
  //     // Si el contenedor está a la altura de la ventana desde el borde superior
  //     if (rectTrends.top - scrollPos < trendsHeight) {
  //       Livewire.dispatch('select-section', ['trends']);
  //       trendsContainer.classList.add('anim_slice_up');
  //     } else {
  //       trendsContainer.classList.remove('anim_slice_up');
  //     }
  //   }
  //   ;
  //   // Obtener posicion scroll contenedor peliculas - aclamadas
  //   if (acclaimedsContainer) { // si el contenedor existe obtener posicion scroll contenedor peliculas - aclamadas
  //     const acclaimedHeight = acclaimedContainer.offsetHeight;
  //     const rectAcclaimeds = acclaimedContainer.getBoundingClientRect();
  //     // Si el contenedor está a la altura de la ventana desde el borde superior
  //     if (rectAcclaimeds.top - scrollPos < acclaimedHeight) {
  //       Livewire.dispatch('select-section', ['acclaimeds']);
  //       acclaimedContainer.classList.add('anim_slice_up');
  //
  //     } else {
  //       acclaimedContainer.classList.remove('anim_slice_up');
  //     }
  //   }
  //   ;
  // });

  // window.addEventListener('scroll', () => {
  //   const containers = [
  //     {element: document.querySelector("#searchContainer"), section: 'home'},
  //     {element: document.querySelector("#novelties"), section: 'novelties'},
  //     {element: document.querySelector('#trends'), section: 'trends'},
  //     {element: document.querySelector('#acclaimeds'), section: 'acclaimeds'}
  //   ];
  //
  //   const scrollPos = window.scrollY;
  //   const windowHeight = window.innerHeight;
  //
  //   containers.forEach(container => {
  //     if (container.element) {
  //       const rect = container.element.getBoundingClientRect();
  //
  //       // Check if the container is in the viewport
  //       if (rect.top < windowHeight && rect.bottom > 0) {
  //         Livewire.dispatch('select-section', [container.section]);
  //         container.element.classList.add('anim_slice_up');
  //       } else {
  //         container.element.classList.remove('anim_slice_up');
  //       }
  //     }
  //   });
  // });

  window.addEventListener('scroll', () => {
    const containers = [
      {element: document.querySelector("#searchContainer"), section: 'home'},
      {element: document.querySelector("#novelties"), section: 'novelties'},
      {element: document.querySelector('#trends'), section: 'trends'},
      {element: document.querySelector('#acclaimeds'), section: 'acclaimeds'},
      {element: document.querySelector('#goToSearch'), section: 'home'}
    ];

    const scrollPos = window.scrollY;
    const windowHeight = window.innerHeight;

    containers.forEach(container => {
      if (container.element) {
        const rect = container.element.getBoundingClientRect();

        // Consider the fixed nav height (10vh)
        const adjustedTop = rect.top + 0.1 * windowHeight;
        const adjustedBottom = rect.bottom - 0.2 * windowHeight;

        // Check if the container is in the viewport
        if (adjustedTop < windowHeight && adjustedBottom > 0) {
          Livewire.dispatch('select-section', [container.section]);
          container.element.classList.add('anim_slice_up');
        } else {
          container.element.classList.remove('anim_slice_up');
        }
      }
    });
  });
});

// Escuchar eventos para mostrar mensajes segun la ocasión
Livewire.on('create', (event) => {
  const Toast = Swal.mixin({
    toast: true,
    position: "top-end",
    // background: '#333',
    // color: '#fff',
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
  });
  Toast.fire({
    icon: event.icon,
    title: event.message
  });
});

// Modal confirmación de eliminación
Livewire.on('delete', (event) => {
  Swal.fire({
    title: "Está seguro?",
    text: "Está acción no podrá revertirse!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Si, eliminar!"
  }).then((result) => {
    if (result.isConfirmed) {
      Livewire.dispatch('destroy', {id: event});
    }
  });
});

// Modal eliminacion para varios registros
Livewire.on('deleteSelected', (event) => {
  Swal.fire({
    title: "Está seguro?",
    text: "Está acción no podrá revertirse!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Si, eliminar!"
  }).then((result) => {
    if (result.isConfirmed) {
      Livewire.dispatch('destroyAll', {selected: event});
    }
  });
});

// Ir a la sección de búsqueda si hay resultados
Livewire.on('scrollToSearch',()=>{
  let goToSearch = document.getElementById('goToSearch');
  if(goToSearch){
    goToSearch.scrollIntoView({behavior:'smooth'});
  };
});

// Ir a novedades cuando se borren los resultados de búsqueda
Livewire.on('scrollToSeachContainer',()=>{
  let gotToSearchContainer = document.querySelector('#searchContainer');
  if(gotToSearchContainer){
    gotToSearchContainer.scrollIntoView({behavior: 'smooth'});
  };
});
