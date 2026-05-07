@extends('layouts.public')

@section('content')
<div class="container py-5">
    <x-public.page-header
        title="Vagas de Emprego"
        subtitle="Oportunidades abertas em Itaitinga para diferentes perfis profissionais."
        :meta="$items->count().' '.($items->count() === 1 ? 'vaga encontrada.' : 'vagas encontradas.')"
    />

    <div class="row g-3">
        @forelse ($items as $item)
            <div class="col-md-6 col-lg-4">
                <a class="list-card h-100 d-flex flex-column" href="{{ route('public.vagas.show', ['slug' => $item->slug]) }}">
                    <strong>{{ $item->title }}</strong>
                    <small>Loja: {{ $item->store_name }}</small>
                </a>
            </div>
        @empty
            <div class="col-12">
                <x-public.empty-state message="Nenhuma vaga publicada." />
            </div>
        @endforelse
    </div>
</div>
@endsection
