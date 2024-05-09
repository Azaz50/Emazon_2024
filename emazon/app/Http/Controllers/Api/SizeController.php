<?php

namespace App\Http\Controllers\Api;

use App\Models\Size;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\SizeResource;
use Illuminate\Http\Resources\Json\JsonResource;

class SizeController extends Controller
{
    public function index(Request $request): JsonResource
    {
        $items = request('items') ? request('items') : 10;

        $sizes = Size::query()
                   ->orderBy('id', 'desc')
                   ->paginate($items);

        return SizeResource::collection($sizes);
    }

    public function store(Request $request): JsonResource
    {
        $validated = $request->validate([
            
            'size'   => 'nullable|string',   
        ]);

        $sizes = Size::create($validated);

        return new SizeResource($sizes);
    }

    public function show(Request $request, int $id): JsonResource
    {
        $sizes = Size::find($id);
        if (is_null($sizes)) {
            throw new NotFoundResourceException("size with ID '{$id}' does not exist");

        }

        return new SizeResource($sizes);
    }

    public function update(Request $request, int $id): JsonResource
    {
        $validated = $request->validate([
            "size" => "required|string",
        ]);

        if (is_null($sizes = Size::find($id))) {
            throw new NotFoundResourceException("size with ID '{$id}' does not exist");

        }

        $sizes->update($validated);

        return new SizeResource($validated);
    }


    public function destroy(Request $request, int $id): JsonResource
    {
        $sizes = Size::find($id);

        if (is_null($sizes)) {
            throw new NotFoundResourceException("size with ID '{$id}' does not exist");
        }

        $sizes->delete();

        return new ProductResource($sizes);

    }
}
