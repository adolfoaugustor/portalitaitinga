@extends('layouts.public')

@section('content')
    <div class="container py-5">
        <div class="mb-4">
            <a href="{{ route('public.agenda.index') }}" class="text-decoration-none text-primary">&larr; Voltar para Agenda Cultural</a>
        </div>

        <div class="card mb-4">
            <div class="card-body">
                <div class="d-flex flex-column flex-md-row justify-content-between gap-3 mb-4">
                    <div>
                        <h1 class="h3 mb-2">{{ $event->title }}</h1>
                        <p class="text-body-secondary mb-1">{{ $event->event_date->toFormattedDateString() }} · {{ $event->location ?? 'Local não informado' }}</p>
                        <p class="text-body-secondary mb-0">{{ $event->neighborhood ?? 'Bairro não informado' }}</p>
                    </div>
                    <div class="text-md-end">
                        <span class="badge bg-{{ $event->pricing_type === 'gratuito' ? 'success' : 'warning' }} text-dark">{{ ucfirst($event->pricing_type) }}</span>
                        @if($event->audience_type)
                            <span class="badge bg-secondary">{{ ucfirst($event->audience_type) }}</span>
                        @endif
                    </div>
                </div>

                @if($event->organizer_name)
                    <p class="mb-2"><strong>Organizador:</strong> {{ $event->organizer_name }}</p>
                @endif
                @if($event->event_type)
                    <p class="mb-2"><strong>Tipo:</strong> {{ $event->event_type }}</p>
                @endif
                <p class="mb-0">{{ $event->description ?? 'Sem descrição disponível para este evento.' }}</p>
            </div>
        </div>

        <div class="row g-4">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-body">
                        <h2 class="h5 mb-3">Programação do mesmo dia</h2>
                        @forelse ($sameDayEvents as $item)
                            <div class="mb-3">
                                <a class="h6 d-block mb-1" href="{{ route('public.agenda.show', ['date' => $item->event_date->toDateString(), 'slug' => $item->slug]) }}">{{ $item->title }}</a>
                                <p class="text-body-secondary mb-0">{{ $item->location ?? 'Local não informado' }} · {{ $item->event_type ?? 'Sem tipo' }}</p>
                            </div>
                        @empty
                            <div class="alert alert-secondary mb-0">Nenhum outro evento encontrado para este dia.</div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
