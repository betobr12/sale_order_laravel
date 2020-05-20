

@extends('layouts.app')

@section('title','dashboard')

@push('css')

@endpush
@section('content')
<div class="container">
    <div class="jumbotron  bg-info text-white">
    <p class="lead"><b>Codigo da Venda - {{ $sale->id}}</b></p>
    <h1 class="display-4">{{ $sale->client->name}}</h1>
    <p class="lead">Valor total da Venda = R$ {{number_format($total_price , 2, ',', '.')}} </p>
      <hr class="my-4">
      <form action="{{ route('sale.update', $sale->id) }}" method="POST">
        @method('PUT')
        @csrf
        <input type="hidden" name="total" class="form-control" value="{{ $total_price  }}">
        <div class="form-row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="id">Editar Cliente</label>
                        <select name="client_id" id="" class="form-control">
                            @foreach ($clientList as $client)
                                <option value="{{$client->id}}" @if($clientTarget->id==$client->id) selected @endif>{{$client->name}}</option>
                            @endforeach
                        </select>

        </div>
    </div>
    <div class="form-group col-md-4">
        <label for="is_approved"><b>Status</b></label>
        <select name="is_approved" id="is_approved" class="form-control">
          <option value="0">Pendente</option>
          <option value="1">Aprovado</option>
        </select>
    </div>
    <p class="lead">Mudando o status para "Aprovado", nada mais poderá ser alterado, inclua os itens abaixo antes de finaliza-la </p>
        </div>
        <button type="submit" class="btn btn-primary">Finalizar</button>
      </form>
    </div>
</div>
<div class="container">
    @if (isset($errors) && count($errors) > 0)
<div class="alert alert-danger">
    @foreach ($errors->all() as $error)
        <p>{{ $error }}</p>
    @endforeach
</div>
@endif
<div class="card bg-info text-white" style="width: 50rem;">
    <div class="card-body">
      <h5 class="card-title mb-3">Adicionar Produtos</h5>
      <h6 class="card-subtitle mb-3 text-muted">Adicione o produto inserindo as informações nos campos abaixo</h6>
      <form action="{{ route('item.store') }}" method="POST">
        @csrf
        <div class="form-row">
              <input type="hidden" name="sale_id" class="form-control" value="{{ $sale->id}}">
          <div class="form-group col-md-6">
            <label for="product_id">ID do Produto</label>
            <select name="product_id" id="" class="form-control">
                @foreach ($productList as $product)
                    <option value="{{$product->id}}">{{$product->name}} / em estoque: {{$product->amount}}</option>
                @endforeach
            </select>
          </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-2">
              <label for="sale_value">Valor</label>
              <input type="text" name="sale_value" class="form-control" >
            </div>
            <div class="form-group col-md-2">
              <label for="sale_amount">Qtde venda</label>
              <input type="number" name="sale_amount" class="form-control">
            </div>
          </div>
        <button type="submit" class="btn btn-primary">Incluir</button>
      </form>
    </div>
  </div>

</div>
<br>
<div class="container">

    <table class="table table-hover table-bordered ">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">ID</th>
            <th scope="col">Item</th>
            <th scope="col">Vlr Venda</th>
            <th scope="col">Qtde Venda</th>
            <th scope="col">Data Criacao</th>
            <th scope="col">Total</th>
            <th scope="col">Funções</th>

          </tr>
        </thead>
        <tbody>
            <div class="p-3 mb-2 bg-info text-white">
            <span><b>Valor total do orçamento: R$ {{number_format($total_price , 2, ',', '.')}}</b></span>
            </div>
            @foreach ($items as $key=>$item)

              <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $item->id }}</td>
                <td>{{ $item->product->name }}</td>
                <td>{{ number_format($item->sale_value, 2, ',', '.')  }}</td>
                <td>{{ $item->sale_amount }}</td>
                <td>{{ $sale->created_at }}</td>
                <td>{{  number_format($item->sale_amount * $item->sale_value , 2, ',', '.')}}</td>
                <td>
                    <button class="btn btn-danger" type="button" onclick="deleteAll({{ $item->id }})">
                        Excluir
                    </button>
                    <form id="delete-form-{{ $item->id }}" action="{{ route('item.destroy',$item->id) }}" method="POST" style="display: none;">
                        @csrf
                        @method('DELETE')
                    </form>

                </td>
              </tr>


            @endforeach


        </tbody>
      </table>
  </div>

</div>


@endsection

@push('js')


@endpush
