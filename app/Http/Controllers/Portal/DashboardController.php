<?php

namespace App\Http\Controllers\Portal;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function __invoke(Request $request): View
    {
        $user = $request->user();

        return view('portal.dashboard', [
            'totals' => [
                'agenda' => $user->culturalEvents()->count(),
                'guia' => $user->localListings()->count(),
                'vagas' => $user->jobVacancies()->count(),
                'classificados' => $user->classifiedItems()->count(),
            ],
        ]);
    }
}
