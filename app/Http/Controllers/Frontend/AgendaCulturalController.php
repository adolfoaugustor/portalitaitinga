<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\CulturalEvent;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AgendaCulturalController extends Controller
{
    public function index(Request $request): View
    {
        $query = CulturalEvent::query()->where('is_published', true);

        if ($request->filled('data')) {
            $query->whereDate('event_date', $request->string('data')->toString());
        }

        if ($request->filled('bairro')) {
            $query->where('neighborhood', 'like', '%'.$request->string('bairro')->toString().'%');
        }

        if ($request->filled('tipo')) {
            $query->where('event_type', 'like', '%'.$request->string('tipo')->toString().'%');
        }

        if ($request->filled('preco')) {
            $query->where('pricing_type', $request->string('preco')->toString());
        }

        if ($request->filled('publico')) {
            $query->where('audience_type', $request->string('publico')->toString());
        }

        if ($request->filled('organizador')) {
            $query->where('organizer_name', 'like', '%'.$request->string('organizador')->toString().'%');
        }

        $events = $query
            ->orderBy('event_date')
            ->orderBy('title')
            ->get();

        return view('public.agenda-index', [
            'events' => $events,
        ]);
    }

    public function show(string $date, string $slug): View
    {
        if (! preg_match('/^\d{4}-\d{2}-\d{2}$/', $date)) {
            abort(404);
        }

        try {
            $parsedDate = Carbon::createFromFormat('Y-m-d', $date)->toDateString();
        } catch (\Throwable $exception) {
            abort(404);
        }

        $event = CulturalEvent::query()
            ->whereDate('event_date', $parsedDate)
            ->where('slug', $slug)
            ->where('is_published', true)
            ->firstOrFail();

        $sameDayEvents = CulturalEvent::query()
            ->whereDate('event_date', $parsedDate)
            ->where('is_published', true)
            ->whereKeyNot($event->id)
            ->orderBy('title')
            ->get();

        return view('public.agenda-show', [
            'event' => $event,
            'sameDayEvents' => $sameDayEvents,
            'date' => $parsedDate,
        ]);
    }
}
