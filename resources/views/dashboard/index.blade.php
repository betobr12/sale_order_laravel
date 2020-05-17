@extends('layouts.app')

@section('title','dashboard')

@push('css')



@endpush

@section('content')
<div class="container">
  <div class="card text-center" >
    <div class="card-header bg-info text-white" >
     <b>Vendas Cadastradas</b>
    </div>
    <div class="card-body">
      <h5 class="card-title">Total de Vendas</h5>
      <p class="card-text"> <h4> <b>{{ $sales }}</b></h4></p>
      <a href="{{ route('sale.index') }}" class="btn btn-primary">Ir para lista</a>
    </div>
    <div class="card-footer text-muted bg-info text-white">
    </div>
  </div>
  <div class="card text-center ">
    <div class="card-header bg-success text-white">
      <b> Itens Cadastrados nas Vendas</b>
    </div>
    <div class="card-body">
      <h5 class="card-title">Itens da Venda</h5>
      <p class="card-text"><h4><b>{{ $items }}</b></h4></p>
      <a href="{{ route('item.index') }}" class="btn btn-success ">Ir para lista</a>
    </div>
    <div class="card-footer text-muted bg-success text-white">
    </div>
  </div>
  <div class="card text-center">
    <div class="card-header bg-primary text-white">
     <b>Produtos Cadastrados</b>
    </div>
    <div class="card-body">
      <h5 class="card-title">Produtos</h5>
      <p class="card-text"><h4><b>{{  $products }}</b></h4></p>
      <a href="{{ route('product.index') }}" class="btn btn-primary">Ir para lista</a>
    </div>
    <div class="card-footer text-muted bg-primary text-white">
    </div>
  </div>
  </div>
  </div>
</div>
@endsection

@push('js')


@endpush
