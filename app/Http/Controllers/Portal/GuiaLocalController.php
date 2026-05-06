<?php

namespace App\Http\Controllers\Portal;

use App\Http\Controllers\Controller;
use App\Models\LocalListing;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class GuiaLocalController extends Controller
{
    public function index(Request $request): View
    {
        $item = $request->user()->localListing()->first();

        return view('portal.guia', ['item' => $item]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'category' => ['required', 'in:empresas,lojas,servicos,autonomo'],
            'logo' => ['nullable', 'image', 'max:2048'],
            'phone' => ['required', 'string', 'max:30'],
            'phone_whatsapp' => ['nullable', 'string', 'max:30'],
            'address' => ['nullable', 'string', 'max:255'],
            'neighborhood' => ['nullable', 'string', 'max:255'],
            'city' => ['nullable', 'string', 'max:255'],
            'sector' => ['nullable', 'string', 'max:255'],
            'services' => ['nullable', 'string'],
            'responsible' => ['nullable', 'string', 'max:255'],
            'cnpj' => ['nullable', 'string', 'max:30'],
            'show_cnpj' => ['nullable', 'boolean'],
            'contact_link' => ['nullable', 'url', 'max:255'],
            'description' => ['nullable', 'string'],
            'is_published' => ['nullable', 'boolean'],
        ]);

        $item = $request->user()->localListing()->first();
        $logoPath = $item ? $item->logo_path : null;

        if ($request->file('logo')) {
            $logoPath = $request->file('logo')->store('guia-logos', 'public');
        }

        LocalListing::updateOrCreate([
            'user_id' => $request->user()->id,
        ], [
            'name' => $data['name'],
            'slug' => $item?->slug ?? Str::slug($data['name'].'-'.Str::random(5)),
            'category' => $data['category'],
            'logo_path' => $logoPath,
            'phone' => $data['phone'],
            'phone_whatsapp' => $data['phone_whatsapp'] ?? null,
            'address' => $data['address'] ?? null,
            'neighborhood' => $data['neighborhood'] ?? null,
            'city' => $data['city'] ?? null,
            'sector' => $data['sector'] ?? null,
            'services' => $data['services'] ?? null,
            'responsible' => $data['responsible'] ?? null,
            'cnpj' => $data['cnpj'] ?? null,
            'show_cnpj' => (bool) ($data['show_cnpj'] ?? false),
            'contact_link' => $data['contact_link'] ?? null,
            'description' => $data['description'] ?? null,
            'is_published' => (bool) ($data['is_published'] ?? true),
        ]);

        return redirect()->route('portal.guia.index')->with('status', 'Dados do guia local salvos com sucesso.');
    }
}
