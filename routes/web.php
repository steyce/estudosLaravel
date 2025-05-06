<?php

use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LancamentoController;
use App\Http\Controllers\ReceitaController;
use App\Http\Controllers\RelatorioController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::get('/', function () {
    return redirect()->route('dashboard');
});


Route::get('/home', [HomeController::class, 'index'])->name('dashboard');

// Rotas para Categorias (CRUD)
Route::resource('categorias', CategoriaController::class);

// Rotas para Lançamentos (CRUD)
Route::resource('lancamentos', LancamentoController::class);

// Rotas para Receitas (CRUD)
Route::resource('receitas', App\Http\Controllers\ReceitaController::class);

// Rota para o Relatório Comparativo Mensal
Route::get('/relatorios/comparativo-mensal', [RelatorioController::class, 'comparativoMensal'])->name('relatorios.comparativoMensal');

Route::get('/lancamentos/{lancamento}/edit', [LancamentoController::class, 'edit'])->name('lancamentos.edit');

Route::get('/receitas/{receita}/edit', [ReceitaController::class, 'edit'])->name('receitas.edit');