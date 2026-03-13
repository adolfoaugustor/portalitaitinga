<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\ClassifiedItem;
use Illuminate\View\View;

class ClassificadosController extends Controller
{
    public function index(): View
    {
        $items = ClassifiedItem::query()
            ->where('is_published', true)
            ->orderBy('kind')
            ->orderBy('title')
            ->get();

        return view('public.classificados-index', [
            'items' => $items,
        ]);
    }

    public function show(string $slug): View
    {
        $item = ClassifiedItem::query()
            ->where('slug', $slug)
            ->where('is_published', true)
            ->firstOrFail();

        return view('public.classificado-show', [
            'item' => $item,
        ]);
    }
}
