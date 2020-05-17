@extends('layouts.app')

@section('title','dashboard')

@push('css')



@endpush

@section('content')

<div class="container">
  <div class="card text-center" >
    <div class="card-header " >
      Info
    </div>
    <div class="card-body">
      <h5 class="card-title">Total de Vendas</h5>
      <p class="card-text">{{ $sales }}</p>
      <a href="{{ route('sale.index') }}" class="btn btn-primary">Ir para lista</a>
    </div>
    <div class="card-footer text-muted">
    </div>
  </div>
  <div class="card text-center">
    <div class="card-header">
      Info
    </div>
    <div class="card-body">
      <h5 class="card-title">Itens da Venda</h5>
      <p class="card-text">{{ $items }}</p>
      <a href="{{ route('item.index') }}" class="btn btn-primary">Ir para lista</a>
    </div>
    <div class="card-footer text-muted">
    </div>
  </div>
  <div class="card text-center">
    <div class="card-header">
      Info
    </div>
    <div class="card-body">
      <h5 class="card-title">Produtos</h5>
      <p class="card-text"></p>
      <a href="{{ route('product.index') }}" class="btn btn-primary">Ir para lista</a>
    </div>
    <div class="card-footer text-muted">
    </div>
  </div>
  </div>
  </div>
</div>
@endsection

@push('js')


@endpush
