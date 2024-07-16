<!-- Main modal -->
<div id="cinemas{{$row}}-card" tabindex="-1" aria-hidden="true"
     class="hidden overflow-y-auto overflow-x-hidden fixed z-50 place-content-center bg-gray-800/85 w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
  <div class="relative p-2 w-full max-w-md max-h-full m-auto">
    <!-- Modal content -->
    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700 drop-shadow-lg">
      <!-- Modal header -->
      <div class="flex items-center justify-between p-2 md:p-2 border-b rounded-t dark:border-gray-600">
        <button type="button"
                class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                data-modal-hide="cinemas{{$row}}-card">
          <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
          </svg>
          <span class="sr-only">Close modal</span>
        </button>
      </div>
      <!-- Modal body -->
      <div class="p-2 md:p-5 space-y-4">
        <div
          class="w-full max-w-md bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
          <div class="flex flex-col items-center py-12">
            <img class="w-24 h-24 mb-3 rounded-full shadow-lg" src="{{asset('images/cinema_studio.jpg')}}"
                 alt="Bonnie image"/>
            <h5
              class="mb-1 text-xl font-medium text-gray-900 dark:text-white">{{\Illuminate\Support\Str::title($cinema->name)}}</h5>
            <p class="flex my-5 text-lg items-center"><img
                src="{{asset( 'storage/flags/'.$cinema->country->flag)}}"
                class="w-12 me-2"
                alt="{{$cinema->country->name}}">
              {{ \Illuminate\Support\Str::title($cinema->country->name)}}
            </p>
            <span class="text-xl text-gray-500 dark:text-gray-400">Cinema Estudio</span>
          </div>
        </div>
      </div>
    </div>
  </div>
