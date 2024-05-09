<?php

namespace App\Http\Controllers\Api;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use Illuminate\Http\Resources\Json\JsonResource;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Translation\Exception\NotFoundResourceException;



class CategoryController extends Controller
{

    public function index(Request $request): JsonResource
    {
        $categories = Category::query();

        if ($x = request("search")) {
            $categories->where("name", "LIKE", "%{$x}%");
        }

        if ($x = request("from_date")) {    
            $categories->whereDate("created_at", '>=', date('Y-m-d 00:00:00', strtotime($x)));
        }

        if ($x = request("to_date")) {
            $categories->whereDate("created_at", '<=', date('Y-m-d 23:59:59', strtotime($x)));

        }

        $categories = $categories->orderBy('id', 'desc')->paginate(20);

        return CategoryResource::collection($categories);
        
    }

    public function store(Request $request): JsonResource
    {
        $validated = $request->validate([
            "name" => "required|min:3|max:32",
            "parent_id" => "nullable|integer|exists:categories,id",
            //'deleted_at' => 'required|date',
        ]);

        $validated['image_url'] = env("DEFAULT_IMG_URL");

        $category = Category::create($validated);

        return new CategoryResource($category);
    }
   

    public function show(Request $request, int $id)
    {
        $category = Category::find($id);
        if (is_null($category)) {
            throw new NotFoundResourceException("Category with ID '{$id}' does not exist");
        }

        return new CategoryResource($category);
    }

    public function update(Request $request, int $id): JsonResource
    {
        $validated = $request->validate([
            "name" => "required|min:3|max:32",
            "parent_id" => "nullable|integer|exists:categories,id",
        ]);

        if (is_null($category = Category::find($id))) {
            throw new NotFoundResourceException("Category with ID '{$id}' does not exist");
        }

        $category->update($validated);

        return new CategoryResource($category);
    }

    public function destroy(Request $request, int $id): JsonResource
    {
        $category = Category::find($id);

        if (is_null($category)) {
            throw new NotFoundResourceException("category with ID '{$id}' does not exist");
        }

        $category->delete();

        return new ProductResource($category);

    }

}
