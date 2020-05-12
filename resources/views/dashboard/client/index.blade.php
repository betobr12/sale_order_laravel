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
            <th scope="col">Junção</th>
            <th scope="col">CNPJ/CPF</th>
            <th scope="col">Funções</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($clients as $key=>$client)

            <tr>

                <td>{{ $key + 1 }}</td>
                <td>{{ $client->name }}</td>
                <td>{{ $client->slug }}</td>
                <td>{{ $client->docs }}</td>
                <td>
                    <a href="{{route('client.edit',$client->id)}}" class="btn btn-primary">Alterar</a>
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
