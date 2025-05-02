@extends('adminlte::page')

@section('title', 'Novo Lançamento')

@section('content_header')
    <h1>Novo Lançamento</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('lancamentos.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="data">Data do Lançamento:</label>
                    <input type="date" class="form-control" id="data" name="data" required>
                </div>
                <div class="form-group">
                    <label for="descricao">Descrição:</label>
                    <input type="text" class="form-control" id="descricao" name="descricao" required>
                </div>
                <div class="form-group">
                    <label for="valor">Valor:</label>
                    <input type="number" step="0.01" class="form-control" id="valor" name="valor" required>
                </div>
                <div class="form-group">
                    <label for="categoria_id">Categoria:</label>
                    <select class="form-control" id="categoria_id" name="categoria_id" required>
                        <option value="">Selecione a Categoria</option>
                        @foreach ($categorias as $categoria)
                            <option value="{{ $categoria->id }}">{{ $categoria->nome }} ({{ $categoria->tipo }})</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Salvar Lançamento</button>
                <a href="{{ route('lancamentos.index') }}" class="btn btn-secondary">Cancelar</a>
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