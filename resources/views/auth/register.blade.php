@extends('layouts.auth')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card-group d-block d-md-flex row shadow">
                    <div class="card col-md-7 p-4 mb-0">
                        <div class="card-body">
                            <h1>Cadastrar-se</h1>
                            <p class="text-body-secondary">Crie sua conta preenchendo as informações abaixo.</p>

                            @if ($errors->any())
                                <div class="alert alert-danger" role="alert">
                                    {{ $errors->first() }}
                                </div>
                            @endif

                            <form method="POST" action="{{ route('register.store') }}">
                                @csrf

                                <div class="input-group mb-3">
                                    <span class="input-group-text">
                                        <svg class="icon">
                                            <use xlink:href="{{ asset('assets/icons/coreui-free.svg#cil-user') }}"></use>
                                        </svg>
                                    </span>
                                    <input class="form-control" type="text" name="name" placeholder="Nome" value="{{ old('name') }}" required autofocus>
                                </div>

                                <div class="input-group mb-3">
                                    <span class="input-group-text">
                                        <svg class="icon">
                                            <use xlink:href="{{ asset('assets/icons/coreui-free.svg#cil-envelope-closed') }}"></use>
                                        </svg>
                                    </span>
                                    <input class="form-control" type="email" name="email" placeholder="E-mail" value="{{ old('email') }}" required>
                                </div>

                                <div class="input-group mb-3">
                                    <span class="input-group-text">
                                        <svg class="icon">
                                            <use xlink:href="{{ asset('assets/icons/coreui-free.svg#cil-lock-locked') }}"></use>
                                        </svg>
                                    </span>
                                    <input class="form-control" type="password" name="password" placeholder="Senha" required>
                                </div>

                                <div class="input-group mb-3">
                                    <span class="input-group-text">
                                        <svg class="icon">
                                            <use xlink:href="{{ asset('assets/icons/coreui-free.svg#cil-lock-locked') }}"></use>
                                        </svg>
                                    </span>
                                    <input class="form-control" type="password" name="password_confirmation" placeholder="Confirmar Senha" required>
                                </div>

                                <div class="row">
                                    <div class="col-6">
                                        <button class="btn btn-primary px-4" type="submit">Cadastrar</button>
                                    </div>
                                    <div class="col-6 text-end">
                                        <a href="{{ route('login') }}" class="btn btn-link">Já tem conta? Entrar</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection