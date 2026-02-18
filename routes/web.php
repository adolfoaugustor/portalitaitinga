<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/gerar-link-storage', function () {
    try {
        Artisan::call('storage:link');
        return "Link criado com sucesso!";
    } catch (\Exception $e) {
        return "Erro ao criar link: " . $e->getMessage();
    }
});