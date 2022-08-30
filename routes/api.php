<?php

use App\Http\Controllers\api\admin\AdminController;
use App\Http\Controllers\api\auth\AuthController;
use App\Http\Controllers\api\CategoryController;
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

Route::post('auth/register',[AuthController::class,'createUser']);
Route::post('auth/login',[AuthController::class,'loginUser']);
Route::get('Category/all',[CategoryController::class,'all']);
Route::post('Category/create',[CategoryController::class,'create']);
Route::delete('Category/delete/{id}',[CategoryController::class,'delete']);
