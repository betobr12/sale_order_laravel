@extends('layouts.app')

@section('title','Produtos')

@push('css')



@endpush

@section('content')

<div class="container">
    <table class="table table-hover table-bordered">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">ID</th>
            <th scope="col">Cliente</th>
            <th scope="col">Slug</th>
            <th scope="col">Total</th>
            <th scope="col">Status</th>
            <th scope="col">Data Criacao</th>
            <th scope="col">Funções</th>

          </tr>
        </thead>
        <tbody>
            @foreach ($sales as $key=>$sale)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $sale->id }}</td>
                <td>{{ $sale->client->name }}</td>
                <td>{{ $sale->slug }}</td>
                <td>{{ $sale->total }}</td>
                <td>{{ $sale->is_approved }}</td>
                <td>{{ $sale->created_at }}</td>
                <td>
                    <a href="{{route('sale.edit', $sale->id)}}" class="btn btn-primary">Alterar</a>
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
