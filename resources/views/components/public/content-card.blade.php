@props(['empty' => false])

<div {{ $attributes->class(['feature-card']) }}>
    {{ $slot }}
</div>
