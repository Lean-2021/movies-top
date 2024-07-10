@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'dark:border-[#9f3647] dark:bg-gray-900 dark:text-gray-300 dark:focus:border-[#9f3647] dark:focus:ring-[#9f3647] rounded-md shadow-sm']) !!}>
