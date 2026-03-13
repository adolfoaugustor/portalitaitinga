<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\LocalListing;
use Illuminate\View\View;

class GuiaLocalController extends Controller
{
    private const ALLOWED = ['empresas', 'lojas', 'servicos', 'autonomo'];

    public function index(): View
    {
        $items = LocalListing::query()
            ->where('is_published', true)
            ->orderBy('category')
            ->orderBy('name')
            ->get();

        return view('public.guia-index', [
            'category' => null,
            'items' => $items,
        ]);
    }

    public function byCategory(string $category): View
    {
        abort_unless(in_array($category, self::ALLOWED, true), 404);

        $items = LocalListing::query()
            ->where('category', $category)
            ->where('is_published', true)
            ->orderBy('name')
            ->get();

        return view('public.guia-index', [
            'category' => $category,
            'items' => $items,
        ]);
    }
}
