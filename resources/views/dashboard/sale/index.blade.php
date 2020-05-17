@extends('layouts.app')

@section('title','Produtos')

@push('css')



@endpush

@section('content')

<div class="container">
    <h3>Lista de todas as Vendas</h3>
    <table class="table table-hover table-bordered">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">ID</th>
            <th scope="col">Cliente</th>
            <th scope="col">Total</th>
            <th scope="col">Status</th>
            <th scope="col">Data Criacao</th>
            <th scope="col">Funções</th>

          </tr>
        </thead>
        <tbody>
            @foreach ($sales as $key=>$sale)
            <tr>
                <td><b>{{ $key + 1 }}</b></td>
                <td>{{ $sale->id }}</td>
                <td>{{ Str::limit($sale->client->name,20) }}</td>
                <td>{{ number_format($sale->total, 2, ',', '.') }}</td>
                <td
                    @if ($sale->is_approved == 1)
                    <span class="bg-info text-white"><b>Venda concluida</b></span>
                @else
                    <span class="bg-success text-white"><b >Aguardando finalização</b></span>
                @endif
                </td>
                <td>{{ $sale->created_at }}</td>

                <td>
                    <a href="{{route('sale.show', $sale->id)}}" class="btn btn-primary">Mostrar</a>
                    <a href="{{route('sale.edit', $sale->id)}}" class="btn btn-primary">Alterar</a>
                    <button class="btn btn-danger" type="button" onclick="deleteAll({{ $sale->id }})">
                        Excluir
                    </button>
                    <form id="delete-form-{{ $sale->id }}" action="{{ route('sale.destroy',$sale->id) }}" method="POST" style="display: none;">
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
