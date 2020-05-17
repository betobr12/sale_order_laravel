

  @extends('layouts.app')

@section('title','dashboard')

@push('css')

@endpush

@section('content')
<div class="container">
<div class="jumbotron">
    <h1 class="display-4">Venda</h1>
    <p class="lead">Selecione um cliente para criar a venda, em seguida, selecione-o na lista abaixo para concluir a venda</p>
    <hr class="my-4">
    <form action="{{ route('sale.store') }}" method="POST">
        @csrf
        <div class="form-row">
          <div class="form-group col-md-6">
            <label for="nome">Cliente</label>
                <select name="client_id" id="" class="form-control">
                    @foreach ($clientList as $client)
                        <option value="{{$client->id}}">{{$client->name}}</option>
                    @endforeach
                </select>
          </div>
        </div>
        <button type="submit" class="btn btn-primary">Inserir</button>
      </form>
  </div>
</div>

<h3>Lista de Vendas Sem Confirmação</h3>
    <table class="table table-hover table-bordered">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">ID</th>
            <th scope="col">Cliente</th>
            <th scope="col">Data Criacao</th>
            <th scope="col">Funções</th>

          </tr>
        </thead>
        <tbody>

            @foreach ($sales as $key=>$sale)
            @if ($sale->is_approved == 0)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $sale->id }}</td>
                <td>{{ $sale->client->name }}</td>
                <td>{{ $sale->created_at }}</td>
                <td>
                    <a href="{{route('sale.edit', $sale->id)}}" class="btn btn-primary">Incluir Produto</a>
                </td>
              </tr>
              @endif
            @endforeach



        </tbody>
      </table>
  </div>

</div>

@endsection

@push('js')


@endpush
