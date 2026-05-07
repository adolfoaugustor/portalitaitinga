@extends('layouts.public')

@section('content')
<div class="container py-5">
    <x-public.page-header
        title="Guia Local"
        :subtitle="$category ? 'Categoria: '.ucfirst($category) : 'Empresas, comércios e serviços em Itaitinga.'"
        :meta="$items->count().' '.($items->count() === 1 ? 'registro encontrado.' : 'registros encontrados.')"
    />

    <div class="row g-4">
        @forelse ($items as $item)
            <div class="col-md-6 col-lg-4">
                <div class="utility-card h-100 d-flex flex-column">
                    <h2 class="h5">{{ $item->name }}</h2>
                    <p class="feature-meta mb-1"><strong>Setor:</strong> {{ $item->sector ?? ucfirst($item->category) }}</p>
                    @if($item->services)
                        <p class="mb-1"><strong>Serviços:</strong> {{ $item->services }}</p>
                    @endif
                    <p class="feature-meta mb-1"><strong>Endereço:</strong> {{ $item->address ?? 'Não informado' }} {{ $item->neighborhood ? ' - '.$item->neighborhood : '' }} {{ $item->city ? ' / '.$item->city : '' }}</p>
                    @if($item->responsible)<p class="mb-1"><strong>Responsável:</strong> {{ $item->responsible }}</p>@endif
                    <p class="mb-1"><strong>Telefone:</strong> {{ $item->phone }}</p>
                    @if($item->cnpj && $item->show_cnpj)
                        <p class="mb-1"><strong>CNPJ:</strong> {{ $item->cnpj }}</p>
                    @endif
                    @if ($item->contact_link)
                        <div class="mt-auto pt-3">
                            <a href="{{ $item->contact_link }}" target="_blank" class="btn btn-sm btn-outline-primary w-100">Contato</a>
                        </div>
                    @endif
                </div>
            </div>
        @empty
            <div class="col-12">
                <x-public.empty-state message="Nenhum registro publicado." />
            </div>
        @endforelse
    </div>
</div>
@endsection
