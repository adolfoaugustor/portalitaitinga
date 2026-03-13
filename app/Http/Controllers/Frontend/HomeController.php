<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $highlightEvents = [
            [
                'title' => 'Feira Criativa da Serra',
                'when' => 'Sab, 16:00',
                'where' => 'Praca Matriz, Centro',
                'tag' => 'Evento hoje',
                'url' => route('public.agenda.index', ['tipo' => 'feira']),
            ],
            [
                'title' => 'Noite do Humor Itaitinga',
                'when' => 'Sex, 20:00',
                'where' => 'Teatro Municipal',
                'tag' => 'Ingressos abertos',
                'url' => route('public.agenda.index', ['tipo' => 'show']),
            ],
            [
                'title' => 'Domingo no Parque',
                'when' => 'Dom, 08:00',
                'where' => 'Parque do Jabuti',
                'tag' => 'Gratuito',
                'url' => route('public.agenda.index', ['preco' => 'gratuito']),
            ],
        ];

        $highlightBusinesses = [
            [
                'name' => 'Padaria Bom Trigo',
                'category' => 'Alimentacao',
                'neighborhood' => 'Centro',
                'cta' => 'Ver no guia',
                'url' => route('public.guia.category', ['category' => 'empresas']),
            ],
            [
                'name' => 'Studio Bela Vida',
                'category' => 'Beleza',
                'neighborhood' => 'Jabuti',
                'cta' => 'Ver no guia',
                'url' => route('public.guia.category', ['category' => 'servicos']),
            ],
            [
                'name' => 'Mecanica 2 Irmaos',
                'category' => 'Automotivo',
                'neighborhood' => 'Parque Genezare',
                'cta' => 'Ver no guia',
                'url' => route('public.guia.category', ['category' => 'lojas']),
            ],
        ];

        $highlightJobs = [
            [
                'title' => 'Atendente de Loja',
                'meta' => 'CLT | Centro | Faixa R$ 1.600',
                'url' => route('public.vagas.index'),
            ],
            [
                'title' => 'Auxiliar Administrativo',
                'meta' => 'Estagio | Dende | Bolsa R$ 900',
                'url' => route('public.vagas.index'),
            ],
            [
                'title' => 'Eletricista Predial',
                'meta' => 'Freelancer | Gererau | Por diaria',
                'url' => route('public.vagas.index'),
            ],
        ];

        $highlightClassifieds = [
            [
                'title' => 'Moto Pop 110 2022',
                'price' => 'R$ 8.900',
                'place' => 'Centro',
                'tag' => 'Novo anuncio',
                'url' => route('public.classificados.index'),
            ],
            [
                'title' => 'Sofa 3 lugares seminovo',
                'price' => 'R$ 1.100',
                'place' => 'Ancuri',
                'tag' => 'Oportunidade',
                'url' => route('public.classificados.index'),
            ],
            [
                'title' => 'Notebook i5 8GB',
                'price' => 'R$ 2.350',
                'place' => 'Parque Santo Antonio',
                'tag' => 'Retirada local',
                'url' => route('public.classificados.index'),
            ],
        ];

        return view('public.home', [
            'highlightEvents' => $highlightEvents,
            'highlightBusinesses' => $highlightBusinesses,
            'highlightJobs' => $highlightJobs,
            'highlightClassifieds' => $highlightClassifieds,
        ]);
    }
}