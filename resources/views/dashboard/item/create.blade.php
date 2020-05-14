  @extends('layouts.app')

  @section('title','dashboard')

  @push('css')

  @endpush

  @section('content')
<div class="container">
  <div class="jumbotron">
    <h1 class="display-4">Cadastro do item para Venda</h1>
    <p class="lead">Codigo da Venda - {{ $idsale}}</p>
    <p class="lead">Valor total da Venda = </p>
    <hr class="my-4">
    <form action="{{ route('item.store') }}" method="POST">
        @csrf
        <div class="form-row">
              <input type="hidden" name="sale_id" class="form-control" value="{{ $idsale}}">
          <div class="form-group col-md-6">
            <label for="product_id">ID do Produto</label>
            <select name="product_id" id="" class="form-control">
                @foreach ($productList as $product)
                    <option value="{{$product->id}}">{{$product->name}}</option>
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
              <input type="text" name="sale_amount" class="form-control">
            </div>
          </div>
        <button type="submit" class="btn btn-primary">Cadastar</button>
      </form>
  </div>
</div>

<div class="container">
    <table class="table table-hover table-bordered">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">ID</th>
            <th scope="col">Item</th>
            <th scope="col">Vlr Cadastrado</th>
            <th scope="col">Vlr Venda</th>
            <th scope="col">Qtde Venda</th>
            <th scope="col">Qtde Estoq</th>
            <th scope="col">Data Criacao</th>
            <th scope="col">Funções</th>

          </tr>
        </thead>
        <tbody>
            @foreach ($items as $key=>$item)

              <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $item->id }}</td>
                <td>{{ $item->product->name }}</td>
                <td>{{ $item->product->value }}</td>
                <td>{{ $item->sale_value }}</td>
                <td>{{ $item->sale_value }}</td>
                <td>{{ $item->product->amount }}</td>
                <td>{{ $sale->created_at }}</td>
                <td>
                    <a href="{{route('item.edit', $item->id)}}"  class="btn btn-primary">Alterar</a>
                    <input class="btn btn-danger" type="submit" value="Excluir">

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
