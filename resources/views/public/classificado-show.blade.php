@extends('layouts.auth')

@section('content')
<div class="container py-5">
    <h1>{{ $item->title }}</h1>
    <p>Tipo: {{ $item->kind }}</p>
    <p>Preco: {{ $item->price ?? '-' }}</p>
    <p>{{ $item->description }}</p>
</div>
@endsection
