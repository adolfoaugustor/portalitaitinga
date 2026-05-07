@props(['title', 'link' => null, 'linkText' => null, 'subtitle' => null])

<div class="section-title-row">
    <h2>{{ $title }}</h2>
    @if($link && $linkText)
        <a href="{{ $link }}">{{ $linkText }}</a>
    @elseif($subtitle)
        <span>{{ $subtitle }}</span>
    @endif
</div>
