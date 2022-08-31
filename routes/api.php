<?php

use App\Http\Controllers\api\admin\AdminController;
use App\Http\Controllers\api\auth\AuthController;
use App\Http\Controllers\api\CategoryController;
use App\Http\Controllers\api\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
//---------------------------- Auth --------------------------------
Route::post('auth/register',[AuthController::class,'createUser']);
Route::post('auth/login',[AuthController::class,'loginUser']);

//--------------------------- categories ---------------------------
Route::post('categories/{category}/update',[CategoryController::class,'update'])->name('category.update');
Route::resource('categories', CategoryController::class)->except(['update', 'create', 'edit']);

//--------------------------- product ------------------------------
Route::post('products/{product}/update',[ProductController::class,'update'])->name('products.update');
Route::resource('products', ProductController::class)->except(['update', 'create', 'edit']);

//---------------------------------------------------------
