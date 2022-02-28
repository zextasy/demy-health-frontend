@props(['active'])

@php
    $classes = ($active ?? false)
                ? 'parent-nav inline-flex items-center px-1 pt-1 border-b-2 border-indigo-400 text-sm font-semibold leading-5 text-gray-900 focus:outline-none focus:border-indigo-700 transition duration-150 ease-in-out'
                : 'parent-nav inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-semibold leading-5 text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out';
@endphp

@props(['active'])

@php
    $classes = ($active ?? false)
                ? 'parent-nav block pl-3 pr-4 py-2 border-l-4 border-indigo-400 text-base font-semibold text-indigo-700 bg-indigo-50 focus:outline-none focus:text-indigo-800 focus:bg-indigo-100 focus:border-indigo-700 transition duration-150 ease-in-out'
                : 'parent-nav block pl-3 pr-4 py-2 border-l-4 border-transparent text-base font-semibold text-gray-600 hover:text-gray-800 hover:bg-gray-50 hover:border-gray-300 focus:outline-none focus:text-gray-800 focus:bg-gray-50 focus:border-gray-300 transition duration-150 ease-in-out';
@endphp

<div x-data="{ open: false }" @click.away="open = false" @close.stop="open = false" @click="open = ! open" {{ $attributes->merge(['class' => $classes]) }} >
    <div>
        {{ $name }}

        <div class="ml-1 inline-block relative top-1">
            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
            </svg>
        </div>
    </div>

    <div class="children border border-gray-300 mt-3"
         x-show="open"
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="transform opacity-0 scale-95"
         x-transition:enter-end="transform opacity-100 scale-100"
         x-transition:leave="transition ease-in duration-75"
         x-transition:leave-start="transform opacity-100 scale-100"
         x-transition:leave-end="transform opacity-0 scale-95">
        {{ $children }}
    </div>
</div>
