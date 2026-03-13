@extends('layouts.portal')

@section('content')
<h1 class="h4 mb-3">Cadastro de guia local</h1>
<form method="POST" action="{{ route('portal.guia.store') }}" class="card card-body mb-4">
    @csrf
    <div class="mb-2"><label class="form-label">Nome</label><input class="form-control" name="name" required></div>
    <div class="mb-2"><label class="form-label">Categoria</label>
        <select class="form-select" name="category" required>
            <option value="empresas">empresas</option>
            <option value="lojas">lojas</option>
            <option value="servicos">servicos</option>
            <option value="autonomo">autonomo</option>
        </select>
    </div>
    <div class="mb-2"><label class="form-label">Cidade</label><input class="form-control" name="city"></div>
    <div class="mb-2"><label class="form-label">Descricao</label><textarea class="form-control" name="description"></textarea></div>
    <button class="btn btn-primary" type="submit">Salvar</button>
</form>

@foreach ($items as $item)
    <div class="card card-body mb-2">
        <strong>{{ $item->name }}</strong>
        <div>{{ $item->category }} - {{ $item->slug }}</div>
    </div>
@endforeach
@endsection
