@extends('layouts.app')

@section('title','dashboard')

@push('css')

@endpush

@section('content')

<div class="container">
    <form action="{{ route('item.update', $item->id) }}" method="POST">
        @method('PUT')
        @csrf
        <input type="hidden" name="sale_id" class="form-control" value="{{ $item->sale_id }}">
        <div class="form-row">
          <div class="form-group col-md-6">
            <label for="product_id">ID do Produto</label>
            <select name="product_id" id="" class="form-control">
                @foreach ($productList as $product)
                    <option value="{{$product->id}}" @if($productTarget->id==$product->id) selected @endif>{{$product->name}} {{ $product->amount }}</option>
                @endforeach
            </select>
          </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-2">
              <label for="sale_value">Valor</label>
              <input type="text" name="sale_value" class="form-control" value="{{ $item->sale_value }}" >
            </div>
            <div class="form-group col-md-2">
              <label for="sale_amount">Qtde venda</label>
              <input type="text" name="sale_amount" class="form-control" value="{{ $item->sale_amount }}">
            </div>
          </div>
        <button type="submit" class="btn btn-primary">Alterar Item</button>
        <a href="{{ route('item.index') }}" class="btn bg-secondary text-white">Voltar para Lista de Itens</a>
      </form>


</div>





@endsection

@push('js')


@endpush
