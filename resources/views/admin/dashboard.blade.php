@extends('layouts.admin')

@section('content')
    <div class="row g-4 mb-4">
        @foreach ($stats as $stat)
            <div class="col-sm-6 col-xl-4">
                <div class="card dashboard-stat">
                    <div class="card-body">
                        <div class="text-body-secondary text-uppercase small fw-semibold mb-2">{{ $stat['label'] }}</div>
                        <div class="display-6 fw-semibold">{{ $stat['value'] }}</div>
                        <div class="small text-body-secondary mt-3">{{ $stat['context'] }}</div>
                    </div>
                    <div class="card-footer bg-transparent border-top-0 pt-0 pb-3 px-4">
                        <span class="status-dot bg-{{ $stat['color'] }}"></span>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="row g-4">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">Resumo</div>
                <div class="card-body">
                    <p class="mb-3">A aplicacao agora usa o fluxo tradicional de autenticacao por sessao do Laravel. A rota protegida principal ficou em <code>/admin</code>.</p>
                    <p class="mb-0">A partir daqui voce pode seguir montando os modulos administrativos em controllers, Blade e rotas comuns, sem dependencias do Filament.</p>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">Conta autenticada</div>
                <div class="card-body">
                    <div class="fw-semibold">{{ auth()->user()->name }}</div>
                    <div class="text-body-secondary">{{ auth()->user()->email }}</div>
                </div>
            </div>
        </div>
    </div>
@endsection
