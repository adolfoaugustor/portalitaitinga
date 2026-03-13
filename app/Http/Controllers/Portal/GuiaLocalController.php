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
        $items = $request->user()->localListings()->latest()->get();

        return view('portal.guia', ['items' => $items]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'category' => ['required', 'in:empresas,lojas,servicos,autonomo'],
            'logo' => ['nullable', 'image', 'max:2048'],
            'phone_whatsapp' => ['nullable', 'string', 'max:30'],
            'address_neighborhood' => ['nullable', 'string', 'max:255'],
            'opening_hours' => ['nullable', 'string', 'max:255'],
            'contact_link' => ['nullable', 'url', 'max:255'],
            'city' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'is_published' => ['nullable', 'boolean'],
        ]);

        $logoPath = $request->file('logo')
            ? $request->file('logo')->store('guia-logos', 'public')
            : null;

        LocalListing::create([
            'user_id' => $request->user()->id,
            'name' => $data['name'],
            'slug' => Str::slug($data['name'].'-'.Str::random(5)),
            'category' => $data['category'],
            'logo_path' => $logoPath,
            'phone_whatsapp' => $data['phone_whatsapp'] ?? null,
            'address_neighborhood' => $data['address_neighborhood'] ?? null,
            'opening_hours' => $data['opening_hours'] ?? null,
            'contact_link' => $data['contact_link'] ?? null,
            'city' => $data['city'] ?? null,
            'description' => $data['description'] ?? null,
            'is_published' => (bool) ($data['is_published'] ?? true),
        ]);

        return redirect()->route('portal.guia.index')->with('status', 'Guia local item created.');
    }
}
