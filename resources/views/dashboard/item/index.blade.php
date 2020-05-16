@extends('layouts.app')

@section('title','Items')

@push('css')

@endpush

@section('content')

<div class="container">
    <h3>Lista de Produtos vendidos</h3>
    <table class="table table-hover table-bordered">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Cliente</th>
            <th scope="col">Cod da Venda</th>
            <th scope="col">Produto</th>
            <th scope="col">Valor</th>
            <th scope="col">Quantidade</th>
            <th scope="col">Status</th>
            <th scope="col">Data Criacao</th>
            <th scope="col">Funções</th>

          </tr>
        </thead>
        <tbody>
            @foreach ($items as $key=>$item)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $item->sale->client->name }}</td>
                <td>{{ $item->sale->id }}</td>
                <td>{{ $item->product->name }}</td>
                <td>{{ $item->sale_value }}</td>
                <td>{{ $item->sale_amount }}</td>
                <td>{{ $item->sale->is_approved}}</td>
                <td>{{ $item->created_at }}</td>
                <td>
                    <a href="{{route('item.edit', $item->id)}}" class="btn btn-primary">Alterar</a>

                    <form style="display: inline-block;" method="POST" action="{{route('item.destroy', $item->id)}}" data-toggle="tooltip" data-placement="top" title="Excluir" onsubmit="return confirm('Confirma exclusão?')">
                        {{method_field('DELETE')}}{{ csrf_field() }}
                             <button class="btn btn-danger" type="submit">
                                 Excluir
                             </button>
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
