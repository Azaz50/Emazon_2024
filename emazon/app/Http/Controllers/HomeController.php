<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        
        $query = Product::query();
        $products = $query->take(12)->get();

        return view('home', [
            'products' => $products,
        ]);
    }
}
