<?php

namespace App\Http\Controllers;

use App\Models\Size;
use App\Models\Color;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $categories = Category::all();
        $products = Product::query();

        $q              = $request->input('q');
        $price_order    = (int) $request->input('price_order');
        $category_id    = (int) $request->input('category_id');

        if ($q) {
            $products->where('title', 'LIKE', "%{$q}%");
        }
        if ($price_order) {
            $products->orderBy('price_sp', $price_order == 1 ? 'asc' : 'desc');
        }
        if ($category_id) {
            $products->where('category_id', $category_id);
        }

        if (!$price_order) {
            $products->orderBy('id', 'desc');
        }

        $products = $products->paginate(20);

        return view('product.index', [
            'products' => $products,
            'categories' => $categories,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, string $slug)
    {
        $product = Product::where('slug', $slug)->first();

        if (is_null($product)) {
            abort(404);
        }

        $sizes = [];
        $colors = [];
        $product_colors = $product->productColors()->get();
        $product_sizes = $product->productSizes()->get();
        
        $color_ids = $product_colors->map(function($item) {
            return $item->color_id;
        });

        $size_ids = $product_sizes->map(function($item) {
            return $item->size_id;
        });


        $colors = Color::whereIn('id', $color_ids->toArray())->get();
        $sizes  = Size::whereIn('id', $size_ids->toArray())->get();


        return view('product.show', [
            'product' => $product,
            'colors' => $colors,
            'sizes' => $sizes,
        ]);
    }
}
