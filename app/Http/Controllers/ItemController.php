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

    public function index()
    {
        $items = Item::all();

        return view('dashboard.item.index',compact('items'));
    }

    public function create()   {

        $productList = Product::select('id','name')->get();

        return view('dashboard.item.create',compact(['productList','idsale']));
    }

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

        $id_product = [0];
        $amout_product = [0];
        $item = new Item();
        $item->sale_id = $request->sale_id;

        if (DB::table('items')->where('sale_id',$request->sale_id)->where('product_id', $request->product_id)->count() == 0) {               
            $item->product_id = $request->product_id;               
        } else {
               
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

        if ($request->sale_amount <=0 or $request->sale_amount > $amout_product ) {
            Toastr::error('Saldo divergente com o estoque','Alerta');
            return redirect()->back();

        } else {
            $item = new Item();
            $item->sale_id = $request->sale_id;
            $item->product_id = $request->product_id;
            $item->sale_value = str_replace(",",".",$request->sale_value);
            $item->sale_amount = $request->sale_amount;        
            $product = $item->product;
            if ($item->save()) {
                $product->amount = $product->amount - $item->sale_amount;
                $product->update();
            }
            $idsale = $item->sale_id;
            $sale = Sale::find($idsale);
            $items =  $sale->items()->get();
            $productList = Product::select('id','name')->get();           
            Toastr::success('Item incluido na venda com sucesso','Successo');
            return redirect()->back();
        }
    }    

    public function edit($id)
    {
        $item = Item::find($id);
        $productTarget = Item::findOrFail($item->id);
        $productList = Product::select('id','name','amount')->get();
        return view('dashboard.item.edit', compact('item'),compact(['productTarget','productList']));
    }

    public function update(Request $request, $id)
    {
        $item = Item::find($id);
        $item_sta =  $item->sale_amount;
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
        $product = $item->product;
        $item_add = $request->sale_amount;
        if ($item->save()) {
            if ($item_add > $item_sta){
                $product->amount =  $item_sta - $item->sale_amount + $product->amount;
            } else if($item_add < $item_sta){
                $product->amount =  $item_sta - $item->sale_amount + $product->amount;
            }
            $product->update();
        }
        $items = Item::all();
        Toastr::success('Item Alterado com Suceso','Successo');
        return redirect()->back();
    }

    public function destroy($id)
    {
        $item = Item::findOrFail($id);
        if ($item->sale->is_approved == 1) {
            Toastr::error('Item corresponde a uma venda Aprovada','Alerta');
            return redirect()->back();
        } else {           
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
