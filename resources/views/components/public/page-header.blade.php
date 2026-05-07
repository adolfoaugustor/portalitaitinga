@props(['title', 'subtitle' => null, 'meta' => null])

<div class="page-header">
    <h1 class="display-6">{{ $title }}</h1>
    @if($subtitle)
        <p class="lead text-body-secondary">{{ $subtitle }}</p>
    @endif
    @if($meta)
        <p class="small text-body-secondary mt-2 mb-0">{{ $meta }}</p>
    @endif
</div>
