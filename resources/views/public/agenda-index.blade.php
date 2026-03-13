@extends('layouts.auth')

@section('content')
<div class="container py-5">
    <h1>Agenda Cultural</h1>

    <form method="GET" class="row g-2 mb-4">
        <div class="col-md-2"><input class="form-control" type="date" name="data" value="{{ request('data') }}"></div>
        <div class="col-md-2"><input class="form-control" name="bairro" placeholder="bairro" value="{{ request('bairro') }}"></div>
        <div class="col-md-2"><input class="form-control" name="tipo" placeholder="tipo de evento" value="{{ request('tipo') }}"></div>
        <div class="col-md-2">
            <select class="form-select" name="preco">
                <option value="">gratuito/pago</option>
                <option value="gratuito" @selected(request('preco') === 'gratuito')>gratuito</option>
                <option value="pago" @selected(request('preco') === 'pago')>pago</option>
            </select>
        </div>
        <div class="col-md-2">
            <select class="form-select" name="publico">
                <option value="">publico</option>
                <option value="infantil" @selected(request('publico') === 'infantil')>infantil</option>
                <option value="familia" @selected(request('publico') === 'familia')>familia</option>
                <option value="geral" @selected(request('publico') === 'geral')>geral</option>
            </select>
        </div>
        <div class="col-md-2"><input class="form-control" name="organizador" placeholder="organizador" value="{{ request('organizador') }}"></div>
        <div class="col-12"><button class="btn btn-primary" type="submit">Filtrar</button></div>
    </form>

    @forelse ($events as $event)
        <div class="card card-body mb-2">
            <strong>{{ $event->title }}</strong>
            <div>{{ $event->event_date->toDateString() }} | {{ $event->neighborhood }} | {{ $event->event_type }}</div>
            <div>{{ $event->pricing_type }} | {{ $event->audience_type }} | {{ $event->organizer_name }}</div>
            <a href="{{ route('public.agenda.show', ['date' => $event->event_date->toDateString(), 'slug' => $event->slug]) }}">Abrir evento</a>
        </div>
    @empty
        <div>Nenhum evento publicado.</div>
    @endforelse
</div>
@endsection
