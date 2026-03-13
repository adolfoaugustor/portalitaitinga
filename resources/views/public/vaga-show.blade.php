@extends('layouts.auth')

@section('content')
<div class="container py-5">
    <h1>{{ $vacancy->title }}</h1>
    <p>Loja: {{ $vacancy->store_name }}</p>
    <p>Local: {{ $vacancy->location ?? '-' }}</p>
    <p>{{ $vacancy->description }}</p>
</div>
@endsection
