<?php

namespace App\Http\Controllers;

use App\Client;
use App\Item;
use App\Sale;
use Illuminate\Http\Request;

class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sales = Sale::latest()->get();
        return view('dashboard.sale.index',compact('sales'));


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $idsale = 0;
        $sales = Sale::all();
        $clientList = Client::select('id','name')->get();
        return view('dashboard.sale.create',compact('sales'),compact(['clientList','idsale']));
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
         'client_id' => 'required'
        ]);

        $sale = new Sale();
        $sale->client_id = $request->client_id;
        $sale->save();

        $idsale = $sale->id;
        $items = $sale->items();
        //return redirect()->route('item.create',compact(['idsale']));

        return view('dashboard.item.create',compact('sale','items'),compact(['idsale']));



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
        $sale = Sale::find($id);

        $client = $sale->client()->get();
        $clientTarget = Client::findOrFail($sale->client_id);
        $clientList = Client::select('id','name')->get();


        $sale = Sale::find($id);
        $items =  $sale->items()->get();

       return view('dashboard.sale.edit',compact('sale','items'), compact(['clientTarget', 'clientList']));
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
        {
            $sale = Sale::find($id);
            $sale->client_id = $request->client_id;
            $sale->save();
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $sale = Sale::findOrFail($id);
        $sale->delete();
        return redirect()->back();
    }
}
