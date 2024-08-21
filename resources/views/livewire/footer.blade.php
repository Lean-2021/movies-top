<footer>
    <!-- links de navagación - footer -->
    <div class="container relative h-auto py-2 mx-auto md:h-32">
        <nav class="flex items-center justify-center w-full py-10 mx-auto">
            <ul
                class="flex flex-col items-center justify-center w-full footer_list_links sm:flex-row gap-y-5 sm:gap-y-0 sm:justify-around">
                <li class="footer_item">
                    <a class="footer_link" wire:click="openModal(true,'terms','Términos y Condiciones')">Términos
                        y condiciones</a>
                </li>
                <li class="footer_item">
                    <a class="footer_link" wire:click="openModal(true,'faqs','Preguntas Frecuentes')">Preguntas
                        frecuentes</a>
                </li>
                <li class="footer_item">
                    <a class="footer_link" wire:click="openModal(true,'help','Ayuda')">Ayuda</a>
                </li>
                <li class="footer_item">
                    <a class="footer_link" wire:click="openModal(true,'contact','Contacto')">Contáctanos</a>
                </li>
            </ul>
        </nav>

        {{-- Abrir modales según cual se elija --}}
        <x-modal.generic modal="{{ $showModal }}" name="{{ $name }}" title="{{ $title }}"
            faqs={{ $faqs }} response="{{ $showResponse }}" />

        <!-- CopyRight -->
        <div class="absolute bottom-0 w-full text-center">
            <p class="footer_copyRight">&copy; CAC - Leandro Wagner - 2024</p>
        </div>
    </div>

    {{-- @if (Route::is('home')) --}}
    <!-- Botón ir arriba-->
    <a class="btn_top" id="btnTop" wire:click="$dispatch('clean-section')">
        <img src="{{ asset('images/flecha-hacia-arriba.svg') }}" alt="Ir arriba flecha" class="btn_top_image" />
    </a>
    {{-- @endif --}}
</footer>
