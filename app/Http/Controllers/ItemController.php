<?php

namespace App\Http\Controllers;

use App\Item;
use App\Product;
use App\Sale;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Database\Console\Migrations\RefreshCommand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Item::all();

        return view('dashboard.item.index',compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()   {

        $productList = Product::select('id','name')->get();

        return view('dashboard.item.create',compact(['productList','idsale']));
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

            'product_id' => 'required',
            'sale_id' => 'required',
            'sale_value' => 'required',
            'sale_amount' => 'required'

           ],[
            'product_id.required' => 'Inserir Produto',
            'sale_value.required' => 'Inserir um valor para o item',
            'sale_amount.required' => 'Inserir quantidade para o item'
           ]);

           //$amout_store =
           $id_product = [0];
           $amout_product = [0];
           $item = new Item();
           $item->sale_id = $request->sale_id;



           if (DB::table('items')->where('sale_id',$request->sale_id)->where('product_id', $request->product_id)->count() == 0) {

           $item->product_id = $request->product_id;

           }else{

            Toastr::error('Item ja foi inserido','Alerta');
            return redirect()->back();

           }

            $resultSale = $item->sale_id;
            $resultProduct = $item->product_id;


             $resultItems = Item::where('sale_id',$resultSale)->select('product_id')->get();
            $resultStore = Product::where('id',$resultProduct)->select('amount')->get();

           foreach ($resultItems as $item){
            $id_product = $item->product_id;
        }
            foreach ($resultStore as $product){
             $amout_product = $product->amount;
         }

          if($request->sale_amount <=0 or $request->sale_amount > $amout_product ){

            Toastr::error('Saldo divergente com o estoque','Alerta');
            return redirect()->back();

          }else{
          $item = new Item();
          $item->sale_id = $request->sale_id;
          $item->product_id = $request->product_id;
          $item->sale_value = str_replace(",",".",$request->sale_value);
          $item->sale_amount = $request->sale_amount;
         // $item->save();
           $product = $item->product;
          if ($item->save()) {
            $product->amount = $product->amount - $item->sale_amount;
            $product->update();
         }


          $idsale = $item->sale_id;
          $sale = Sale::find($idsale);
          $items =  $sale->items()->get();
          $productList = Product::select('id','name')->get();


           // return view('dashboard.item.create',compact('sale','idsale','items',['productList']));
           Toastr::success('Item incluido na venda com sucesso','Successo');
          return redirect()->back();
        }


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = Item::find($id);

        $productTarget = Item::findOrFail($item->id);
        $productList = Product::select('id','name')->get();
        return view('dashboard.item.edit', compact('item'),compact(['productTarget','productList']));
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

            'product_id' => 'required',
            'sale_id' => 'required',
            'sale_value' => 'required',
            'sale_amount' => 'required'

           ]);




        $item = Item::find($id);
        $item->product_id = $request->product_id;
        $item->sale_id = $request->sale_id;
        $item->sale_value = str_replace(",",".",$request->sale_value);
        $item->sale_amount = $request->sale_amount;
        $item->save();

        $items = Item::all();

        Toastr::success('Item Alterado com Suceso','Successo');
        return redirect()->back();

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
            $item = Item::findOrFail($id);

            if($item->sale->is_approved == 1){
            Toastr::error('Item corresponde a uma venda Aprovada','Alerta');
            return redirect()->back();
            }else{
           // $item->delete();
            $product = $item->product;
            if ($item->delete()) {
              $product->amount = $product->amount + $item->sale_amount;
              $product->update();
           }

            Toastr::success('Item Excluido com Sucesso','Successo');
            return redirect()->back();
    }

    }
}
