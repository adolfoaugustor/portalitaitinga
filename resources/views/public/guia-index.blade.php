@extends('layouts.auth')

@section('content')
<div class="container py-5">
    <h1>Guia Local @if($category) - {{ $category }} @endif</h1>
    @forelse ($items as $item)
        <div class="card card-body mb-2">
            <strong>{{ $item->name }}</strong>
            <div>Categoria: {{ $item->category }}</div>
            <div>Endereco/bairro: {{ $item->address_neighborhood }}</div>
            <div>Horario: {{ $item->opening_hours }}</div>
            <div>WhatsApp: {{ $item->phone_whatsapp }}</div>
            @if ($item->contact_link)
                <a href="{{ $item->contact_link }}" target="_blank">Abrir contato</a>
            @endif
        </div>
    @empty
        <div>Nenhum registro publicado.</div>
    @endforelse
</div>
@endsection
