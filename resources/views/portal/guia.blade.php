@extends('layouts.portal')

@section('content')
<h1 class="h4 mb-3">Cadastro de Guia Local</h1>
<form method="POST" action="{{ route('portal.guia.store') }}" class="card card-body mb-4" enctype="multipart/form-data">
    @csrf

    <div class="row g-3">
        <div class="col-md-6">
            <label class="form-label">Nome da empresa</label>
            <input class="form-control" name="name" required value="{{ old('name', $item->name ?? '') }}">
        </div>
        <div class="col-md-6">
            <label class="form-label">Telefone de contato</label>
            <input class="form-control" name="phone" required value="{{ old('phone', $item->phone ?? '') }}">
        </div>

        <div class="col-md-6">
            <label class="form-label">Categoria</label>
            <select class="form-select" name="category" required>
                @foreach(['empresas' => 'Empresas', 'lojas' => 'Lojas', 'servicos' => 'Serviços', 'autonomo' => 'Autônomo'] as $value => $label)
                    <option value="{{ $value }}" {{ old('category', $item->category ?? '') === $value ? 'selected' : '' }}>{{ $label }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-6">
            <label class="form-label">Responsável</label>
            <input class="form-control" name="responsible" value="{{ old('responsible', $item->responsible ?? '') }}">
        </div>

        <div class="col-md-6">
            <label class="form-label">Endereço</label>
            <input class="form-control" name="address" value="{{ old('address', $item->address ?? '') }}">
        </div>
        <div class="col-md-6">
            <label class="form-label">Bairro</label>
            <input class="form-control" name="neighborhood" value="{{ old('neighborhood', $item->neighborhood ?? '') }}">
        </div>

        <div class="col-md-6">
            <label class="form-label">Cidade</label>
            <input class="form-control" name="city" value="{{ old('city', $item->city ?? '') }}">
        </div>
        <div class="col-md-6">
            <label class="form-label">Setor / área de atuação</label>
            <input class="form-control" name="sector" value="{{ old('sector', $item->sector ?? '') }}">
        </div>

        <div class="col-md-6">
            <label class="form-label">Serviços</label>
            <textarea class="form-control" name="services">{{ old('services', $item->services ?? '') }}</textarea>
        </div>
        <div class="col-md-6">
            <label class="form-label">Descrição</label>
            <textarea class="form-control" name="description">{{ old('description', $item->description ?? '') }}</textarea>
        </div>

        <div class="col-md-6">
            <label class="form-label">CNPJ</label>
            <input class="form-control" name="cnpj" value="{{ old('cnpj', $item->cnpj ?? '') }}">
        </div>
        <div class="col-md-6 mt-4">
            <div class="form-check mt-2">
                <input class="form-check-input" type="checkbox" name="show_cnpj" id="showCnpj" value="1" {{ old('show_cnpj', $item->show_cnpj ?? false) ? 'checked' : '' }}>
                <label class="form-check-label" for="showCnpj">Exibir CNPJ publicamente</label>
            </div>
        </div>

        <div class="col-12">
            <label class="form-label">Foto/logo</label>
            <input class="form-control" type="file" name="logo" accept="image/*">
        </div>

        <div class="col-12">
            <label class="form-label">Link de contato (Instagram, WhatsApp, site)</label>
            <input class="form-control" type="url" name="contact_link" value="{{ old('contact_link', $item->contact_link ?? '') }}">
        </div>

        <div class="col-12">
            <button class="btn btn-primary" type="submit">Salvar</button>
        </div>
    </div>
</form>

@if ($item)
    <div class="card card-body mb-4">
        <h2 class="h5">Seu guia local</h2>
        <p><strong>{{ $item->name }}</strong> ({{ ucfirst($item->category) }})</p>
        <p>Telefone: {{ $item->phone }}</p>
        @if ($item->responsible)<p>Responsável: {{ $item->responsible }}</p>@endif
        @if ($item->address)<p>Endereço: {{ $item->address }}</p>@endif
        @if ($item->neighborhood)<p>Bairro: {{ $item->neighborhood }}</p>@endif
        @if ($item->city)<p>Cidade: {{ $item->city }}</p>@endif
        @if ($item->sector)<p>Setor: {{ $item->sector }}</p>@endif
        @if ($item->services)<p>Serviços: {{ $item->services }}</p>@endif
        @if ($item->cnpj && $item->show_cnpj)<p>CNPJ: {{ $item->cnpj }}</p>@endif
        @if ($item->contact_link)<p><a href="{{ $item->contact_link }}" target="_blank">Link de contato</a></p>@endif
    </div>
@endif
@endsection
