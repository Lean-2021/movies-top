<!-- Main modal -->
<div tabindex="-1"
    class="{{ $showModal ? 'block' : 'hidden' }} overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative max-w-2xl max-h-full p-4 m-auto mt-10">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 border-b rounded-t md:p-5 dark:border-gray-600">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                    {{ $title }}
                </h3>
                <button type="button"
                    class="inline-flex items-center justify-center w-8 h-8 text-sm text-gray-400 bg-transparent rounded-lg hover:bg-gray-200 hover:text-gray-900 ms-auto dark:hover:bg-gray-600 dark:hover:text-white"
                    wire:click="closeModal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <div class="p-4 space-y-4 md:p-5">
                {{-- términos y condiciones --}}
                @if ($name === 'terms')
                    <p>Este es el modal donde van a estar los términos y condiciones</p>
                    <p>si funciona</p>
                @endif
                {{-- Preguntas frecuentes --}}
                @if ($name === 'faqs')
                    <div>
                        @forelse($faqs as $index => $faq)
                            {{-- pregunta --}}
                            <h2>
                                <button type="button" wire:click='toggleResponse({{ $index }})'
                                    class="flex items-center justify-between w-full gap-3 p-5 font-medium text-gray-500 border border-b-0 border-gray-200 rtl:text-right dark:focus:bg-[#963243] dark:border-gray-700 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-[#9f3647]">
                                    <span>{{ $faq['question'] }}</span>
                                    <svg class="w-3 h-3 {{ $showResponse == $index ? '' : 'rotate-180' }} shrink-0"
                                        aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                        viewBox="0 0 10 6">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="M9 5 5 1 1 5" />
                                    </svg>
                                </button>
                            </h2>
                            {{-- respuesta --}}
                            <div class="{{ $showResponse == $index ? 'block' : 'hidden' }}">
                                <div
                                    class="p-5 border border-b-0 border-gray-200 dark:border-gray-700 dark:bg-gray-900">
                                    <p class="mb-2 text-gray-500 dark:text-gray-400">{{ $faq['response'] }}</p>
                                </div>
                            </div>
                        @empty
                            <p>No hay preguntas</p>
                        @endforelse
                    </div>
                @endif
                {{-- Ayuda --}}
                @if ($name === 'help')
                    <p>En este modal encontrarás todo lo relacionado con ayuda en el uso del sitio.</p>
                @endif
                {{-- Contacto --}}
                @if ($name === 'contact')
                    <p>Se pondrá la información de contacto (Perfil de linkedin) del creador del sitio</p>
                @endif
            </div>

            {{-- <!-- Modal footer -->
            <div class="flex items-center p-4 border-t border-gray-200 rounded-b md:p-5 dark:border-gray-600">
                <button data-modal-hide="default-modal" type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">I accept</button>
                <button data-modal-hide="default-modal" type="button" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Decline</button>
            </div> --}}
        </div>
    </div>
</div>
