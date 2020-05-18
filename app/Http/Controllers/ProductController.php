<?php

namespace App\Http\Controllers;

use App\Product;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::latest()->get();
        return view('dashboard.product.index',compact('products'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.product.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name' => 'required',
            'description' => 'required',
            'value' => 'required',
            'amount' => 'required'
        ],[
            'name.required' => 'Inserir nome para o produto',
            'description.required' => 'Inserir descrição',
            'value.required' => 'Inserir um valor',
            'amount.required' => 'Inserir quantidade para o estoque'
           ]);
        $product = new Product();
        $product->name = $request->name;
        $product->description = $request->description;
        $product->value = str_replace(",",".",$request->value);
        $product->amount = $request->amount;
        $product->save();
        Toastr::success('Produto criado com Sucesso','Successo');
        return redirect()->route('product.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::find($id);

        return view('dashboard.product.edit',compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $this->validate($request,[
            'name' => 'required',
            'description' => 'required',
            'value' => 'required',
            'amount' => 'required'
        ]);
        $product = Product::find($id);
        $product->name = $request->name;
        $product->description = $request->description;
        $product->value = str_replace(",",".",$request->value);
        $product->amount = $request->amount;
        $product->save();
        Toastr::success('Produto alterado com Sucesso','Successo');
        return redirect()->route('product.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $product = Product::findOrFail($id);

        $item_count = $product->item()->count(['product_id']);

        if( $item_count == 0){
        $product->delete();
        Toastr::success('Produto Excluido com Sucesso','Successo');
        return redirect()->back();
        }else{
            Toastr::error('Produto em uma venda','Alerta');
            return redirect()->back();
        }
    }
}
