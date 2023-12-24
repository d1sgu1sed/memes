@props(['active'])

<a {{ $attributes->merge(['class' => "nav-link"]) }}>
    {{ $slot }}
</a>
