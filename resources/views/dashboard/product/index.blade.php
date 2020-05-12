@extends('layouts.app')

@section('title','dashboard')

@push('css')



@endpush

@section('content')

<div class="container">
    <table class="table table-hover table-bordered">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Nome</th>
            <th scope="col">Descricao</th>
            <th scope="col">Valor</th>
            <th scope="col">Estoque</th>
            <th scope="col">Data de Criação</th>
            <th scope="col">Funções</th>

          </tr>
        </thead>
        <tbody>
            @foreach ($products as $key=>$product)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $product->name }}</td>
                <td>{{ $product->description }}</td>
                <td>{{ $product->value }}</td>
                <td>{{ $product->amount }}</td>
                <td>{{ $product->created_at }}</td>
                <td>
                    <a href="{{route('product.edit',$product->id)}}" class="btn btn-primary">Alterar</a>
                    <input class="btn btn-danger" type="submit" value="Excluir">
                </td>
              </tr>

            @endforeach


        </tbody>
      </table>
  </div>

@endsection

@push('js')


@endpush
