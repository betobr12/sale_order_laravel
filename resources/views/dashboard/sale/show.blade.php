@extends('layouts.app')

@section('title','dashboard')

@push('css')

@endpush
@section('content')
<div class="container">
    <div class="jumbotron  bg-info text-white">
    <p class="lead"><b>Codigo da Venda - {{ $sale->id}}</b></p>
    <h1 class="display-4">{{ $sale->client->name}}</h1>
    <p class="lead">Valor total da Venda = R$ {{number_format($result, 2, ',', '.')}} </p>
      <hr class="my-4">
        <input type="hidden" name="total" class="form-control" value="{{ $result }}">
</div>
<div class="container">
    <table class="table table-hover table-bordered ">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">ID</th>
            <th scope="col">Item</th>
            <th scope="col">Valor</th>
            <th scope="col">Quantidade</th>
            <th scope="col">Data Criacao</th>
          </tr>
        </thead>
        <tbody>
            <div class="p-3 mb-2 bg-info text-white">
            <span><b>Valor total do orçamento: R$ {{number_format($result, 2, ',', '.')}}</b></span>
            </div>
            @foreach ($items as $key=>$item)
              <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $item->id }}</td>
                <td>{{ $item->product->name }}</td>
                <td>{{ number_format($item->sale_value, 2, ',', '.')  }}</td>
                <td>{{ $item->sale_amount }}</td>
                <td>{{ $sale->created_at }}</td>
              </tr>
            @endforeach
        </tbody>
      </table>
  </div>
</div>
@endsection

@push('js')


@endpush
