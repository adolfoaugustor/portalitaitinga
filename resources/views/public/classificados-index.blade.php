@extends('layouts.auth')

@section('content')
<div class="container py-5">
    <h1>Classificados</h1>
    @forelse ($items as $item)
        <div class="card card-body mb-2">
            @if ($item->main_photo_path)
                <img src="{{ asset('storage/'.$item->main_photo_path) }}" alt="foto" style="max-width: 180px;" class="mb-2">
            @endif
            <strong>{{ $item->title }}</strong>
            <div>Categoria: {{ $item->category }}</div>
            <div>Preco: {{ $item->price }}</div>
            <div>Bairro: {{ $item->neighborhood }}</div>
            <div>Anunciante: {{ $item->advertiser_name }}</div>
            @if ($item->whatsapp_number)
                <a class="btn btn-success btn-sm mt-2" target="_blank" href="https://wa.me/{{ preg_replace('/\D+/', '', $item->whatsapp_number) }}">WhatsApp</a>
            @endif
            <a href="{{ route('public.classificados.show', ['slug' => $item->slug]) }}">Abrir item</a>
        </div>
    @empty
        <div>Nenhum classificado publicado.</div>
    @endforelse
</div>
@endsection
