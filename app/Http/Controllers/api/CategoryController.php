<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        return response()->json([
            'status' => true,
            'categories' => Category::all(),
            'statusCode' => 200
        ]);
    }
    public function show(Category $category)
    {
        return response()->json([
            'status' => true,
            'category' => $category,
            'statusCode' => 200
        ]);
    }
    public function store(CategoryRequest $request){
        $category = Category::create($request->validated());
        return response()->json([
            'status' => true,
            'message' => 'category has been created successfully',
            'id' => $category->id,
            'statusCode' => 200
        ]);
    }
    public function update(UpdateCategoryRequest $request , Category $category){
        $category->update($request->validated());
        return response()->json([
            'status' => true,
            'message' => 'category has been updated successfully',
            'statusCode' => 200
        ]);
    }
    public function destroy(Category $category){
        if ($category != null) {
            $category->delete();
            return response()->json([
                'status' => true,
                'message' => 'category has been deleted successfully',
                'statusCode' => 200
            ]);
        }
        return response()->json([
            'status' => false,
            'message' => 'category is not defined',
            'statusCode' => 200
        ]);
    }

}
