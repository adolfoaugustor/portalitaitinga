<?php

namespace App\Http\Controllers\Portal;

use App\Http\Controllers\Controller;
use App\Models\JobVacancy;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class VagaController extends Controller
{
    public function index(Request $request): View
    {
        $items = $request->user()->jobVacancies()->latest()->get();

        return view('portal.vagas', ['items' => $items]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'store_name' => ['required', 'string', 'max:255'],
            'location' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'is_published' => ['nullable', 'boolean'],
        ]);

        $baseSlug = Str::slug($data['store_name']);
        $slug = $baseSlug;
        $i = 1;

        while (JobVacancy::query()->where('slug', $slug)->exists()) {
            $slug = $baseSlug.'-'.$i;
            $i++;
        }

        JobVacancy::create([
            'user_id' => $request->user()->id,
            'title' => $data['title'],
            'slug' => $slug,
            'store_name' => $data['store_name'],
            'location' => $data['location'] ?? null,
            'description' => $data['description'] ?? null,
            'is_published' => (bool) ($data['is_published'] ?? true),
        ]);

        return redirect()->route('portal.vagas.index')->with('status', 'Vaga created.');
    }
}
