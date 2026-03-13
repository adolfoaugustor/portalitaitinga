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
            'main_photo' => ['nullable', 'image', 'max:4096'],
            'category' => ['nullable', 'string', 'max:100'],
            'price' => ['nullable', 'numeric', 'min:0'],
            'neighborhood' => ['nullable', 'string', 'max:255'],
            'advertiser_name' => ['nullable', 'string', 'max:255'],
            'whatsapp_number' => ['nullable', 'string', 'max:30'],
            'description' => ['nullable', 'string'],
            'is_published' => ['nullable', 'boolean'],
        ]);

        $photoPath = $request->file('main_photo')
            ? $request->file('main_photo')->store('classificados', 'public')
            : null;

        ClassifiedItem::create([
            'user_id' => $request->user()->id,
            'title' => $data['title'],
            'slug' => Str::slug($data['title'].'-'.Str::random(5)),
            'kind' => $data['kind'],
            'main_photo_path' => $photoPath,
            'category' => $data['category'] ?? null,
            'price' => $data['price'] ?? null,
            'neighborhood' => $data['neighborhood'] ?? null,
            'advertiser_name' => $data['advertiser_name'] ?? $request->user()->name,
            'whatsapp_number' => $data['whatsapp_number'] ?? null,
            'description' => $data['description'] ?? null,
            'is_published' => (bool) ($data['is_published'] ?? true),
        ]);

        return redirect()->route('portal.classificados.index')->with('status', 'Classificado created.');
    }
}
