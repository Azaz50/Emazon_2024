<?php

namespace App\Http\Controllers\Api;

use App\Models\Cart;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\CartResource;
use Illuminate\Http\Resources\Json\JsonResource;

class CartController extends Controller
{
    public function index(Request $request):JsonResource
    {
        $items = request('items') ? request('items') : 10;

        $carts = Cart::query()->orderBy('id', 'desc')->paginate($items);

        return CartResource::collection($carts);
    }

    public function store(Request $request): JsonResource
    {
        $validated = $request->validate([
            'user_id'   => 'required|integer|exists:users,id',
            'coupon_id'   => 'nullable|integer|exists:coupons,id',
        ]);

        $carts = Cart::create($validated);

        return new CartResource($carts);
    }

    public function show(Request $request, int $id): JsonResource
    {
        $carts = Cart::find($id);

        if (is_null($carts)){
            throw new NotFoundResourceException("carts with id '{$id}' does not exist");
        }

        return new CartResource($carts);
    }

    public function update(Request $request, int $id):JsonResource
    {
        $validated = $request->validate([
            'user_id'   => 'required|integer|exists:users,id',
            'coupon_id'   => 'nullable|integer|exists:coupons,id',
        ]);

        if (is_null($carts = Cart::find($id))){
            throw new NotFoundResourceException("carts with id '{$id}' does not exist");
        }

        $carts->update($validated);

        return new ProductResource($carts);

    }

    public function destroy(Request $request, int $id): JsonResource
    {
        $carts = Cart::find($id);

        if (is_null($carts)) {
            throw new NotFoundResourceException("cart with ID '{$id}' does not exist");
        }

        $carts->delete();

        return new ProductResource($carts);

    }

}
