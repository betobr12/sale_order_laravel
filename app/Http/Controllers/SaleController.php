<?php

namespace App\Http\Controllers;

use App\Client;
use App\Item;
use App\Product;
use App\Sale;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SaleController extends Controller
{
    public function index()
    {
        $sales = Sale::latest()->get();
        return view('dashboard.sale.index',compact('sales'));
    }
    
    public function create()
    {
        $idsale = 0;
        $sales = Sale::latest()->get();
        $clientList = Client::select('id','name')->get();
        return view('dashboard.sale.create',compact('sales'),compact(['clientList','idsale']));
    }
    
    public function store(Request $request)
    {
        $productList = Product::select('id','name')->get();
        $this->validate($request,[
         'client_id' => 'required',
        ]);
        $sale = new Sale();
        $sale->client_id = $request->client_id;
        $sale->save();

        $idsale = $sale->id;
        $items = $sale->items();
        Toastr::success('Venda Criada Com Sucesso Selecione-o abaixo para Finalizar a Venda','Successo');
        return redirect()->back();
    }
    
    public function show($id)
    {
        $sale = Sale::find($id);
        $client = $sale->client()->get();
        $items =  $sale->items()->latest()->get();

        $total_price = DB::table('items')
        ->where('sale_id',$id)
        ->get();
        $result = 0;

        foreach ($total_price as $item)
        {
            $result += $item->sale_amount * $item->sale_value;
        }
        return view('dashboard.sale.show',compact('sale','items'), compact(['result']));
    }

    public function edit($id)
    {
        $sale = Sale::find($id);
        if ($sale->is_approved == 0) {
            $productList = Product::select('id','name','amount')->get();
            $client = $sale->client()->get();
            $clientTarget = Client::findOrFail($sale->client_id);
            $clientList = Client::select('id','name')->get();
            $sale = Sale::find($id);
            $items =  $sale->items()->latest()->get();
            $result = DB::table('items')->where('sale_id',$id)->get();
            $total_price = 0;
            
            foreach ($result as $item) {
                $total_price+=$item->sale_value*$item->sale_amount;
            }         
            return view('dashboard.sale.edit',compact('sale','items'), compact(['clientTarget', 'clientList','productList','total_price']));
        } else {
            Toastr::error('Venda aprovada não pode ser alterada','Alerta');
            return redirect()->back();
        }
    }

    public function update(Request $request, $id)
    {
        $sale = Sale::find($id);
        $sale->client_id = $request->client_id;
        $sale->total = $request->total;
        $sale->is_approved = $request->is_approved;
        $sale->save();
        $sales = Sale::all();
        Toastr::success('Venda gerada','Successo');
        return redirect()->route('sale.index',compact('sales'));
    }
    
    public function destroy($id)
    {
        $sale = Sale::findOrFail($id);
        if ($sale->is_approved == 0) {
            $sale->delete();
            Toastr::success('Venda excluida com sucesso','Successo');
            return redirect()->back();
        } else {
            Toastr::error('Esta venda foi concluida e não pode ser excluida','Alerta');
            return redirect()->back();
        }
    }
}
