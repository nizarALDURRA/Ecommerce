<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        return response()->json([
            'status' => true,
            'products' => Product::all(),
            'statusCode' => 200
        ]);
    }

    public function show(Product $product)
    {
        return response()->json([
            'status' => true,
            'product' => $product,
            'statusCode' => 200
        ]);
    }

    public function store(ProductRequest $request)
    {
        $product = Product::create($request->validated());
        return response()->json([
            'status' => true,
            'message' => 'product has been created successfully',
            'id' => $product->id,
            'statusCode' => 200
        ]);
    }

    public function update(UpdateProductRequest $request, Product $product)//(request, Product $product)
    {
        $product->update($request->validated());
        return response()->json([
            'status' => true,
            'message' => 'product has been updated successfully',
            'statusCode' => 200
        ]);
    }

    public function destroy(Product $product)
    {
        if ($product != null) {
            $product->delete();
            return response()->json([
                'status' => true,
                'message' => 'product has been deleted successfully',
                'statusCode' => 200
            ]);
        }
        return response()->json([
            'status' => false,
            'message' => 'product is not defined',
            'statusCode' => 200
        ]);
    }
}
