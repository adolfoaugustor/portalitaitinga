<?php

namespace App\Http\Controllers\Portal;

use App\Http\Controllers\Controller;
use App\Models\ClassifiedItem;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class ClassificadoController extends Controller
{
    public function index(Request $request): View
    {
        $items = $request->user()->classifiedItems()->latest()->get();

        return view('portal.classificados', ['items' => $items]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'kind' => ['required', 'in:item,produto,servico'],
            'price' => ['nullable', 'numeric', 'min:0'],
            'description' => ['nullable', 'string'],
            'is_published' => ['nullable', 'boolean'],
        ]);

        ClassifiedItem::create([
            'user_id' => $request->user()->id,
            'title' => $data['title'],
            'slug' => Str::slug($data['title'].'-'.Str::random(5)),
            'kind' => $data['kind'],
            'price' => $data['price'] ?? null,
            'description' => $data['description'] ?? null,
            'is_published' => (bool) ($data['is_published'] ?? true),
        ]);

        return redirect()->route('portal.classificados.index')->with('status', 'Classificado created.');
    }
}
