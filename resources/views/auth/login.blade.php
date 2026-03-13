@extends('layouts.auth')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card-group d-block d-md-flex row shadow">
                    <div class="card col-md-7 p-4 mb-0">
                        <div class="card-body">
                            <h1>Login</h1>
                            <p class="text-body-secondary">Acesse preechendo as informações de usuário e senha.</p>

                            @if ($errors->any())
                                <div class="alert alert-danger" role="alert">
                                    {{ $errors->first() }}
                                </div>
                            @endif

                            <form method="POST" action="{{ route('login.store') }}">
                                @csrf

                                <div class="input-group mb-3">
                                    <span class="input-group-text">
                                        <svg class="icon">
                                            <use xlink:href="{{ asset('assets/icons/coreui-free.svg#cil-user') }}"></use>
                                        </svg>
                                    </span>
                                    <input class="form-control" type="email" name="email" placeholder="E-mail" value="{{ old('email') }}" required autofocus>
                                </div>

                                <div class="input-group mb-3">
                                    <span class="input-group-text">
                                        <svg class="icon">
                                            <use xlink:href="{{ asset('assets/icons/coreui-free.svg#cil-lock-locked') }}"></use>
                                        </svg>
                                    </span>
                                    <input class="form-control" type="password" name="password" placeholder="Senha" required>
                                </div>

                                <div class="form-check mb-4">
                                    <input class="form-check-input" id="remember" type="checkbox" name="remember" value="1">
                                    <label class="form-check-label" for="remember">Manter conectado</label>
                                </div>

                                <div class="row">
                                    <div class="col-6">
                                        <button class="btn btn-primary px-4" type="submit">Entrar</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="card col-md-5 text-white auth-card-side py-5">
                        <div class="card-body text-center d-flex flex-column justify-content-center">
                            <div>
                                <h2>Painel administrativo</h2>
                                <p>Login para o portal itaitinga</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
