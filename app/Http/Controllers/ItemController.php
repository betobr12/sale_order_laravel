<?php

namespace App\Http\Controllers;

use App\Item;
use App\Product;
use App\Sale;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Database\Console\Migrations\RefreshCommand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

           ]);

           $item = new Item();
        /*
          // $product = $request->product_id;
             $product_id = $request->get('product_id');

            return $result = DB::table('items')
            ->where('product_id', 'like', "%$product_id%")
            ->get();



            if($result == $request->product_id ){
                Toastr::error('Produto repitido','Alerta');
                return redirect()->back();
            }else{

           $item->product_id = $request->product_id;
            }

        */
           $item->product_id = $request->product_id;
           $item->sale_id = $request->sale_id;
           $item->sale_value = $request->sale_value;
           $item->sale_amount = $request->sale_amount;
           $item->save();

          $idsale = $item->sale_id;
          $sale = Sale::find($idsale);
          $items =  $sale->items()->get();
          $productList = Product::select('id','name')->get();


           // return view('dashboard.item.create',compact('sale','idsale','items',['productList']));
           Toastr::success('Item incluido na venda com sucesso','Successo');
          return redirect()->back();


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
        return view('dashboard.item.edit', compact('item'));
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
        $item = Item::find($id);
        $item->product_id = $request->product_id;
        $item->sale_id = $request->sale_id;
        $item->sale_value = $request->sale_value;
        $item->sale_amount = $request->sale_amount;
        $item->save();
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
            $item->delete();
            Toastr::success('Item Excluido com Sucesso','Successo');
            return redirect()->back();
    }

    }
}
