<?php

namespace App\Http\Controllers\Api;

use App\Models\Product;
use App\Models\ProductSize;
use Illuminate\Support\Str;
use App\Models\ProductColor;
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

    public function colorVariants(Request $request, int $id)
    {
        $validated = $request->validate([
            'colors.*' => 'required|integer|exists:colors,id',
        ]);

        if ($validated == []) {
            $validated = [
                'colors'    =>  [],
            ];
        }

        $product = Product::find($id);
        if (is_null($product)) {
            throw new NotFoundResourceException("Product with ID '$id' does not exist");
        }

        $color_ids = $validated['colors'];


        ProductColor::where('product_id', $id)->delete();

        $product_colors = [];

        for ($i = 0; $i < count($color_ids); ++$i) {
            $product_colors[] = [
                'product_id'    =>  $id,
                'color_id' =>  $color_ids[$i],
            ];
        }

        $product->productColors()->createMany($product_colors);
        //ddd($product_colors);

        return new ProductResource($product);

    }

    public function sizeVariants(Request $request, int $id): JsonResource
    {
        $validated = $request->validate([
            'sizes.*' =>  'required|integer|exists:sizes,id',
        ]);

        if ($validated == []) {
            $validated = [
                'sizes'    =>  [],
            ];
        }

        $product = Product::find($id);
        if (is_null($product)) {
            throw new NotFoundResourceException("Product with ID '$id' does not exist");
        }

        $size_ids = $validated['sizes'];

        ProductSize::where('product_id', $id)->delete();

        $product_sizes = [];

        for ($i = 0; $i < count($size_ids); ++$i) {
            $product_sizes[] = [
                'product_id'    =>  $id,
                'size_id'  =>  $size_ids[$i],
            ];
        }

        $product->productSizes()->createMany($product_sizes);

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
