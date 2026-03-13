@extends('layouts.auth')

@section('content')
<div class="container py-5">
    @if ($item->main_photo_path)
        <img src="{{ asset('storage/'.$item->main_photo_path) }}" alt="foto" style="max-width: 240px;" class="mb-3">
    @endif
    <h1>{{ $item->title }}</h1>
    <p>Tipo: {{ $item->kind }}</p>
    <p>Categoria: {{ $item->category }}</p>
    <p>Preco: {{ $item->price ?? '-' }}</p>
    <p>Bairro: {{ $item->neighborhood }}</p>
    <p>Anunciante: {{ $item->advertiser_name }}</p>
    @if ($item->whatsapp_number)
        <a class="btn btn-success" target="_blank" href="https://wa.me/{{ preg_replace('/\D+/', '', $item->whatsapp_number) }}">Falar no WhatsApp</a>
    @endif
    <p class="mt-3">{{ $item->description }}</p>
</div>
@endsection
