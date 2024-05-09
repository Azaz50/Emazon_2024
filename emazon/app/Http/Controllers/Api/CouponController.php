<?php

namespace App\Http\Controllers\Api;

use App\Models\Coupon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\CouponResource;
use Illuminate\Http\Resources\Json\JsonResource;

class CouponController extends Controller
{
    public function index(Request $request):JsonResource
    {
        $items = request('items') ? request('items'): 10;

        $coupons = Coupon::query()->orderBy('id', 'desc')->paginate($items);

        return CouponResource::collection($coupons);

    }

    public function store(Request $request):JsonResource
    {
        $validated = $request->validate([
            'coupon'        => 'required|string|max:16',
            'value'         => 'required|integer',
            'is_active'     => 'nullable|bool',
        ]);

        $coupons = Coupon::create($validated);

        return new CouponResource($coupons);
    }

    public function show(Request $request, int $id):JsonResource
    {
        $coupons = Coupon::find($id);

        if (is_null($coupons)){
            throw new NotFoundResourceException("Coupon with Id '{$id}' does not exist");
        }

        return new CouponResource($coupons);
    }

    public function update(Request $request, int $id):JsonResource 
    {
        $validated = $request->validate([
            'coupon'        => 'required|string|max:16',
            'value'         => 'required|integer',
        ]);

        if (is_null($coupons = Coupon::find($id))){
            throw new NotFoundResourceException("Coupon with Id '{$id}' does not exist");
        }

        $coupons->update($validated);

        return new CouponResource($coupons);

    }

    public function destroy(Request $request, int $id):JsonResource
    {
        $coupons = Coupon::find($id);

        if (is_null($coupons)){
            throw new NotFoundResourceException("Coupon with id '{$id}' does not exist");
        }

        $coupons->delete();

        return new CouponResource($coupons);
    }
}
