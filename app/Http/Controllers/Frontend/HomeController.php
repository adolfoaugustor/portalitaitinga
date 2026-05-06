<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\ClassifiedItem;
use App\Models\CulturalEvent;
use App\Models\JobVacancy;
use App\Models\LocalListing;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $highlightEvents = CulturalEvent::query()
            ->where('is_published', true)
            ->orderByDesc('event_date')
            ->limit(4)
            ->get();

        $highlightBusinesses = LocalListing::query()
            ->where('is_published', true)
            ->orderBy('category')
            ->orderBy('name')
            ->limit(4)
            ->get();

        $highlightJobs = JobVacancy::query()
            ->where('is_published', true)
            ->latest()
            ->limit(4)
            ->get();

        $highlightClassifieds = ClassifiedItem::query()
            ->where('is_published', true)
            ->latest()
            ->limit(4)
            ->get();

        return view('public.home', [
            'highlightEvents' => $highlightEvents,
            'highlightBusinesses' => $highlightBusinesses,
            'highlightJobs' => $highlightJobs,
            'highlightClassifieds' => $highlightClassifieds,
        ]);
    }
}
