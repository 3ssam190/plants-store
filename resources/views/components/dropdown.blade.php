@props(['align' => 'right', 'width' => '48', 'contentClasses' => 'py-1 bg-white dark:bg-gray-700'])

@php
$alignmentClasses = match ($align) {
    'left' => 'ltr:origin-top-left rtl:origin-top-right start-0',
    'top' => 'origin-top',
    default => 'ltr:origin-top-right rtl:origin-top-left end-0',
};

$width = match ($width) {
    '48' => 'w-48',
    default => $width,
};
@endphp

@props(['trigger' => 'Open', 'align' => 'right'])

<div x-data="{ open: false }" @click.away="open = false" class="relative">
    <!-- Trigger -->
    <div @click="open = !open" class="cursor-pointer">
        {{ $trigger ?? 'Menu' }}  <!-- Fallback if no trigger provided -->
    </div>

    <!-- Dropdown Content -->
    <div x-show="open"
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 scale-95"
         x-transition:enter-end="opacity-100 scale-100"
         x-transition:leave="transition ease-in duration-75"
         x-transition:leave-start="opacity-100 scale-100"
         x-transition:leave-end="opacity-0 scale-95"
         class="absolute z-50 mt-2 w-48 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 py-1"
         style="display: none; 
                @if($align === 'right') right: 0; @else left: 0; @endif">
        {{ $slot }}
    </div>
</div>
