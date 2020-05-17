@extends('layouts.app')

@section('title','dashboard')

@push('css')



@endpush

@section('content')

<div class="container">
    <h3>Lista de Clientes</h3>
    <table class="table table-hover table-bordered">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Nome</th>
            <th scope="col">Junção</th>
            <th scope="col">CNPJ/CPF</th>
            <th scope="col">Funções</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($clients as $key=>$client)

            <tr>

                <td>{{ $key + 1 }}</td>
                <td>{{ Str::limit($client->name,40) }}</td>
                <td>{{ Str::limit($client->slug,10) }}</td>
                <td>{{ $client->docs }}</td>
                <td>
                    <a href="{{route('client.edit', $client->id)}}" class="btn btn-primary">Alterar</a>

                    <button class="btn btn-danger" type="button" onclick="deleteAll({{ $client->id }})">
                        Excluir
                    </button>
                    <form id="delete-form-{{ $client->id }}" action="{{ route('client.destroy',$client->id) }}" method="POST" style="display: none;">
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
