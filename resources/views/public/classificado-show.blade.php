@extends('layouts.public')

@section('content')
<div class="container py-5">
    <div class="mb-4">
        <a href="{{ route('public.classificados.index') }}" class="text-decoration-none text-primary">&larr; Voltar para classificados</a>
    </div>

    <x-public.content-card>
        @if ($item->main_photo_path)
            <img src="{{ asset('storage/'.$item->main_photo_path) }}" alt="foto" style="max-width: 240px;" class="mb-3 rounded-3">
        @endif
        <x-public.page-header :title="$item->title" />
        <p class="feature-meta mb-1"><strong>Tipo:</strong> {{ $item->kind }}</p>
        <p class="feature-meta mb-1"><strong>Categoria:</strong> {{ $item->category }}</p>
        <p class="feature-meta mb-1"><strong>Preço:</strong> {{ $item->price ? 'R$ '.number_format($item->price, 2, ',', '.') : 'A combinar' }}</p>
        <p class="feature-meta mb-1"><strong>Bairro:</strong> {{ $item->neighborhood }}</p>
        <p class="feature-meta mb-3"><strong>Anunciante:</strong> {{ $item->advertiser_name }}</p>
        @if ($item->whatsapp_number)
            <a class="btn btn-success" target="_blank" href="https://wa.me/{{ preg_replace('/\D+/', '', $item->whatsapp_number) }}">Falar no WhatsApp</a>
        @endif
        <p class="mt-3 mb-0">{{ $item->description ?: 'Sem descrição disponível para este anúncio.' }}</p>
    </x-public.content-card>
</div>
@endsection
