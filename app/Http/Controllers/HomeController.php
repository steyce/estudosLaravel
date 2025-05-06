<?php

namespace App\Http\Controllers;

use App\Models\Lancamento;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Support\Renderable;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(): Renderable
    {
        // Calcula o saldo atual (soma de receitas subtraindo a soma de gastos)
        $totalReceitas = Lancamento::whereHas('categoria', function ($query) {
            $query->where('tipo', 'receita');
        })->sum('valor');

        $totalGastos = Lancamento::whereHas('categoria', function ($query) {
            $query->whereIn('tipo', ['gasto_fixo', 'gasto_variavel']);
        })->sum('valor');

        $saldoAtual = $totalReceitas - $totalGastos;

        // Calcula o total de receitas do mês atual
        $receitasMesAtual = \App\Models\Receita::whereYear('data', now()->year)
            ->whereMonth('data', now()->month)
            ->sum('valor');

        // Calcula o total de gastos do mês atual
        $gastosMesAtual = Lancamento::whereYear('data', now()->year)
            ->whereMonth('data', now()->month)
            ->whereHas('categoria', function ($query) {
                $query->whereIn('tipo', ['gasto_fixo', 'gasto_variavel']);
            })->sum('valor');

        // Busca os últimos 5 lançamentos (combinando gastos e receitas)
        $ultimosGastos = Lancamento::orderBy('data', 'desc')->take(5)->get();
        $ultimasReceitas = \App\Models\Receita::orderBy('data', 'desc')->take(5)->get();

        $ultimosLancamentos = $ultimosGastos->concat($ultimasReceitas)->sortByDesc('data')->take(5);

        // Retorna a view 'dashboard' passando as variáveis necessárias
        return view('dashboard', compact('saldoAtual', 'receitasMesAtual', 'gastosMesAtual', 'ultimosLancamentos'));
    }
}