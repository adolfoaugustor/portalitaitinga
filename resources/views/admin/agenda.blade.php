@extends('layouts.admin')

@section('content')
    <div class="d-flex flex-column flex-md-row align-items-start justify-content-between mb-4 gap-3">
        <div>
            <h1 class="h4 mb-1">Cadastro de Agenda Cultural</h1>
            <p class="text-body-secondary mb-0">Crie e gerencie eventos públicos. Cada usuário pode ter até 3 eventos ativos simultâneos.</p>
        </div>
        <div class="text-end">
            <span class="badge bg-success">Eventos ativos: {{ $activeItemCount }} / 3</span>
        </div>
    </div>

    @if(session('status'))
        <div class="alert alert-success">{{ session('status') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <form method="POST" action="{{ route('admin.agenda.store') }}" class="card card-body mb-4">
        @csrf
        <div class="row gy-3">
            <div class="col-md-6">
                <label class="form-label">Título</label>
                <input class="form-control" name="title" value="{{ old('title') }}" required>
            </div>
            <div class="col-md-3">
                <label class="form-label">Data</label>
                <input class="form-control" type="date" name="event_date" value="{{ old('event_date') }}" required>
            </div>
            <div class="col-md-3">
                <label class="form-label">Gratuito/Pago</label>
                <select class="form-select" name="pricing_type" required>
                    <option value="gratuito" {{ old('pricing_type') === 'gratuito' ? 'selected' : '' }}>gratuito</option>
                    <option value="pago" {{ old('pricing_type') === 'pago' ? 'selected' : '' }}>pago</option>
                </select>
            </div>
            <div class="col-md-4">
                <label class="form-label">Bairro</label>
                <input class="form-control" name="neighborhood" value="{{ old('neighborhood') }}">
            </div>
            <div class="col-md-4">
                <label class="form-label">Tipo de evento</label>
                <input class="form-control" name="event_type" value="{{ old('event_type') }}">
            </div>
            <div class="col-md-4">
                <label class="form-label">Público</label>
                <select class="form-select" name="audience_type">
                    <option value="">-</option>
                    <option value="infantil" {{ old('audience_type') === 'infantil' ? 'selected' : '' }}>infantil</option>
                    <option value="familia" {{ old('audience_type') === 'familia' ? 'selected' : '' }}>familia</option>
                    <option value="geral" {{ old('audience_type') === 'geral' ? 'selected' : '' }}>geral</option>
                </select>
            </div>
            <div class="col-md-6">
                <label class="form-label">Organizador</label>
                <input class="form-control" name="organizer_name" value="{{ old('organizer_name') }}">
            </div>
            <div class="col-md-6">
                <label class="form-label">Local</label>
                <input class="form-control" name="location" value="{{ old('location') }}">
            </div>
            <div class="col-12">
                <label class="form-label">Descrição</label>
                <textarea class="form-control" name="description" rows="4">{{ old('description') }}</textarea>
            </div>
            <div class="col-12 text-end">
                <button class="btn btn-primary" type="submit" {{ $activeItemCount >= 3 ? 'disabled' : '' }}>Salvar evento</button>
            </div>
        </div>
    </form>

    <div class="row g-3">
        @forelse($items as $item)
            <div class="col-lg-4">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between mb-2">
                            <h2 class="h6 mb-0">{{ $item->title }}</h2>
                            <span class="badge bg-{{ $item->event_date->isPast() ? 'secondary' : 'info' }}">
                                {{ $item->event_date->isPast() ? 'Expirado' : 'Ativo' }}
                            </span>
                        </div>
                        <p class="mb-1 text-body-secondary">{{ $item->event_date->toDateString() }} · {{ $item->neighborhood ?? 'Sem bairro' }}</p>
                        <p class="mb-1"><strong>{{ $item->event_type ?? 'Sem categoria' }}</strong></p>
                        <p class="mb-1">{{ $item->pricing_type }} · {{ $item->audience_type ?? 'Público geral' }}</p>
                        <p class="mb-0 text-truncate">{{ $item->description ?? 'Sem descrição' }}</p>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-secondary mb-0">Nenhum evento cadastrado ainda.</div>
            </div>
        @endforelse
    </div>
@endsection
