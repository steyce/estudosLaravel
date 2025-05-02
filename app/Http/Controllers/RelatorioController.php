<?php

namespace App\Http\Controllers;

use App\Models\Lancamento;
use Illuminate\Http\Request;

class RelatorioController extends Controller
{
    public function comparativoMensal(Request $request)
    {
        $periodo = $request->input('periodo', 6); // Pega o período da requisição, padrão para 6 meses
        $meses = [];
        $dadosComparativos = [];
    
        for ($i = $periodo - 1; $i >= 0; $i--) {
            $data = \Carbon\Carbon::now()->subMonths($i);
            $mes = $data->format('m');
            $ano = $data->format('Y');
            $meses[$ano . '-' . $mes] = $data->format('M/Y');
    
            $totalReceitas = Lancamento::whereYear('data', $ano)
                ->whereMonth('data', $mes)
                ->whereHas('categoria', function ($query) {
                    $query->where('tipo', 'receita');
                })->sum('valor');
    
            $totalGastos = Lancamento::whereYear('data', $ano)
                ->whereMonth('data', $mes)
                ->whereHas('categoria', function ($query) {
                    $query->whereIn('tipo', ['gasto_fixo', 'gasto_variavel']);
                })->sum('valor');
    
            $saldoFinal = $totalReceitas - $totalGastos;
    
            $dadosComparativos[$ano . '-' . $mes] = [
                'receitas' => $totalReceitas,
                'gastos' => $totalGastos,
                'saldo' => $saldoFinal,
            ];
        }
    
        return view('relatorios.comparativo_mensal', compact('meses', 'dadosComparativos'));
    }
}