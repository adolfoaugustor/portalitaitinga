<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function __invoke(): View
    {
        return view('admin.dashboard', [
            'stats' => [
                ['label' => 'Usuarios ativos', 'value' => '1', 'context' => 'Conta autenticada pronta para uso', 'color' => 'primary'],
                ['label' => 'Modulos do admin', 'value' => '3', 'context' => 'Dashboard, perfil e sessao', 'color' => 'info'],
                ['label' => 'Status do painel', 'value' => 'OK', 'context' => 'CoreUI integrado ao layout', 'color' => 'success'],
            ],
        ]);
    }
}
