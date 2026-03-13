@extends('layouts.public')

@section('content')
<div class="home-page">
    <header class="home-nav">
        <div class="container d-flex flex-wrap gap-3 align-items-center justify-content-between py-3">
            <a class="home-brand" href="{{ route('public.home') }}">Portal Itaitinga</a>
            <nav class="d-flex flex-wrap gap-2">
                <a href="{{ route('public.agenda.index') }}">Agenda Cultural</a>
                <a href="{{ route('public.guia.index') }}">Guia Local</a>
                <a href="{{ route('public.vagas.index') }}">Vagas</a>
                <a href="{{ route('public.classificados.index') }}">Classificados</a>
                <a href="{{ route('login') }}">Entrar</a>
            </nav>
        </div>
    </header>

    <section class="hero-search">
        <div class="container py-5 py-lg-6">
            <div class="hero-grid">
                <div>
                    <p class="hero-kicker">Pesquisa Geral</p>
                    <h1>Tudo o que voce procura em Itaitinga em um so lugar</h1>
                    <p class="hero-subtitle">Mockup inicial inspirado em portais locais: guia, agenda, vagas e classificados em uma busca unica.</p>
                </div>
                <form class="search-card" method="GET" action="{{ route('public.home') }}">
                    <div class="row g-2">
                        <div class="col-12">
                            <label class="form-label" for="q">O que voce procura?</label>
                            <input class="form-control" id="q" type="text" name="q" placeholder="Ex.: pizzaria, eletricista, estagio" value="{{ request('q') }}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" for="categoria">Categoria</label>
                            <select class="form-select" id="categoria" name="categoria">
                                <option>Todos os segmentos</option>
                                <option>Agenda Cultural</option>
                                <option>Guia Local</option>
                                <option>Vagas</option>
                                <option>Classificados</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" for="bairro">Bairro</label>
                            <select class="form-select" id="bairro" name="bairro">
                                <option>Todos os bairros</option>
                                <option>Centro</option>
                                <option>Jabuti</option>
                                <option>Ancuri</option>
                                <option>Parque Genezare</option>
                            </select>
                        </div>
                        <div class="col-12 d-grid d-md-flex gap-2">
                            <button class="btn btn-home-primary" type="submit">Buscar agora</button>
                            <a class="btn btn-home-secondary" href="{{ route('public.guia.index') }}">Explorar categorias</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <section class="quick-links py-4">
        <div class="container">
            <div class="row g-3">
                <div class="col-6 col-lg-3"><a class="quick-link" href="{{ route('public.agenda.index') }}">Agenda Cultural</a></div>
                <div class="col-6 col-lg-3"><a class="quick-link" href="{{ route('public.guia.index') }}">Empresas e Servicos</a></div>
                <div class="col-6 col-lg-3"><a class="quick-link" href="{{ route('public.vagas.index') }}">Vagas de Emprego</a></div>
                <div class="col-6 col-lg-3"><a class="quick-link" href="{{ route('public.classificados.index') }}">Marketplace Local</a></div>
            </div>
        </div>
    </section>

    <section class="py-5">
        <div class="container">
            <div class="section-title-row">
                <h2>Destaques da semana (mockups)</h2>
                <span>Dados ficticios para validacao de layout</span>
            </div>

            <div class="row g-4 mt-1">
                <div class="col-lg-6">
                    <article class="feature-block">
                        <div class="feature-head">
                            <h3>Agenda Cultural</h3>
                            <a href="{{ route('public.agenda.index') }}">Ver agenda completa</a>
                        </div>
                        @foreach ($highlightEvents as $item)
                            <a class="list-card" href="{{ $item['url'] }}">
                                <span class="badge badge-yellow">{{ $item['tag'] }}</span>
                                <strong>{{ $item['title'] }}</strong>
                                <small>{{ $item['when'] }} • {{ $item['where'] }}</small>
                            </a>
                        @endforeach
                    </article>
                </div>

                <div class="col-lg-6">
                    <article class="feature-block">
                        <div class="feature-head">
                            <h3>Guia Local</h3>
                            <a href="{{ route('public.guia.index') }}">Ver todos</a>
                        </div>
                        @foreach ($highlightBusinesses as $item)
                            <a class="list-card" href="{{ $item['url'] }}">
                                <strong>{{ $item['name'] }}</strong>
                                <small>{{ $item['category'] }} • {{ $item['neighborhood'] }}</small>
                                <span class="text-home-link">{{ $item['cta'] }}</span>
                            </a>
                        @endforeach
                    </article>
                </div>

                <div class="col-lg-6">
                    <article class="feature-block">
                        <div class="feature-head">
                            <h3>Vagas de Emprego</h3>
                            <a href="{{ route('public.vagas.index') }}">Ver vagas</a>
                        </div>
                        @foreach ($highlightJobs as $item)
                            <a class="list-card" href="{{ $item['url'] }}">
                                <strong>{{ $item['title'] }}</strong>
                                <small>{{ $item['meta'] }}</small>
                            </a>
                        @endforeach
                    </article>
                </div>

                <div class="col-lg-6">
                    <article class="feature-block">
                        <div class="feature-head">
                            <h3>Classificados</h3>
                            <a href="{{ route('public.classificados.index') }}">Ver anuncios</a>
                        </div>
                        @foreach ($highlightClassifieds as $item)
                            <a class="list-card" href="{{ $item['url'] }}">
                                <span class="badge badge-green">{{ $item['tag'] }}</span>
                                <strong>{{ $item['title'] }}</strong>
                                <small>{{ $item['price'] }} • {{ $item['place'] }}</small>
                            </a>
                        @endforeach
                    </article>
                </div>
            </div>
        </div>
    </section>

    <section class="public-services py-5">
        <div class="container">
            <div class="section-title-row">
                <h2>Utilidade publica</h2>
                <a href="{{ route('public.agenda.index') }}">Acompanhar eventos oficiais</a>
            </div>
            <div class="row g-3 mt-1">
                <div class="col-md-6 col-lg-3"><div class="utility-card"><strong>Saude</strong><p>UPA, postos e contatos rapidos.</p></div></div>
                <div class="col-md-6 col-lg-3"><div class="utility-card"><strong>Transporte</strong><p>Linhas e pontos mais buscados.</p></div></div>
                <div class="col-md-6 col-lg-3"><div class="utility-card"><strong>Telefones Uteis</strong><p>Guarda, SAMU e servicos essenciais.</p></div></div>
                <div class="col-md-6 col-lg-3"><div class="utility-card"><strong>Como Anunciar</strong><p>Passo a passo para empresas e autonomos.</p></div></div>
            </div>
        </div>
    </section>
</div>
@endsection
