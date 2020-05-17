

  @extends('layouts.app')

@section('title','dashboard')

@push('css')

@endpush

@section('content')

<div class="container">
    <form name="client" action="{{ route('client.store') }}" method="POST">
        @csrf
        <div class="form-row">
          <div class="form-group col-md-6">
            <label for="empresa">Empresa</label>
            <input type="text" name="name" class="form-control" >
          </div>
          <div class="form-group col-md-6">
            <label for="docs">CNPJ/CPF</label>
            <input type="text"  name="docs" class="form-control" >
          </div>
        </div>
        <button type="submit" class="btn btn-primary" onclick="return validate()">Cadastar</button>
      </form>
</div>

@endsection

@push('js')


@endpush
