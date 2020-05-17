<?php

namespace App\Http\Controllers;

use App\Client;
use App\Sale;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clients = Client::latest()->get();

        return view('dashboard.client.index',compact('clients'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.client.create');

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
            'docs' => 'required'
        ],
        [
         'name.required' => 'Campo Empresa esta vazio',
         'docs.required' => 'O campo CNPJ/CPF esta vazio'
        ]);


        $client = new Client();
        $client->name = $request->name;
        $client->docs = $request->docs;
        $client->slug = Str::slug($request->name . $request->docs);
        $client->save();
        Toastr::success('Cliente criado com Sucesso','Successo');
        return redirect()->route('client.index');


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
        $client = Client::find($id);
        return view('dashboard.client.edit',compact('client'));
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
            'docs' => 'required'
        ]);

        $client = Client::find($id);
        $client->name = $request->name;
        $client->docs = $request->docs;
        $client->slug = Str::slug($request->name . $request->docs);
        $client->save();
        Toastr::success('Cliente Alterado com Sucesso','Successo');
        return redirect()->route('client.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         $client = Client::findOrFail($id);

         $sale_count = $client->sale()->count(['client_id']);

        if( $sale_count == 0){

            $client->delete();
            Toastr::success('Cliente excluido com sucesso','Successo');
            return redirect()->back();
        }else{
            Toastr::error('Cliente Possui uma venda e nao pode ser excluido','Alerta');
            return redirect()->back();

    }
    }
}
