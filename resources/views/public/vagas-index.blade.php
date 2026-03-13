@extends('layouts.auth')

@section('content')
<div class="container py-5">
    <h1>Vagas de Emprego</h1>
    @forelse ($items as $item)
        <div class="card card-body mb-2">
            <strong>{{ $item->title }}</strong>
            <div>Loja: {{ $item->store_name }}</div>
            <a href="{{ route('public.vagas.show', ['slug' => $item->slug]) }}">Abrir vaga</a>
        </div>
    @empty
        <div>Nenhuma vaga publicada.</div>
    @endforelse
</div>
@endsection
