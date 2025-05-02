<?php

namespace App\Http\Controllers;

use App\Models\Lancamento;
use Illuminate\Http\Request;

class LancamentoController extends Controller
{
    
    public function index(Request $request)
{
    $query = Lancamento::query();

    $mes = $request->input('mes');
    $ano = $request->input('ano');

    if ($mes) {
        $query->whereMonth('data', $mes);
    }

    if ($ano) {
        $query->whereYear('data', $ano);
    }

    $lancamentos = $query->get();

    $totalReceitas = Lancamento::whereHas('categoria', function ($q) {
        $q->where('tipo', 'receita');
    });

    if ($mes) {
        $totalReceitas->whereMonth('data', $mes);
    }

    if ($ano) {
        $totalReceitas->whereYear('data', $ano);
    }

    $totalReceitas = $totalReceitas->sum('valor');

    $totalGastos = Lancamento::whereHas('categoria', function ($q) {
        $q->whereIn('tipo', ['gasto_fixo', 'gasto_variavel']);
    });

    if ($mes) {
        $totalGastos->whereMonth('data', $mes);
    }

    if ($ano) {
        $totalGastos->whereYear('data', $ano);
    }

    $totalGastos = $totalGastos->sum('valor');

    $saldoFinal = $totalReceitas - $totalGastos;

    return view('lancamentos.index', compact('lancamentos', 'totalReceitas', 'totalGastos', 'saldoFinal'));
}

    public function create()
{
    $categorias = \App\Models\Categoria::all(); // Busca todas as categorias
    return view('lancamentos.create', compact('categorias')); // Passa as categorias para a view
}

    public function store(Request $request)
{
    // Validação dos dados do formulário
    $request->validate([
        'data' => 'required|date',
        'descricao' => 'required|max:255',
        'valor' => 'required|numeric',
        'categoria_id' => 'required|exists:categorias,id',
    ]);

    // Cria uma nova instância do model Lancamento com os dados do formulário
    $lancamento = new Lancamento();
    $lancamento->data = $request->input('data');
    $lancamento->descricao = $request->input('descricao');
    $lancamento->valor = $request->input('valor');
    $lancamento->categoria_id = $request->input('categoria_id');
    $lancamento->save(); // Salva o novo lançamento no banco de dados

    // Redireciona o usuário de volta para a lista de lançamentos com uma mensagem de sucesso
    return redirect()->route('lancamentos.index')->with('success', 'Lançamento criado com sucesso!');
}

   
    public function show(Lancamento $lancamento)
    {
        // Lógica para exibir detalhes de um lançamento específico (se necessário)
    }

    public function edit(Lancamento $lancamento)
    {
        $categorias = \App\Models\Categoria::all();
        return view('lancamentos.edit', compact('lancamento', 'categorias'));
    }

   
    public function update(Request $request, Lancamento $lancamento)
    {
        // Validação dos dados do formulário
        $request->validate([
            'data' => 'required|date',
            'descricao' => 'required|max:255',
            'valor' => 'required|numeric',
            'categoria_id' => 'required|exists:categorias,id',
        ]);
    
        // Atualiza os dados do lançamento com os dados do formulário
        $lancamento->data = $request->input('data');
        $lancamento->descricao = $request->input('descricao');
        $lancamento->valor = $request->input('valor');
        $lancamento->categoria_id = $request->input('categoria_id');
        $lancamento->save(); // Salva as alterações no banco de dados
    
        // Redireciona o usuário de volta para a lista de lançamentos com uma mensagem de sucesso
        return redirect()->route('lancamentos.index')->with('success', 'Lançamento atualizado com sucesso!');
    }

    
    public function destroy(Lancamento $lancamento)
    {
        $lancamento->delete();
        return redirect()->route('lancamentos.index')->with('success', 'Lançamento excluído com sucesso!');
    }
}