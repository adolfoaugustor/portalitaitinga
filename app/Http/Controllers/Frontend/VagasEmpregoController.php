<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\JobVacancy;
use Illuminate\View\View;

class VagasEmpregoController extends Controller
{
    public function index(): View
    {
        $items = JobVacancy::query()
            ->where('is_published', true)
            ->orderBy('store_name')
            ->orderBy('title')
            ->get();

        return view('public.vagas-index', [
            'items' => $items,
        ]);
    }

    public function show(string $slug): View
    {
        $vacancy = JobVacancy::query()
            ->where('slug', $slug)
            ->where('is_published', true)
            ->firstOrFail();

        return view('public.vaga-show', [
            'vacancy' => $vacancy,
        ]);
    }
}
