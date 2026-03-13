<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? 'Admin | Portal Itaitinga' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <div class="sidebar sidebar-dark sidebar-fixed border-end" id="sidebar">
        <div class="sidebar-header border-bottom">
            <div class="sidebar-brand d-flex align-items-center justify-content-center">
                <span class="fw-semibold">ADM Portal Itaitinga</span>
            </div>
            <button class="btn-close d-lg-none" type="button" aria-label="Fechar menu" data-admin-sidebar-toggle></button>
        </div>

        <ul class="sidebar-nav" data-coreui="navigation" data-simplebar>
            <li class="nav-title">Administracao</li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
                    <svg class="nav-icon">
                        <use xlink:href="{{ asset('assets/icons/coreui-free.svg#cil-speedometer') }}"></use>
                    </svg>
                    Dashboard
                </a>
            </li>
            <li class="nav-item mt-auto">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="nav-link border-0 bg-transparent text-start w-100" type="submit">
                        <svg class="nav-icon">
                            <use xlink:href="{{ asset('assets/icons/coreui-free.svg#cil-account-logout') }}"></use>
                        </svg>
                        Sair
                    </button>
                </form>
            </li>
        </ul>

        <div class="sidebar-footer border-top d-none d-md-flex">
            <button class="sidebar-toggler" type="button" data-coreui-toggle="unfoldable"></button>
        </div>
    </div>

    <div class="wrapper d-flex flex-column min-vh-100">
        <header class="header header-sticky p-0 mb-4">
            <div class="container-fluid border-bottom px-4">
                <button class="header-toggler" type="button" data-admin-sidebar-toggle>
                    <svg class="icon icon-lg">
                        <use xlink:href="{{ asset('assets/icons/coreui-free.svg#cil-menu') }}"></use>
                    </svg>
                </button>

                <ul class="header-nav ms-auto">
                    <li class="nav-item dropdown">
                        <button class="nav-link py-0 bg-transparent border-0 d-flex align-items-center gap-2" type="button" data-coreui-toggle="dropdown" aria-expanded="false">
                            <span class="avatar avatar-md bg-primary text-white">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</span>
                            <span class="d-none d-md-inline">{{ auth()->user()->name }}</span>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end pt-0">
                            <div class="dropdown-header bg-body-secondary fw-semibold rounded-top mb-2">Sessao</div>
                            <span class="dropdown-item-text small text-body-secondary">{{ auth()->user()->email }}</span>
                            <div class="dropdown-divider"></div>
                            <button class="dropdown-item" type="button" data-coreui-theme-value="light">Tema claro</button>
                            <button class="dropdown-item" type="button" data-coreui-theme-value="dark">Tema escuro</button>
                            <button class="dropdown-item" type="button" data-coreui-theme-value="auto">Tema automatico</button>
                        </div>
                    </li>
                </ul>
            </div>
        </header>

        <div class="body flex-grow-1">
            <div class="container-lg px-4">
                @yield('content')
            </div>
        </div>
    </div>
</body>
</html>



