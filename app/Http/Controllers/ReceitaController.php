<?php

namespace App\Http\Controllers;

use App\Models\Receita;
use App\Models\Categoria;
use Illuminate\Http\Request;

class ReceitaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $receitas = Receita::with('categoria')->paginate(10); // Busca as receitas com paginação (10 por página) e carrega a categoria relacionada
        return view('receitas.index', compact('receitas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categorias = \App\Models\Categoria::all(); // Busca todas as categorias
        return view('receitas.create', compact('categorias'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    // Validação dos dados do formulário
    $request->validate([
        'descricao' => 'required|max:255',
        'valor' => 'required|numeric|min:0.01',
        'data' => 'required|date',
        'categoria_id' => 'required|exists:categorias,id',
    ]);

    // Cria uma nova receita com os dados do formulário
    Receita::create([
        'descricao' => $request->descricao,
        'valor' => $request->valor,
        'data' => $request->data,
        'categoria_id' => $request->categoria_id,
    ]);

    // Redireciona de volta para a lista de receitas com uma mensagem de sucesso
    return redirect()->route('receitas.index')->with('success', 'Receita criada com sucesso!');
}

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Receita $receita)
{
    $categorias = Categoria::all();
    return view('receitas.edit', compact('receita', 'categorias'));
}

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Receita $receita)
{
    $request->validate([
        'descricao' => 'required|max:255',
        'valor' => 'required|numeric|min:0.01',
        'data' => 'required|date',
        'categoria_id' => 'required|exists:categorias,id',
    ]);

    $receita->update($request->all());

    return redirect()->route('receitas.index')->with('success', 'Receita atualizada com sucesso!');
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
