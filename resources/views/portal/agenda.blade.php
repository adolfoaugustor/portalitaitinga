@extends('layouts.portal')

@section('content')
<h1 class="h4 mb-3">Cadastro de agenda cultural</h1>
<form method="POST" action="{{ route('portal.agenda.store') }}" class="card card-body mb-4">
    @csrf
    <div class="mb-2"><label class="form-label">Titulo</label><input class="form-control" name="title" required></div>
    <div class="mb-2"><label class="form-label">Data</label><input class="form-control" type="date" name="event_date" required></div>
    <div class="mb-2"><label class="form-label">Local</label><input class="form-control" name="location"></div>
    <div class="mb-2"><label class="form-label">Descricao</label><textarea class="form-control" name="description"></textarea></div>
    <button class="btn btn-primary" type="submit">Salvar</button>
</form>

@foreach ($items as $item)
    <div class="card card-body mb-2">
        <strong>{{ $item->title }}</strong>
        <div>{{ $item->event_date->toDateString() }} - {{ $item->slug }}</div>
    </div>
@endforeach
@endsection
