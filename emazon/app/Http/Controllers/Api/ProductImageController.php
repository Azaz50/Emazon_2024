<?php

namespace App\Http\Controllers\Api;

use App\Models\ProductImage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProductImageResource;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductImageController extends Controller
{
    public function index(Request $request):JsonResource
    {
        $items = request('items') ? request('items') : 10;

        $productImages = ProductImage::query()
                   ->orderBy('id', 'desc')
                   ->paginate($items);

        return ProductImageResource::collection($productImages);
    }

    public function store(Request $request): JsonResource
    {
        $validated = $request->validate([
            'product_id' => 'required|integer|exists:products,id',
            'image_url'  => 'required|string',
        ]);

        $productImage = ProductImage::create($validated);

        return new ProductImageResource($productImage);
    }


    public function show(Request $request, int $id):JsonResource
    {
        $productImage = ProductImage::find($id);
        if (is_null($productImage)) {
            throw new NotFoundResourceException("product Image with ID '{$id}' does not exist");
        }

        return new ProductImageResource($productImage);
    }
}
