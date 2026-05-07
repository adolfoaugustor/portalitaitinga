@extends('layouts.public')

@section('content')
<div class="container py-5">
    <div class="mb-4">
        <a href="{{ route('public.vagas.index') }}" class="text-decoration-none text-primary">&larr; Voltar para vagas</a>
    </div>

    <x-public.content-card>
        <x-public.page-header
            :title="$vacancy->title"
            :subtitle="'Empresa: '.$vacancy->store_name"
        />
        <p class="feature-meta"><strong>Local:</strong> {{ $vacancy->location ?? 'Não informado' }}</p>
        <p class="mb-0">{{ $vacancy->description ?: 'Sem descrição disponível para esta vaga.' }}</p>
    </x-public.content-card>
</div>
@endsection
