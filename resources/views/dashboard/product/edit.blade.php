

  @extends('layouts.app')

@section('title','dashboard')

@push('css')

@endpush

@section('content')

<div class="container">
    <form action="{{ route('product.update', $product->id) }}" method="POST">
        @method('PUT')
        @csrf
        <div class="form-row">
            <div class="form-group col-md-6">
              <label for="nome">Nome</label>
              <input type="text" name="name" class="form-control" value="{{ $product->name }}" >
            </div>
            <div class="form-group col-md-6">
              <label for="descricao">Descrição</label>
              <input type="text" name="description" class="form-control" value="{{ $product->description }}">
            </div>
          </div>
          <div class="form-row">
              <div class="form-group col-md-2">
                <label for="valor">Valor</label>
                <input type="text" name="value" class="form-control" value="{{ $product->value }}" >
              </div>
              <div class="form-group col-md-2">
                <label for="estoque">Estoque</label>
                <input type="number" name="amount" class="form-control" value="{{ $product->amount }}">
              </div>
            </div>
          <button type="submit" class="btn btn-primary">Cadastar</button>
      </form>
</div>

@endsection

@push('js')


@endpush
