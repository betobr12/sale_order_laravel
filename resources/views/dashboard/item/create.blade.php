  @extends('layouts.app')

  @section('title','dashboard')

  @push('css')

  @endpush

  @section('content')

  <div class="container">
      <form action="{{ route('item.store') }}" method="POST">
          @csrf
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="product_id">ID do Produto</label>
              <input type="text" name="product_id" class="form-control" >
            </div>
            <div class="form-group col-md-6">
              <label for="sale_id">Id do Orcamento</label>
              <input type="text" name="sale_id" class="form-control" value="">
            </div>
          </div>
          <div class="form-row">
              <div class="form-group col-md-6">
                <label for="sale_value">Valor</label>
                <input type="text" name="sale_value" class="form-control" >
              </div>
              <div class="form-group col-md-6">
                <label for="sale_amount">Qtde venda</label>
                <input type="text" name="sale_amount" class="form-control">
              </div>
            </div>
          <button type="submit" class="btn btn-primary">Cadastar</button>
        </form>
  </div>

  @endsection

  @push('js')


  @endpush
