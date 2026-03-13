<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? 'Portal CMS' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
<div class="sidebar sidebar-dark sidebar-fixed border-end" id="sidebar">
    <div class="sidebar-header border-bottom">
        <div class="sidebar-brand d-flex align-items-center justify-content-center">
            <span class="fw-semibold">ADM Portal</span>
        </div>
        <button class="btn-close d-lg-none" type="button" aria-label="Close menu" data-admin-sidebar-toggle></button>
    </div>

    <ul class="sidebar-nav" data-coreui="navigation" data-simplebar>
        <li class="nav-item mb-2"><a class="nav-link" href="{{ route('portal.dashboard') }}">Dashboard</a></li>

        <li class="nav-group" aria-expanded="false">
            <a class="nav-link nav-group-toggle" href="#">
                <svg class="nav-icon"><use xlink:href="{{ asset('assets/icons/coreui-free.svg#cil-sitemap') }}"></use></svg>
                agenda-cultural
            </a>
            <ul class="nav-group-items compact">
                <li class="nav-item"><a class="nav-link" href="{{ route('portal.agenda.index') }}"><span class="nav-icon"><span class="nav-icon-bullet"></span></span>Cadastro</a></li>
            </ul>
        </li>

        <li class="nav-group" aria-expanded="false">
            <a class="nav-link nav-group-toggle" href="#">
                <svg class="nav-icon"><use xlink:href="{{ asset('assets/icons/coreui-free.svg#cil-sitemap') }}"></use></svg>
                guia-local
            </a>
            <ul class="nav-group-items compact">
                <li class="nav-item"><a class="nav-link" href="{{ route('portal.guia.index') }}"><span class="nav-icon"><span class="nav-icon-bullet"></span></span>Cadastro</a></li>
            </ul>
        </li>

        <li class="nav-group" aria-expanded="false">
            <a class="nav-link nav-group-toggle" href="#">
                <svg class="nav-icon"><use xlink:href="{{ asset('assets/icons/coreui-free.svg#cil-sitemap') }}"></use></svg>
                vagas-de-empregos
            </a>
            <ul class="nav-group-items compact">
                <li class="nav-item"><a class="nav-link" href="{{ route('portal.vagas.index') }}"><span class="nav-icon"><span class="nav-icon-bullet"></span></span>Cadastro</a></li>
            </ul>
        </li>

        <li class="nav-group" aria-expanded="false">
            <a class="nav-link nav-group-toggle" href="#">
                <svg class="nav-icon"><use xlink:href="{{ asset('assets/icons/coreui-free.svg#cil-sitemap') }}"></use></svg>
                classificados
            </a>
            <ul class="nav-group-items compact">
                <li class="nav-item"><a class="nav-link" href="{{ route('portal.classificados.index') }}"><span class="nav-icon"><span class="nav-icon-bullet"></span></span>Cadastro</a></li>
            </ul>
        </li>

        <li class="nav-item mt-auto">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="nav-link border-0 bg-transparent text-start w-100" type="submit">Sair</button>
            </form>
        </li>
    </ul>
</div>

<div class="wrapper d-flex flex-column min-vh-100">
    <header class="header header-sticky p-0 mb-4">
        <div class="container-fluid border-bottom px-4">
            <button class="header-toggler" type="button" data-admin-sidebar-toggle>Menu</button>
            <div class="ms-auto small text-body-secondary">
                {{ auth()->user()->name }} ({{ auth()->user()->organizationName() }})
            </div>
        </div>
    </header>

    <main class="body flex-grow-1">
        <div class="container-lg px-4">
            @if (session('status'))
                <div class="alert alert-success">{{ session('status') }}</div>
            @endif
            @if ($errors->any())
                <div class="alert alert-danger">{{ $errors->first() }}</div>
            @endif
            @yield('content')
        </div>
    </main>
</div>
</body>
</html>
