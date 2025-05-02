@extends('adminlte::page')

@section('title', 'Relatório Comparativo Mensal')

@section('content_header')
    <h1>Relatório Comparativo Mensal</h1>
@stop

@section('content')
    <div class="card mb-3">
        <div class="card-body">
            <form action="{{ route('relatorios.comparativoMensal') }}" method="GET" class="form-inline">
                <div class="form-group mr-2">
                    <label for="periodo" class="mr-1">Período (meses):</label>
                    <select class="form-control" id="periodo" name="periodo">
                        <option value="3" {{ request('periodo') == 3 ? 'selected' : '' }}>Últimos 3 meses</option>
                        <option value="6" {{ request('periodo') == 6 ? 'selected' : '' }}>Últimos 6 meses</option>
                        <option value="12" {{ request('periodo') == 12 ? 'selected' : '' }}>Último ano</option>
                        <option value="24" {{ request('periodo') == 24 ? 'selected' : '' }}>Últimos 2 anos</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Gerar Relatório</button>
            </form>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Mês/Ano</th>
                        <th>Total de Receitas</th>
                        <th>Total de Gastos</th>
                        <th>Saldo Final</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($meses as $key => $mesAno)
                        <tr>
                            <td>{{ $mesAno }}</td>
                            <td class="text-success">{{ number_format($dadosComparativos[$key]['receitas'], 2, ',', '.') }}</td>
                            <td class="text-danger">{{ number_format($dadosComparativos[$key]['gastos'], 2, ',', '.') }}</td>
                            <td class="{{ $dadosComparativos[$key]['saldo'] >= 0 ? 'text-success' : 'text-danger' }}">
                                {{ number_format($dadosComparativos[$key]['saldo'], 2, ',', '.') }}
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="4">Nenhum dado encontrado para o comparativo.</td></tr>
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