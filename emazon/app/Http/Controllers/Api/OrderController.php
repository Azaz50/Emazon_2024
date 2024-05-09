<?php

namespace App\Http\Controllers\Api;

use index;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\OrderResource;
use Illuminate\Http\Resources\Json\JsonResource;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class OrderController extends Controller
{
    public function index(Request $request): JsonResource
    {
        $items = request('items') ? request('items') : 10;
        $orders = Order::query()->orderBy('id', 'desc')->paginate($items);

        return OrderResource::collection($orders);
    }

    public function store(Request $request): JsonResource 
    {
        $validated = $request->validate([
            'rzp_order_id' => 'nullable|string|max:64',
            'amount' => 'required|integer|min:0',
            'gross_total' => 'required|integer|min:0',
            'sub_total' => 'required|integer|min:0',
            'discount' => 'required|integer|min:0',
            'tax' => 'required|integer|min:0',
            'shipment' => 'required|integer|min:0',
            'user_id' => 'required|exists:users,id',
            'applied_coupon_id' => 'nullable|exists:coupons,id',
            'status' => 'nullable|integer',

        ]);
        $order = Order::create($validated);

        return new OrderResource($order);
    }

    public function show(Request $request, int $id)
    {
        $order = Order::find($id);
        if (is_null($order)) {
            throw new NotFoundResourceException("Order with ID '{$id}' does not exist");
        }

        return new OrderResource($order);
    }

    public function update(Request $request, int $id):JsonResource
    {
        $validated = $request->validate([
            'rzp_order_id' => 'nullable|string|max:64',
            'amount' => 'required|integer|min:0',
            'gross_total' => 'required|integer|min:0',
            'sub_total' => 'required|integer|min:0',
            'discount' => 'required|integer|min:0',
            'tax' => 'required|integer|min:0',
            'shipment' => 'required|integer|min:0',
            'user_id' => 'required|exists:users,id',
            'applied_coupon_id' => 'nullable|exists:coupons,id',
            'status' => 'nullable|integer',

        ]);

        if (is_null($order = Order::find($id) )){
            throw new NotFoundResourceException("Order with ID '{$id}' does not exist");
        }

        $order->update($validated);

        return new OrderResource($order);
    }

    public function destroy(Request $request, int $id): JsonResource
    {
        $order = Order::find($id);

        if (is_null($order)) {
            throw new NotFoundResourceException("product with ID '{$id}' does not exist");
        }

        $order->delete();

        return new ProductResource($order);

    }
}
