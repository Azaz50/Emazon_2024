<?php

namespace App\Http\Controllers\Api;

use App\Models\Color;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ColorResource;
use Illuminate\Http\Resources\Json\JsonResource;

class ColorController extends Controller
{
    public function index(Request $request): JsonResource
    {
        $items = request('items') ? request('items') : 10;

        $colors = Color::query()
                   ->orderBy('id', 'desc')
                   ->paginate($items);

        return ColorResource::collection($colors);
    }

    public function store(Request $request): JsonResource
    {
        $validated = $request->validate([
            'color'         => 'nullable|string|max:64',
            'code'          => 'required|string|max:6'
        ]);

        $colors = Color::create($validated);

        return new ColorResource($colors);
    }

    public function show(Request $request, int $id): JsonResource 
    {
        $colors = Color::find($id);

        if (is_null($colors)){
            throw new NotFoundResourceException("color with ID '{$id}' does not exist");
        }
        return new ColorResource($colors);
    }

    public function update(Request $request, int $id): JsonResource
    {
        $validated = $request->validate([
            'color'         => 'nullable|string|max:64',
            'code'          => 'required|string|max:6'
        ]);

        if (is_null($colors = Color::find($id))){
            throw new NotFoundResourceException("color with ID '{$id}' does not exist");
        }

        $colors->update($validated);

        return new ColorResource($colors);

    }

    public function destroy(Request $request, int $id): JsonResource
    {
        $colors = Color::find($id);

        if (is_null($colors)) {
            throw new NotFoundResourceException("color with ID '{$id}' does not exist");
        }

        $colors->delete();

        return new ProductResource($colors);

    }

}
