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
                <td><b>{{ $key + 1 }}</b></td>
                <td>{{ Str::limit($item->sale->client->name,20) }}</td>
                <td>{{ $item->sale->id }}</td>
                <td>{{ $item->product->name }}</td>
                <td>{{ number_format($item->sale_value, 2, ',', '.') }}</td>
                <td>{{ $item->sale_amount }}</td>
                <td>
                    @if ($item->sale->is_approved == 1)
                   <b >Venda concluida</b>
                @else
                    <b>Aguardando Finalização</b>
                @endif
                </td>
                <td>{{ $item->created_at }}</td>

                <td>
                    <a href="{{route('item.edit', $item->id)}}" class="btn btn-primary">Alterar</a>

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
