@extends('layouts.auth')

@section('content')
<div class="container py-5">
    <h1>{{ $event->title }}</h1>
    <p>Date: {{ $date }}</p>
    <p>Location: {{ $event->location ?? '-' }}</p>
    <p>{{ $event->description }}</p>

    <h2 class="h5 mt-4">Other events on this day</h2>
    @forelse ($sameDayEvents as $item)
        <div><a href="{{ route('public.agenda.show', ['date' => $item->event_date->toDateString(), 'slug' => $item->slug]) }}">{{ $item->title }}</a></div>
    @empty
        <div>No other events on this day.</div>
    @endforelse
</div>
@endsection
