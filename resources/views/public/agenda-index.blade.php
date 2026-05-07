@extends('layouts.public')

@section('content')
    <div class="container py-5">
        <x-public.page-header
            title="Agenda Cultural"
            subtitle="Descubra eventos de Itaitinga por data, bairro, tipo e valor. Encontre programação local atualizada e gratuita."
            :meta="'Exibindo '.$events->count().' evento'.($events->count() === 1 ? '' : 's').'.'"
        />

        <form method="GET" class="row g-2 align-items-end filter-panel">
            <div class="col-md-3">
                <label class="form-label visually-hidden">Data</label>
                <input class="form-control" type="date" name="data" value="{{ request('data') }}" placeholder="Data">
            </div>
            <div class="col-md-3">
                <label class="form-label visually-hidden">Bairro</label>
                <input class="form-control" name="bairro" placeholder="Bairro" value="{{ request('bairro') }}">
            </div>
            <div class="col-md-2">
                <label class="form-label visually-hidden">Tipo</label>
                <input class="form-control" name="tipo" placeholder="Tipo" value="{{ request('tipo') }}">
            </div>
            <div class="col-md-1">
                <label class="form-label visually-hidden">Preço</label>
                <select class="form-select" name="preco" style="min-width:0">
                    <option value="">Preço</option>
                    <option value="gratuito" @selected(request('preco') === 'gratuito')>Gratuito</option>
                    <option value="pago" @selected(request('preco') === 'pago')>Pago</option>
                </select>
            </div>
            <div class="col-md-1">
                <label class="form-label visually-hidden">Público</label>
                <select class="form-select" name="publico" style="min-width:0">
                    <option value="">Público</option>
                    <option value="infantil" @selected(request('publico') === 'infantil')>Infantil</option>
                    <option value="familia" @selected(request('publico') === 'familia')>Família</option>
                    <option value="geral" @selected(request('publico') === 'geral')>Geral</option>
                </select>
            </div>
            <div class="col-md-2 text-end">
                <button class="btn btn-primary w-100" type="submit">Filtrar</button>
            </div>
        </form>

        <div class="row g-4">
            @forelse ($events as $event)
                <div class="col-lg-4">
                    <div class="utility-card d-flex flex-column h-100">
                        <div class="mb-3">
                            <span class="badge bg-{{ $event->pricing_type === 'gratuito' ? 'success' : 'warning' }} text-dark">{{ ucfirst($event->pricing_type) }}</span>
                            @if($event->audience_type)
                                <span class="badge bg-secondary">{{ ucfirst($event->audience_type) }}</span>
                            @endif
                        </div>
                        <h2 class="h5 card-title">{{ $event->title }}</h2>
                        <p class="feature-meta mb-1"><strong>Data:</strong> {{ $event->event_date->toFormattedDateString() }}</p>
                        <p class="feature-meta mb-1"><strong>Local:</strong> {{ $event->location ?? 'Não informado' }}</p>
                        <p class="feature-meta mb-1"><strong>Bairro:</strong> {{ $event->neighborhood ?? 'Não informado' }}</p>
                        <p class="mb-3 text-truncate">{{ $event->description ?? 'Sem descrição adicional.' }}</p>
                        <div class="mt-auto">
                            <a class="btn btn-outline-primary w-100" href="{{ route('public.agenda.show', ['date' => $event->event_date->toDateString(), 'slug' => $event->slug]) }}">Ver detalhes</a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <x-public.empty-state message="Nenhum evento publicado encontrado." />
                </div>
            @endforelse
        </div>
    </div>
@endsection
