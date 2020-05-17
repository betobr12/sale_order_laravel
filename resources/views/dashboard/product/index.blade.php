@extends('layouts.app')

@section('title','Produtos')

@push('css')



@endpush

@section('content')

<div class="container">
    <h3>Lista de Produtos</h3>
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
                <td>{{ Str::limit($product->description,12) }}</td>
                <td>{{ number_format($product->value, 2, ',', '.') }}</td>
                <td>{{ $product->amount }}</td>
                <td>{{ $product->created_at }}</td>
                <td>
                    <a href="{{route('product.edit',$product->id)}}" class="btn btn-primary">Alterar</a>
                    <button class="btn btn-danger" type="button" onclick="deleteAll({{ $product->id }})">
                        Excluir
                    </button>
                    <form id="delete-form-{{ $product->id }}" action="{{ route('product.destroy',$product->id) }}" method="POST" style="display: none;">
                        @csrf
                        @method('DELETE')
                    </form>
                </td>
              </tr>

            @endforeach


        </tbody>
      </table>
  </div>

@endsection

@push('js')


@endpush
