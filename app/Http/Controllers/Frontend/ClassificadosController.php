<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\ClassifiedItem;
use Illuminate\View\View;

class ClassificadosController extends Controller
{
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
