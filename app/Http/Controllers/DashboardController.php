<?php

namespace App\Http\Controllers;

use App\Item;
use App\Product;
use App\Sale;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $sales = Sale::count();
        $items = Item::count();
        $products = Product::count();
        return view('dashboard.index',compact('sales','items','products'));
    }
}
