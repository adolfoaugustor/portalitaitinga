@extends('layouts.portal')

@section('content')
    <h1 class="h3 mb-4">User portal</h1>
    <div class="row g-3">
        <div class="col-md-3"><div class="card"><div class="card-body">Agenda: {{ $totals['agenda'] }}</div></div></div>
        <div class="col-md-3"><div class="card"><div class="card-body">Guia local: {{ $totals['guia'] }}</div></div></div>
        <div class="col-md-3"><div class="card"><div class="card-body">Vagas: {{ $totals['vagas'] }}</div></div></div>
        <div class="col-md-3"><div class="card"><div class="card-body">Classificados: {{ $totals['classificados'] }}</div></div></div>
    </div>
@endsection
