@extends('adminlte::page')

@section('title', 'Editar Categoria')

@section('content_header')
    <h1>Editar Categoria</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('categorias.update', $categoria->id) }}" method="POST">
                @csrf
                @method('PUT') {{-- Indica que este formulário é para atualizar um registro --}}
                <div class="form-group">
                    <label for="nome">Nome da Categoria:</label>
                    <input type="text" class="form-control" id="nome" name="nome" value="{{ $categoria->nome }}" required>
                </div>
                <div class="form-group">
                    <label for="tipo">Tipo de Categoria:</label>
                    <select class="form-control" id="tipo" name="tipo" required>
                        <option value="gasto_fixo" {{ $categoria->tipo == 'gasto_fixo' ? 'selected' : '' }}>Gasto Fixo</option>
                        <option value="gasto_variavel" {{ $categoria->tipo == 'gasto_variavel' ? 'selected' : '' }}>Gasto Variável</option>
                        <option value="receita" {{ $categoria->tipo == 'receita' ? 'selected' : '' }}>Receita</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Salvar Alterações</button>
                <a href="{{ route('categorias.index') }}" class="btn btn-secondary">Cancelar</a>
            </form>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop