@props(['href', 'icon'])

<a href="{{ $href }}" {{ $attributes->merge(['class' => 'flex items-center px-3 py-2 rounded hover:bg-gray-700 transition']) }}>
    <i class="{{ $icon }} mr-3"></i>
    <span>{{ $slot }}</span>
</a>