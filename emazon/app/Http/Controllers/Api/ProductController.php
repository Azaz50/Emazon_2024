<?php

namespace App\Http\Controllers\Api;

use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use Illuminate\Http\Resources\Json\JsonResource;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $items = request('items') ? request('items') : 10;

        $products = Product::query()
                   ->with('category')
                   ->orderBy('id', 'desc')
                   ->paginate($items);

        return ProductResource::collection($products);
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'code'          => 'required|unique:products,code',
            'title'         => 'required|min:4|max:256',
            'subtitle'      => 'required|min:32|max:512',
            'description'   => 'required|min:32|max:1024',
            'price_mp'      => 'required|integer',
            'price_sp'      => 'required|integer',
            'category_id'   => 'required|integer|exists:categories,id',
            'is_returnable' => 'nullable|bool',
        ]);

        $slug = Str::slug($validated["title"]) . random_int(1000, 9999);
        $validated['slug'] = $slug;
        $validated["image_url"] = env("DEFAULT_IMG_URL");
        $product = Product::create($validated);

        return $product;
    }
   


    public function show(Request $request, int $id): JsonResource
    {
        $product = Product::find($id);
        if (is_null($product)) {
            throw new NotFoundResourceException("product with ID '{$id}' does not exist");

        }
        return new ProductResource($product);
    }


    public function update(Request $request, int $id): JsonResource
    {
        $validated = $request->validate([
            'code'          => 'required|unique:products,code',
            'title'         => 'required|min:4|max:256',
            'subtitle'      => 'required|min:32|max:512',
            'description'   => 'required|min:32|max:1024',
            'price_mp'      => 'required|integer',
            'price_sp'      => 'required|integer',
            'category_id'   => 'required|integer|exists:categories,id',
            'is_returnable' => 'nullable|bool',

        ]);

        if (is_null($product = Product::find($id))) {
            throw new NotFoundResourceException("product with ID '{$id}' does not exist");
        }

        $product->update($validated);

        return new ProductResource($product);
    }

    public function destroy(Request $request, int $id): JsonResource
    {
        $product = Product::find($id);

        if (is_null($product)) {
            throw new NotFoundResourceException("product with ID '{$id}' does not exist");
        }

        $product->delete();

        return new ProductResource($product);

    }

}
