

  @extends('layouts.app')

@section('title','dashboard')

@push('css')

@endpush

@section('content')

<div class="container">

    @if (isset($errors) && count($errors) > 0)
    <div class="alert alert-danger">
        @foreach ($errors->all() as $error)
            <p>{{ $error }}</p>
        @endforeach
    </div>
    @endif
    <form action="{{ route('product.store') }}" method="POST">
        @csrf
        <div class="form-row">
          <div class="form-group col-md-6">
            <label for="nome">Nome</label>
            <input type="text" name="name" class="form-control" >
          </div>
          <div class="form-group col-md-6">
            <label for="descricao">Descrição</label>
            <input type="text" name="description" class="form-control">
          </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-2">
              <label for="valor">Valor</label>
              <input type="text" name="value" class="form-control" >
            </div>
            <div class="form-group col-md-2">
              <label for="estoque">Estoque</label>
              <input type="number" name="amount" class="form-control">
            </div>
          </div>
        <button type="submit" class="btn btn-primary">Cadastar</button>
      </form>
</div>

@endsection

@push('js')


@endpush
