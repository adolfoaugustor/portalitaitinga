@extends('layouts.public')

@section('content')
<div class="home-page">
    <header class="home-nav">
        <div class="container d-flex flex-wrap gap-3 align-items-center justify-content-between py-3">
            <a class="home-brand" href="{{ route('public.home') }}">Portal Itaitinga</a>
            <nav class="d-flex flex-wrap gap-2 align-items-center">
                <a href="{{ route('public.agenda.index') }}">Agenda Cultural</a>
                <a href="{{ route('public.guia.index') }}">Guia Local</a>
                <a href="{{ route('public.vagas.index') }}">Vagas</a>
                <a href="{{ route('public.classificados.index') }}">Classificados</a>
                <div class="ms-auto d-flex gap-2">
                    @if(auth()->check())
                        <a href="{{ route('portal.dashboard') }}">Admin</a>
                    @else
                        <a href="{{ route('login') }}">Entrar</a>
                        <a href="{{ route('register') }}">Cadastrar-se</a>
                    @endif
                </div>
            </nav>
        </div>
    </header>

    <section class="hero-search" style="background-image: url('https://images.unsplash.com/photo-1489515217757-5fd1be406fef?auto=format&fit=crop&w=1600&h=300&q=80'); background-size: cover; background-position: center; position: relative;">
        <div style="position:absolute;inset:0;background:rgba(10,30,60,0.68);z-index:0;"></div>
        <div class="container py-5 py-lg-6" style="position:relative;z-index:1;">
            <div class="hero-grid">
                <div>
                    <p class="hero-kicker" style="color:#90caf9;text-shadow:0 1px 4px rgba(0,0,0,.6);">Pesquisa Geral</p>
                    <h1 style="color:#ffffff;text-shadow:0 2px 8px rgba(0,0,0,.7);">Tudo o que voce procura em Itaitinga em um so lugar</h1>
                    <p class="hero-subtitle" style="color:#d0e8ff;text-shadow:0 1px 4px rgba(0,0,0,.5);">Guia local, agenda cultural, vagas de emprego e classificados em um unico portal.</p>
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
                        <div class="col-12">
                            <div class="d-flex gap-2">
                                <button class="btn btn-primary flex-fill col-6" type="submit">Buscar agora</button>
                                <a class="btn btn-success flex-fill col-6 text-center" href="{{ route('public.guia.index') }}">Explorar categorias</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <section class="quick-links py-4">
        <div class="container">
            <div id="homeBannerCarousel" class="carousel slide home-banner" data-coreui-ride="carousel" data-coreui-interval="5000">
                <div class="carousel-indicators home-banner-indicators">
                    <button type="button" data-coreui-target="#homeBannerCarousel" data-coreui-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                    <button type="button" data-coreui-target="#homeBannerCarousel" data-coreui-slide-to="1" aria-label="Slide 2"></button>
                    <button type="button" data-coreui-target="#homeBannerCarousel" data-coreui-slide-to="2" aria-label="Slide 3"></button>
                    <button type="button" data-coreui-target="#homeBannerCarousel" data-coreui-slide-to="3" aria-label="Slide 4"></button>
                </div>

                <div class="carousel-inner rounded-4">
                    <div class="carousel-item active">
                        <a href="{{ route('public.classificados.index') }}" class="home-banner-link">
                            <img src="https://images.unsplash.com/photo-1485291571150-772bcfc10da5?auto=format&fit=crop&w=1200&h=500&q=80" class="d-block w-100 home-banner-image" alt="Banner 1">
                        </a>
                    </div>
                    <div class="carousel-item">
                        <a href="{{ route('public.guia.index') }}" class="home-banner-link">
                            <img src="https://images.unsplash.com/photo-1441986300917-64674bd600d8?auto=format&fit=crop&w=1200&h=500&q=80" class="d-block w-100 home-banner-image" alt="Banner 2">
                        </a>
                    </div>
                    <div class="carousel-item">
                        <a href="{{ route('public.agenda.index') }}" class="home-banner-link">
                            <img src="https://images.unsplash.com/photo-1492684223066-81342ee5ff30?auto=format&fit=crop&w=1200&h=500&q=80" class="d-block w-100 home-banner-image" alt="Banner 3">
                        </a>
                    </div>
                    <div class="carousel-item">
                        <a href="{{ route('public.vagas.index') }}" class="home-banner-link">
                            <img src="https://images.unsplash.com/photo-1521737604893-d14cc237f11d?auto=format&fit=crop&w=1200&h=500&q=80" class="d-block w-100 home-banner-image" alt="Banner 4">
                        </a>
                    </div>
                </div>

                <button class="carousel-control-prev" type="button" data-coreui-target="#homeBannerCarousel" data-coreui-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-coreui-target="#homeBannerCarousel" data-coreui-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
    </section>

    <section class="py-5">
        <div class="container">
            <div class="section-title-row">
                <h2>Destaques da semana</h2>
                <span>Conteúdo gerado a partir dos itens cadastrados.</span>
            </div>

            <div class="row g-4 mt-1">

                <div class="col-lg-6">
                    <article class="feature-block">
                        <div class="feature-head">
                            <h3>Classificados</h3>
                            <a href="{{ route('public.classificados.index') }}">Ver anuncios</a>
                        </div>
                        @forelse ($highlightClassifieds as $item)
                            <a class="list-card" href="{{ route('public.classificados.index') }}">
                                <span class="badge badge-green">Novo</span>
                                <strong>{{ $item->title }}</strong>
                                <small>R$ {{ number_format($item->price, 2, ',', '.') }} &bull; {{ $item->neighborhood }}</small>
                            </a>
                        @empty
                            <div class="text-muted">Nenhum classificado publicado.</div>
                        @endforelse
                    </article>
                </div>

                <div class="col-lg-6">
                    <article class="feature-block">
                        <div class="feature-head">
                            <h3>Guia Local</h3>
                            <a href="{{ route('public.guia.index') }}">Ver todos</a>
                        </div>
                        @forelse ($highlightBusinesses as $item)
                            <a class="list-card" href="{{ route('public.guia.category', ['category' => $item->category]) }}">
                                <strong>{{ $item->name }}</strong>
                                <small>{{ ucfirst($item->sector ?: $item->category) }} &bull; {{ $item->neighborhood }}</small>
                                <span class="text-home-link">Ver no guia</span>
                            </a>
                        @empty
                            <div class="text-muted">Nenhum item do guia local publicado.</div>
                        @endforelse
                    </article>
                </div>

                <div class="col-lg-6">
                    <article class="feature-block">
                        <div class="feature-head">
                            <h3>Vagas de Emprego</h3>
                            <a href="{{ route('public.vagas.index') }}">Ver vagas</a>
                        </div>
                        @forelse ($highlightJobs as $item)
                            <a class="list-card" href="{{ route('public.vagas.index') }}">
                                <strong>{{ $item->title }}</strong>
                                <small>{{ $item->location }}</small>
                            </a>
                        @empty
                            <div class="text-muted">Nenhuma vaga publicada.</div>
                        @endforelse
                    </article>
                </div>

                <div class="col-lg-6">
                    <article class="feature-block">
                        <div class="feature-head">
                            <h3>Agenda Cultural</h3>
                            <a href="{{ route('public.agenda.index') }}">Ver agenda completa</a>
                        </div>
                        @forelse ($highlightEvents as $item)
                            <a class="list-card" href="{{ route('public.agenda.index') }}">
                                <span class="badge badge-yellow">{{ ucfirst($item->event_type ?: 'Evento') }}</span>
                                <strong>{{ $item->title }}</strong>
                                <small>{{ $item->event_date->format('d/m') }} &bull; {{ $item->location }}</small>
                            </a>
                        @empty
                            <div class="text-muted">Nenhum evento publicado.</div>
                        @endforelse
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
