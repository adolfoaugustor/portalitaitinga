@extends('layouts.auth')

@section('content')
<div class="container py-5">
    <div class="mb-4">
        <h1 class="mb-2">Guia Local</h1>
        @if($category)
            <p class="text-muted">Categoria: {{ ucfirst($category) }}</p>
        @endif
        <p class="text-muted">{{ $items->count() }} {{ $items->count() === 1 ? 'registro' : 'registros' }} encontrado(s).</p>
    </div>

    @forelse ($items as $item)
        <div class="card card-body mb-3">
            <div class="row g-3">
                <div class="col-md-8">
                    <h2 class="h5">{{ $item->name }}</h2>
                    <p class="mb-1"><strong>Setor:</strong> {{ $item->sector ?? ucfirst($item->category) }}</p>
                    @if($item->services)
                        <p class="mb-1"><strong>Serviços:</strong> {{ $item->services }}</p>
                    @endif
                    <p class="mb-1"><strong>Endereço:</strong> {{ $item->address ?? 'Não informado' }} {{ $item->neighborhood ? ' - '.$item->neighborhood : '' }} {{ $item->city ? ' / '.$item->city : '' }}</p>
                    @if($item->responsible)<p class="mb-1"><strong>Responsável:</strong> {{ $item->responsible }}</p>@endif
                </div>
                <div class="col-md-4">
                    <p class="mb-1"><strong>Telefone:</strong> {{ $item->phone }}</p>
                    @if($item->cnpj && $item->show_cnpj)
                        <p class="mb-1"><strong>CNPJ:</strong> {{ $item->cnpj }}</p>
                    @endif
                    @if ($item->contact_link)
                        <p class="mb-0"><a href="{{ $item->contact_link }}" target="_blank" class="btn btn-sm btn-outline-primary">Contato</a></p>
                    @endif
                </div>
            </div>
        </div>
    @empty
        <div class="alert alert-secondary">Nenhum registro publicado.</div>
    @endforelse
</div>
@endsection
