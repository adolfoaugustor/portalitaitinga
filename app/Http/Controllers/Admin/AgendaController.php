<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CulturalEvent;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class AgendaController extends Controller
{
    public function index(Request $request): View
    {
        $items = CulturalEvent::query()->latest()->get();
        $activeItemCount = $request->user()->culturalEvents()
            ->whereDate('event_date', '>=', Carbon::today()->toDateString())
            ->count();

        return view('admin.agenda', [
            'items' => $items,
            'activeItemCount' => $activeItemCount,
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $activeItemCount = $request->user()->culturalEvents()
            ->whereDate('event_date', '>=', Carbon::today()->toDateString())
            ->count();

        if ($activeItemCount >= 3) {
            return back()->withInput()->with('error', 'O limite de 3 eventos ativos foi atingido. Aguarde a data de término de um evento antes de cadastrar outro.');
        }

        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'event_date' => ['required', 'date'],
            'neighborhood' => ['nullable', 'string', 'max:255'],
            'event_type' => ['nullable', 'string', 'max:100'],
            'pricing_type' => ['required', 'in:gratuito,pago'],
            'audience_type' => ['nullable', 'in:infantil,familia,geral'],
            'organizer_name' => ['nullable', 'string', 'max:255'],
            'location' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'is_published' => ['nullable', 'boolean'],
        ]);

        $baseSlug = Str::slug($data['title']);
        $slug = $baseSlug;
        $i = 1;

        while (CulturalEvent::query()->where('event_date', $data['event_date'])->where('slug', $slug)->exists()) {
            $slug = $baseSlug.'-'.$i;
            $i++;
        }

        CulturalEvent::create([
            'user_id' => $request->user()->id,
            'title' => $data['title'],
            'slug' => $slug,
            'event_date' => $data['event_date'],
            'neighborhood' => $data['neighborhood'] ?? null,
            'event_type' => $data['event_type'] ?? null,
            'pricing_type' => $data['pricing_type'],
            'audience_type' => $data['audience_type'] ?? null,
            'organizer_name' => $data['organizer_name'] ?? $request->user()->name,
            'location' => $data['location'] ?? null,
            'description' => $data['description'] ?? null,
            'is_published' => (bool) ($data['is_published'] ?? true),
        ]);

        return redirect()->route('admin.agenda.index')->with('status', 'Evento cadastrado com sucesso.');
    }
}
