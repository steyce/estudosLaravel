<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categorias = Categoria::all();
        return view('categorias.index', compact('categorias'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('categorias.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validação dos dados do formulário
        $request->validate([
            'nome' => 'required|unique:categorias|max:255',
            'tipo' => 'required|in:gasto_fixo,gasto_variavel,receita',
        ]);
    
        // Cria uma nova instância do model Categoria com os dados do formulário
        $categoria = new Categoria();
        $categoria->nome = $request->input('nome');
        $categoria->tipo = $request->input('tipo');
        $categoria->save(); // Salva a nova categoria no banco de dados
    
        // Redireciona o usuário de volta para a lista de categorias com uma mensagem de sucesso
        return redirect()->route('categorias.index')->with('success', 'Categoria criada com sucesso!');
    }
    public function show(Categoria $categoria)
    {
        // Lógica para exibir detalhes de uma categoria específica (se necessário)
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Categoria $categoria)
    {
        return view('categorias.edit', compact('categoria'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Categoria $categoria)
    {
        // Validação dos dados do formulário
        $request->validate([
            'nome' => 'required|unique:categorias,nome,' . $categoria->id . '|max:255',
            'tipo' => 'required|in:gasto_fixo,gasto_variavel,receita',
        ]);
    
        // Atualiza os dados da categoria com os dados do formulário
        $categoria->nome = $request->input('nome');
        $categoria->tipo = $request->input('tipo');
        $categoria->save(); // Salva as alterações no banco de dados
    
        // Redireciona o usuário de volta para a lista de categorias com uma mensagem de sucesso
        return redirect()->route('categorias.index')->with('success', 'Categoria atualizada com sucesso!');
    }
    public function destroy(Categoria $categoria)
{
    $categoria->delete(); // Exclui a categoria do banco de dados

    // Redireciona o usuário de volta para a lista de categorias com uma mensagem de sucesso
    return redirect()->route('categorias.index')->with('success', 'Categoria excluída com sucesso!');
}
}