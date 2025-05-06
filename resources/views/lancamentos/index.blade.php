@extends('adminlte::page')

@section('title', 'Lista de Lançamentos')

@section('content_header')
    <h1>Lista de Lançamentos</h1>
@stop

@section('content')
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <div class="card mb-3">
        <div class="card-body">
            <form action="{{ route('lancamentos.index') }}" method="GET" class="form-inline">
                <div class="form-group mr-2">
                    <label for="mes" class="mr-1">Mês:</label>
                    <select class="form-control" id="mes" name="mes">
                        <option value="">Todos</option>
                        @for ($i = 1; $i <= 12; $i++)
                            <option value="{{ $i }}" {{ request('mes') == $i ? 'selected' : '' }}>{{ \Carbon\Carbon::create(null, $i)->format('F') }}</option>
                        @endfor
                    </select>
                </div>
                <div class="form-group mr-2">
                    <label for="ano" class="mr-1">Ano:</label>
                    <select class="form-control" id="ano" name="ano">
                        <option value="">Todos</option>
                        @for ($i = date('Y'); $i >= 2020; $i--)
                            <option value="{{ $i }}" {{ request('ano') == $i ? 'selected' : '' }}>{{ $i }}</option>
                        @endfor
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Filtrar</button>
                <a href="{{ route('lancamentos.index') }}" class="btn btn-secondary ml-2">Limpar Filtros</a>
            </form>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-md-4">
            <div class="info-box bg-success">
                <span class="info-box-icon"><i class="fas fa-arrow-up"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Total de Receitas</span>
                    <span class="info-box-number">{{ number_format($totalReceitas, 2, ',', '.') }}</span>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="info-box bg-danger">
                <span class="info-box-icon"><i class="fas fa-arrow-down"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Total de Gastos</span>
                    <span class="info-box-number">{{ number_format($totalGastos, 2, ',', '.') }}</span>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="info-box bg-info">
                <span class="info-box-icon"><i class="fas fa-money-bill-wave"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Saldo Final</span>
                    <span class="info-box-number">{{ number_format($saldoFinal, 2, ',', '.') }}</span>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Lançamentos Cadastrados</h3>
            <div class="card-tools">
                <a href="{{ route('lancamentos.create') }}" class="btn btn-sm btn-primary">
                    <i class="fas fa-plus"></i> Novo Lançamento
                </a>
            </div>
        </div>
        <div class="card-body"> {{-- Removendo a classe p-0 --}}
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Data</th>
                        <th>Descrição</th>
                        <th>Valor</th>
                        <th>Categoria</th>
                        <th>Tipo</th>
                        <th>Criado Em</th> {{-- Nova coluna --}}
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($lancamentos as $lancamento)
                        <tr>
                            <td>{{ $lancamento->id }}</td>
                            <td>{{ \Carbon\Carbon::parse($lancamento->data)->format('d/m/Y') }}</td>
                            <td>{{ $lancamento->descricao }}</td>
                            <td class="{{ $lancamento->categoria->tipo == 'receita' ? 'text-success' : 'text-danger' }}">
                                {{ number_format($lancamento->valor, 2, ',', '.') }}
                            </td>
                            <td>{{ $lancamento->categoria->nome }}</td>
                            <td>
                                @if ($lancamento instanceof \App\Models\Lancamento)
                                    <span class="badge badge-danger">Gasto</span>
                                @elseif ($lancamento instanceof \App\Models\Receita)
                                    <span class="badge badge-success">Receita</span>
                                @endif
                            </td>
                            <td>{{ $lancamento->created_at->format('d/m/Y H:i') }}</td> {{-- Exibindo data de criação --}}
                            <td>
                                @if ($lancamento instanceof \App\Models\Lancamento)
                                    <a href="{{ route('lancamentos.edit', $lancamento->id) }}" class="btn btn-sm btn-warning mr-1">
                                        <i class="fas fa-edit"></i> Editar
                                    </a>
                                    <button class="btn btn-sm btn-danger" onclick="if(confirm('Tem certeza que deseja excluir este lançamento?')){ document.getElementById('delete-form-{{ $lancamento->id }}').submit(); }">
                                        <i class="fas fa-trash"></i> Excluir
                                    </button>
                                    <form id="delete-form-{{ $lancamento->id }}" action="{{ route('lancamentos.destroy', $lancamento->id) }}" method="POST" style="display: none;">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                 @elseif ($lancamento instanceof \App\Models\Receita)
                                    <a href="{{ route('receitas.edit', $lancamento->id) }}" class="btn btn-sm btn-warning mr-1">
                                        <i class="fas fa-edit"></i> Editar
                                    </a>
                                    <form id="delete-form-receita-{{ $lancamento->id }}" action="{{ route('receitas.destroy', $lancamento->id) }}" method="POST" style="display: none;">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                    <button class="btn btn-sm btn-danger" onclick="if(confirm('Tem certeza que deseja excluir esta receita?')){ document.getElementById('delete-form-receita-{{ $lancamento->id }}').submit(); }">
                                        <i class="fas fa-trash"></i> Excluir
                                    </button>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="8">Nenhum lançamento encontrado para o filtro selecionado.</td></tr> {{-- Atualizando colspan --}}
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop