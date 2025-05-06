<?php

namespace App\Http\Controllers;

use App\Models\Lancamento;
use Illuminate\Http\Request;

class LancamentoController extends Controller
{
    
    public function index(Request $request)
{
    $mes = $request->input('mes');
    $ano = $request->input('ano');

    // Busca os gastos, aplicando os filtros de mês e ano
    $queryGastos = Lancamento::query()->with('categoria');
    if ($mes) {
        $queryGastos->whereMonth('data', $mes);
    }
    if ($ano) {
        $queryGastos->whereYear('data', $ano);
    }
    $gastos = $queryGastos->get();

    // Busca as receitas, aplicando os mesmos filtros de mês e ano
    $queryReceitas = \App\Models\Receita::query()->with('categoria');
    if ($mes) {
        $queryReceitas->whereMonth('data', $mes);
    }
    if ($ano) {
        $queryReceitas->whereYear('data', $ano);
    }
    $receitas = $queryReceitas->get();

    // Combina os gastos e receitas
    $lancamentos = $gastos->concat($receitas)->sortByDesc('data');

    // Recalcula os totais de receitas e gastos com base nos resultados combinados
    $totalReceitas = $lancamentos->where('categoria.tipo', 'receita')->sum('valor');
    $totalGastos = $lancamentos->whereIn('categoria.tipo', ['gasto_fixo', 'gasto_variavel'])->sum('valor');
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
    $request->validate([
        'descricao' => 'required|max:255',
        'valor' => 'required|numeric|min:0.01',
        'data' => 'required|date',
        'categoria_id' => 'required|exists:categorias,id',
    ]);

    $categoria = \App\Models\Categoria::findOrFail($request->categoria_id);

    if ($categoria->tipo === 'receita') {
        \App\Models\Receita::create([
            'descricao' => $request->descricao,
            'valor' => $request->valor,
            'data' => $request->data,
            'categoria_id' => $request->categoria_id,
        ]);
    } else {
        Lancamento::create([
            'descricao' => $request->descricao,
            'valor' => $request->valor,
            'data' => $request->data,
            'categoria_id' => $request->categoria_id,
        ]);
    }

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