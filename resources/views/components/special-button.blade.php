@props([
    'link' => '#',
])
<a {{ $attributes->merge(['class' => 'btn-special']) }} href="{{ $link }}">
    <span>
        {{ $slot }}
    </span>
</a>
