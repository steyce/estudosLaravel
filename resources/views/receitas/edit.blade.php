@extends('adminlte::page')

@section('title', 'Editar Receita')

@section('content_header')
    <h1>Editar Receita</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('receitas.update', $receita->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="descricao">Descrição</label>
                    <input type="text" class="form-control @error('descricao') is-invalid @enderror" id="descricao" name="descricao" value="{{ old('descricao', $receita->descricao) }}">
                    @error('descricao')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="valor">Valor</label>
                    <input type="text" class="form-control @error('valor') is-invalid @enderror" id="valor" name="valor" value="{{ old('valor', number_format($receita->valor, 2, ',', '.')) }}">
                    @error('valor')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="data">Data</label>
                    <input type="date" class="form-control @error('data') is-invalid @enderror" id="data" name="data" value="{{ old('data', is_object($receita->data) ? $receita->data->format('Y-m-d') : $receita->data) }}">
                    @error('data')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="categoria_id">Categoria</label>
                    <select class="form-control @error('categoria_id') is-invalid @enderror" id="categoria_id" name="categoria_id">
                        @foreach ($categorias as $categoria)
                            <option value="{{ $categoria->id }}" {{ old('categoria_id', $receita->categoria_id) == $categoria->id ? 'selected' : '' }}>{{ $categoria->nome }}</option>
                        @endforeach
                    </select>
                    @error('categoria_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">Salvar Alterações</button>
                <a href="{{ route('receitas.index') }}" class="btn btn-secondary">Cancelar</a>
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