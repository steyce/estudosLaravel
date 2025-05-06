@extends('adminlte::page')

@section('title', 'Nova Receita')

@section('content_header')
    <h1>Nova Receita</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('receitas.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="descricao">Descrição</label>
                    <input type="text" class="form-control @error('descricao') is-invalid @enderror" id="descricao" name="descricao" value="{{ old('descricao') }}">
                    @error('descricao')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="valor">Valor</label>
                    <input type="text" class="form-control @error('valor') is-invalid @enderror" id="valor" name="valor" value="{{ old('valor') }}">
                    @error('valor')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="data">Data</label>
                    <input type="date" class="form-control @error('data') is-invalid @enderror" id="data" name="data" value="{{ old('data') }}">
                    @error('data')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="categoria_id">Categoria</label>
                    <select class="form-control @error('categoria_id') is-invalid @enderror" id="categoria_id" name="categoria_id">
                        <option value="">Selecione a Categoria</option>
                        @foreach ($categorias as $categoria)
                            <option value="{{ $categoria->id }}" {{ old('categoria_id') == $categoria->id ? 'selected' : '' }}>{{ $categoria->nome }}</option>
                        @endforeach
                    </select>
                    @error('categoria_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Salvar Receita</button>
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