@extends('adminlte::page')

@section('title', 'Nova Categoria')

@section('content_header')
    <h1>Nova Categoria</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('categorias.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="nome">Nome da Categoria:</label>
                    <input type="text" class="form-control" id="nome" name="nome" required>
                </div>
                <div class="form-group">
                    <label for="tipo">Tipo de Categoria:</label>
                    <select class="form-control" id="tipo" name="tipo" required>
                        <option value="gasto_fixo">Gasto Fixo</option>
                        <option value="gasto_variavel">Gasto Variável</option>
                        <option value="receita">Receita</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Salvar Categoria</button>
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