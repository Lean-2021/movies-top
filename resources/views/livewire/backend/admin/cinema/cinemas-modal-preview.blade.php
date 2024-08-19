<!-- Main modal -->
<div tabindex="-1"
    class="{{ $showPreview ? 'block' : 'hidden' }} overflow-y-auto overflow-x-hidden fixed z-50 place-content-center bg-gray-800/90 w-full inset-0 h-screen max-h-full">
    <div class="relative w-full max-w-md max-h-full p-2 m-auto">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700 drop-shadow-lg">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-2 border-b rounded-t md:p-2 dark:border-gray-600">
                <button type="button" wire:click='closePreview'
                    class="inline-flex items-center justify-center w-8 h-8 text-sm text-gray-400 bg-transparent rounded-lg hover:bg-gray-200 hover:text-gray-900 ms-auto dark:hover:bg-gray-600 dark:hover:text-white">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <div class="p-2 space-y-4 md:p-5">
                @if ($cinema)
                    <div
                        class="w-full max-w-md bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                        <div class="flex flex-col items-center py-12">
                            <img class="w-24 h-24 mb-3 rounded-full shadow-lg"
                                src="{{ asset('images/cinema_studio.jpg') }}" alt="Bonnie image" />
                            <h5 class="mb-1 text-xl font-medium text-gray-900 dark:text-white">
                                {{ Str::title($cinema->name) }}</h5>
                            <p class="flex items-center my-5 text-lg"><img
                                    src="{{ asset('storage/flags/' . $cinema->country->flag) }}" class="w-12 me-2"
                                    alt="{{ $cinema->country->name }}">
                                {{ Str::title($cinema->country->name) }}
                            </p>
                            <span class="text-xl text-gray-500 dark:text-gray-400">Cinema Estudio</span>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
