@extends('layouts.portal')

@section('content')
<h1 class="h4 mb-3">Cadastro de classificados</h1>
<form method="POST" action="{{ route('portal.classificados.store') }}" class="card card-body mb-4">
    @csrf
    <div class="mb-2"><label class="form-label">Titulo</label><input class="form-control" name="title" required></div>
    <div class="mb-2"><label class="form-label">Tipo</label>
        <select class="form-select" name="kind" required>
            <option value="item">item</option>
            <option value="produto">produto</option>
            <option value="servico">servico</option>
        </select>
    </div>
    <div class="mb-2"><label class="form-label">Preco</label><input class="form-control" type="number" step="0.01" name="price"></div>
    <div class="mb-2"><label class="form-label">Descricao</label><textarea class="form-control" name="description"></textarea></div>
    <button class="btn btn-primary" type="submit">Salvar</button>
</form>

@foreach ($items as $item)
    <div class="card card-body mb-2">
        <strong>{{ $item->title }}</strong>
        <div>{{ $item->kind }} - {{ $item->slug }}</div>
    </div>
@endforeach
@endsection
