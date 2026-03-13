@extends('layouts.auth')

@section('content')
<div class="container py-5">
    <h1>Guia local: {{ $category }}</h1>
    @forelse ($items as $item)
        <div class="card card-body mb-2">
            <strong>{{ $item->name }}</strong>
            <div>{{ $item->city }}</div>
            <div>{{ $item->description }}</div>
        </div>
    @empty
        <div>No records.</div>
    @endforelse
</div>
@endsection
