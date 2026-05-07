<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? 'Portal Itaitinga' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="public-shell">
    <header class="public-topbar sticky-top">
        <div class="container py-3 d-flex flex-wrap gap-3 align-items-center justify-content-between">
            <a class="navbar-brand fw-bold text-decoration-none" href="{{ route('public.home') }}">Portal Itaitinga</a>
            <nav class="d-flex flex-wrap align-items-center gap-3">
                <a class="nav-link" href="{{ route('public.home') }}">Início</a>
                <a class="nav-link" href="{{ route('public.agenda.index') }}">Agenda Cultural</a>
                <a class="nav-link" href="{{ route('public.guia.index') }}">Guia Local</a>
                <a class="nav-link" href="{{ route('public.vagas.index') }}">Vagas</a>
                <a class="nav-link" href="{{ route('public.classificados.index') }}">Classificados</a>
            </nav>
            <div class="d-flex gap-2 align-items-center">
                @if(auth()->check())
                    <a class="btn btn-sm btn-outline-primary" href="{{ route('portal.dashboard') }}">Meu Portal</a>
                @else
                    <a class="btn btn-sm btn-outline-primary" href="{{ route('login') }}">Entrar</a>
                    <a class="btn btn-sm btn-primary" href="{{ route('register') }}">Cadastrar-se</a>
                @endif
            </div>
        </div>
    </header>

    <main class="public-main">
        @yield('content')
    </main>

    <footer class="public-footer py-5 mt-5">
        <div class="container">
            <div class="row g-4">
                <div class="col-md-4">
                    <h2 class="public-footer-title">Portal Itaitinga</h2>
                    <p class="mb-2 text-body-secondary">Informações, serviços locais e oportunidades da cidade em um só lugar.</p>
                    <p class="mb-0 text-body-secondary">Itaitinga · Ceará</p>
                </div>
                <div class="col-md-4">
                    <h2 class="public-footer-title">Acesso rápido</h2>
                    <div class="d-flex flex-column gap-1">
                        <a class="public-footer-link" href="{{ route('public.agenda.index') }}">Agenda Cultural</a>
                        <a class="public-footer-link" href="{{ route('public.guia.index') }}">Guia Local</a>
                        <a class="public-footer-link" href="{{ route('public.vagas.index') }}">Vagas de Emprego</a>
                        <a class="public-footer-link" href="{{ route('public.classificados.index') }}">Classificados</a>
                    </div>
                </div>
                <div class="col-md-4">
                    <h2 class="public-footer-title">Área do colaborador</h2>
                    <div class="d-flex flex-column gap-1">
                        <a class="public-footer-link" href="{{ route('login') }}">Entrar</a>
                        <a class="public-footer-link" href="{{ route('register') }}">Criar conta</a>
                        <a class="public-footer-link" href="{{ route('portal.dashboard') }}">Painel do Portal</a>
                    </div>
                </div>
            </div>
        </div>
    </footer>
</body>
</html>
