<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Http\Resources\Json\JsonResource;

class UserController extends Controller
{
    public function index(Request $request): JsonResource
    {
        $items = request('items') ? request('items') : 10;

        $users = User::query()->orderBy('id', 'desc')->paginate($items);

        return UserResource::collection($users);
    }

    public function store(Request $request): JsonResource
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:32',
            'last_name' => 'required|string|max:32',
            'gender' => 'required|integer|in:0,1',
            'phone' => 'required|string|max:12',
            'email' => 'required|string|max:64|unique:users,email', 
            'password' => 'required|string|min:6|max:256',
            'address_id' => 'required|nullable|exists:addresses,id',
        ]);

        $validated["image_url"] = env("DEFAULT_IMG_URL");

        $user = User::create($validated);

        return new UserResource($user);
    }

    public function show(Request $request, int $id): JsonResource
    {
        $user = User::find($id);

        if (is_null($user)){
            throw new NotFoundResourceException("User with ID '{$id}' does not exist");
        }

        return new UserResource($user);

    }

    public function update(Request $request, int $id): JsonResource 
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:32',
            'last_name' => 'required|string|max:32',
            'gender' => 'required|integer|in:0,1',
            'phone' => 'required|string|max:12',
            'email' => 'required|string|max:64|unique:users,email', 
            'password' => 'required|string|min:6|max:256',
            'address_id' => 'required|nullable|exists:addresses,id',
        ]);

        $validated["image_url"] = env("DEFAULT_IMG_URL");

        if (is_null($user = User::find($id))){
            throw new NotFoundResourceException("User with ID '{$id}' does not exist");
        }

        $user->update($validated);

        return UserResource($user);

    }

    public function destroy(Request $request, int $id): JsonResource
    {
        $user = User::find($id);

        if (is_null($user)) {
            throw new NotFoundResourceException("product with ID '{$id}' does not exist");
        }

        $user->delete();

        return new ProductResource($user);

    }
}
