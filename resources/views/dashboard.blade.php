@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Seja Bem-Vindx a minha central</h1>
@stop

@section('content')
    <p>Welcome to this beautiful admin panel.</p>
    <div class="row">
    <div class="col-lg-3 col-6">
        <div class="small-box bg-info">
            <div class="inner">
                <h3>R$ 2.000</h3>
                <p>Custos Fixos</p>
            </div>
            <div class="icon">
                <i class="fas fa-file-invoice-dollar"></i>
            </div>
            <a href="#" class="small-box-footer">Mais info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
</div>

@section('content')
<div class="row">
    <!-- Gastos Fixos -->
    <div class="col-lg-3 col-6">
        <div class="small-box bg-danger">
            <div class="inner">
                <h3>R$ 1.200</h3>
                <p>Gastos Fixos</p>
            </div>
            <div class="icon">
                <i class="fas fa-file-invoice"></i>
            </div>
            <a href="#" class="small-box-footer">Ver detalhes <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>

    <!-- Gastos Variáveis -->
    <div class="col-lg-3 col-6">
        <div class="small-box bg-warning">
            <div class="inner">
                <h3>R$ 750</h3>
                <p>Gastos Variáveis</p>
            </div>
            <div class="icon">
                <i class="fas fa-random"></i>
            </div>
            <a href="#" class="small-box-footer">Ver detalhes <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>

    <!-- Receitas -->
    <div class="col-lg-3 col-6">
        <div class="small-box bg-success">
            <div class="inner">
                <h3>R$ 3.000</h3>
                <p>Receitas</p>
            </div>
            <div class="icon">
                <i class="fas fa-hand-holding-usd"></i>
            </div>
            <a href="#" class="small-box-footer">Ver detalhes <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>

    <!-- Saldo Final -->
    <div class="col-lg-3 col-6">
        <div class="small-box bg-primary">
            <div class="inner">
                <h3>R$ 1.050</h3>
                <p>Saldo Final</p>
            </div>
            <div class="icon">
                <i class="fas fa-wallet"></i>
            </div>
            <a href="#" class="small-box-footer">Ver detalhes <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
</div>
@endsection

@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
    <script> console.log("Hi, I'm using the Laravel-AdminLTE package!"); </script>