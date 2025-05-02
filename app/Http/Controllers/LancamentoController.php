<?php

namespace App\Http\Controllers;

use App\Models\Lancamento;
use Illuminate\Http\Request;

class LancamentoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $lancamentos = Lancamento::all();
        return view('lancamentos.index', compact('lancamentos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Precisaremos buscar as categorias para o formulário de criação
        return view('lancamentos.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Lógica para salvar o novo lançamento (vamos implementar depois)
    }

    /**
     * Display the specified resource.
     */
    public function show(Lancamento $lancamento)
    {
        // Lógica para exibir detalhes de um lançamento específico (se necessário)
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Lancamento $lancamento)
    {
        // Precisaremos buscar as categorias para o formulário de edição
        return view('lancamentos.edit', compact('lancamento'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Lancamento $lancamento)
    {
        // Lógica para atualizar o lançamento (vamos implementar depois)
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Lancamento $lancamento)
    {
        $lancamento->delete();
        return redirect()->route('lancamentos.index')->with('success', 'Lançamento excluído com sucesso!');
    }
}