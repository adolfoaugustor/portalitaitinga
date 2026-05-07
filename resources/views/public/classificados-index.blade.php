@extends('layouts.public')

@section('content')
<div class="container py-5">
    <x-public.page-header
        title="Classificados"
        subtitle="Produtos, itens e serviços anunciados por moradores e empreendedores locais."
        :meta="$items->count().' '.($items->count() === 1 ? 'anúncio encontrado.' : 'anúncios encontrados.')"
    />

    <div class="row g-3">
        @forelse ($items as $item)
            <div class="col-md-6 col-lg-4">
                <div class="utility-card h-100 d-flex flex-column">
                    @if ($item->main_photo_path)
                        <img src="{{ asset('storage/'.$item->main_photo_path) }}" alt="foto" style="max-width: 180px;" class="mb-2 rounded-3">
                    @endif
                    <strong class="d-block mb-1">{{ $item->title }}</strong>
                    <div class="feature-meta">Categoria: {{ $item->category }}</div>
                    <div class="feature-meta">Preço: {{ $item->price ? 'R$ '.number_format($item->price, 2, ',', '.') : 'A combinar' }}</div>
                    <div class="feature-meta">Bairro: {{ $item->neighborhood }}</div>
                    <div class="feature-meta">Anunciante: {{ $item->advertiser_name }}</div>
                    <div class="d-flex gap-2 mt-auto pt-3">
                        @if ($item->whatsapp_number)
                            <a class="btn btn-success btn-sm" target="_blank" href="https://wa.me/{{ preg_replace('/\D+/', '', $item->whatsapp_number) }}">WhatsApp</a>
                        @endif
                        <a class="btn btn-outline-primary btn-sm" href="{{ route('public.classificados.show', ['slug' => $item->slug]) }}">Abrir item</a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <x-public.empty-state message="Nenhum classificado publicado." />
            </div>
        @endforelse
    </div>
</div>
@endsection
