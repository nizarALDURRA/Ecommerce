<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function all()
    {
        return response()->json([
            'status' => true,
            'categories' => Category::all(),
            'statusCode' => 200
        ]);
    }
    public function create(CategoryRequest $request){
        $category = new Category();
        $category->name = $request->name;
        $category->save();
        return response()->json([
            'status' => true,
            'message' => 'category has been created successfully',
            'id' => $category->id,
            'statusCode' => 200
        ]);
    }
    public function update(Category $category,CategoryRequest $request){
        $category->name = $request->name;
        $category->save();
        return response()->json([
            'status' => true,
            'message' => 'category has been updated successfully',
            'statusCode' => 200
        ]);
    }
    public function delete($id){
        $category = Category::where('id',$id)->first();
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
