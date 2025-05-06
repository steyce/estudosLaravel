@extends('adminlte::page')

@section('title', 'Receitas')

@section('content_header')
    <h1>Receitas</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Lista de Receitas</h3>
            <div class="card-tools">
                <a href="{{ route('receitas.create') }}" class="btn btn-success">
                    <i class="fas fa-plus"></i> Nova Receita
                </a>
            </div>
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Descrição</th>
                        <th>Valor</th>
                        <th>Data</th>
                        <th>Categoria</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($receitas as $receita)
                        <tr>
                            <td>{{ $receita->id }}</td>
                            <td>{{ $receita->descricao }}</td>
                            <td>{{ number_format($receita->valor, 2, ',', '.') }}</td>
                            <td>{{ \Carbon\Carbon::parse($receita->data)->format('d/m/Y') }}</td>
                            <td>{{ $receita->categoria->nome }}</td>
                            <td>
                                <a href="{{ route('receitas.edit', $receita->id) }}" class="btn btn-primary btn-sm">
                                    <i class="fas fa-edit"></i> Editar
                                </a>
                                <form action="{{ route('receitas.destroy', $receita->id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Tem certeza que deseja excluir esta receita?')">
                                        <i class="fas fa-trash"></i> Excluir
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="6">Nenhuma receita cadastrada.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            {{ $receitas->links() }}
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop