<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\CulturalEvent;
use Carbon\Carbon;
use Illuminate\View\View;

class AgendaCulturalController extends Controller
{
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
