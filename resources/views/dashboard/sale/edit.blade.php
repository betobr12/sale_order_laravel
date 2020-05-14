

@extends('layouts.app')

@section('title','dashboard')

@push('css')

@endpush

@section('content')

<div class="container">
    <form action="{{ route('sale.update', $sale->id) }}" method="POST">
        @method('PUT')
        @csrf
        <div class="form-row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="id">Cliente</label>
                        <select name="client_id" id="" class="form-control">
                            @foreach ($clientList as $client)
                                <option value="{{$client->id}}" @if($clientTarget->id==$client->id) selected @endif>{{$client->name}}</option>
                            @endforeach
                        </select>
            </div>
            <button type="submit" class="btn btn-primary">Alterar</button>
        </div>
      </form>
</div>
<br>
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
