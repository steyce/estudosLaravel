@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-3">
            <div class="info-box mb-3 bg-success">
                <span class="info-box-icon"><i class="fas fa-money-bill-wave"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Saldo Atual</span>
                    <span class="info-box-number">{{ number_format($saldoAtual ?? 0, 2, ',', '.') }}</span>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="info-box mb-3 bg-info">
                <span class="info-box-icon"><i class="fas fa-arrow-up"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Receitas Mês Atual</span>
                    <span class="info-box-number">{{ number_format($receitasMesAtual ?? 0, 2, ',', '.') }}</span>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="info-box mb-3 bg-danger">
                <span class="info-box-icon"><i class="fas fa-arrow-down"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Gastos Mês Atual</span>
                    <span class="info-box-number">{{ number_format($gastosMesAtual ?? 0, 2, ',', '.') }}</span>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="info-box mb-3 bg-warning">
                <span class="info-box-icon"><i class="fas fa-chart-line"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Saldo Mês Atual</span>
                    <span class="info-box-number">{{ number_format(($receitasMesAtual ?? 0) - ($gastosMesAtual ?? 0), 2, ',', '.') }}</span>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Comparativo Mensal (Últimos 6 Meses)</h3>
                </div>
                <div class="card-body">
                    <p>Gráfico comparativo mensal será implementado aqui.</p>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Últimos Lançamentos</h3>
                </div>
                <div class="card-body p-0">
                    <ul class="list-group list-group-flush">
                        @forelse ($ultimosLancamentos as $lancamento)
                            <li class="list-group-item">
                                <span class="{{ $lancamento->categoria->tipo == 'receita' ? 'text-success' : 'text-danger' }}">
                                    {{ number_format($lancamento->valor, 2, ',', '.') }}
                                </span> -
                                {{ $lancamento->descricao }} ({{ $lancamento->categoria->nome }})
                                <small class="float-right">{{ \Carbon\Carbon::parse($lancamento->data)->format('d/m/Y') }}</small>
                            </li>
                        @empty
                            <li class="list-group-item">Nenhum lançamento recente.</li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

{{-- Seção JS removida --}}