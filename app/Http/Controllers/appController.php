<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Service;

class appController extends Controller
{
    public function index(){
        return view("app");
    }

    public function getProducts()
    {
        $products = Product::with(['pictures:id,product_id,file_path'])->get();

        return response()->json($products);
    }

    public function getServices()
    {
        $services = Service::all();
        return response()->json($services);
    }

}
    