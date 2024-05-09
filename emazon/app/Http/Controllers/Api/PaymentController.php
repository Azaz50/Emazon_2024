<?php

namespace App\Http\Controllers\Api;

use App\Models\Payment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\PaymentResource;
use Illuminate\Http\Resources\Json\JsonResource;

class PaymentController extends Controller
{
    public function index(Request $request)
    {
        $items = request('items') ? request('items') : 10;

        $payments = Payment::query()
                   ->orderBy('id', 'desc')
                   ->paginate($items);

        return PaymentResource::collection($payments);
    }

    public function store(Request $request):jsonResource
    {
        $validated = $request->validate([
            'amount'          => 'required|integer|',
            'order_group_id'  => 'required|integer|exists:order_groups,id',
            'pg_payment_id'   => 'required|integer|exists:pg_payments,id',
            'user_id'         => 'required|integer|exists:users,id',
            'status'          => 'nullable|bool',
            'mode'            => 'nullable|bool',
        ]);

        $payments = Payment::create($validated);

        return PaymentResource($payments);
    }

    public function show(Request $request, int $id): JsonResource
    {
        $payments = Payment::find($id);

        if (is_null($payments)){
            throw new NotFoundResourceExcption("payment with id '{$id}' does not exist");
        }

        return new PaymentResource($payments);
    }

    public function update(Request $request, int $id): JsonResource
    {
        $validated = $request->validate([
            'amount'          => 'required|integer|',
            'order_group_id'  => 'required|integer|exists:order_groups,id',
            'pg_payment_id'   => 'required|integer|exists:pg_payments,id',
            'user_id'         => 'required|integer|exists:users,id',
            'status'          => 'nullable|bool',
            'mode'            => 'nullable|bool',
        ]);

        if (is_null($payments = Payment::find($id))) {
            throw new NotFoundResourceException("payment with ID '{$id}' does not exist");
        }

        $payments->update($validated);

        return new PaymentResource($payments);
    }

    public function destroy(Request $request, int $id): JsonResource
    {
        $payments = Payment::find($id);

        if (is_null($payments)) {
            throw new NotFoundResourceException("product with ID '{$id}' does not exist");
        }

        $payments->delete();

        return new ProductResource($payments);

    }
}
