<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CartController;
use App\Http\Controllers\Api\SizeController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\ColorController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\CouponController;
use App\Http\Controllers\Api\PaymentController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\ProductImageController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/v1/categories', [CategoryController::class, 'store']);
Route::get('/v1/categories', [CategoryController::class, 'index']);
Route::get('/v1/categories/{id}', [CategoryController::class, 'show']);
Route::patch('/v1/categories/{id}', [CategoryController::class, 'update']);
Route::delete('/v1/categories/{id}', [CategoryController::class, 'destroy']);

Route::post('/v1/products', [ProductController::class, 'store']);
Route::get('/v1/products', [ProductController::class, 'index']);
Route::get('/v1/products/{id}', [ProductController::class, 'show']);
Route::patch('/v1/products/{id}', [ProductController::class, 'update']);
Route::delete('/v1/products/{id}', [ProductController::class, 'destroy']);
Route::post("/v1/products/{id}/color-variants", [ProductController::class, 'colorVariants']);
Route::post("/v1/products/{id}/size-variants", [ProductController::class, 'sizeVariants']);

Route::get('/v1/users', [UserController::class, 'index']);
Route::get('/v1/users/{id}', [UserController::class, 'show']);

Route::get('/v1/orders', [OrderController::class, 'index']);
Route::get('/v1/orders/{id}', [OrderController::class, 'show']);

Route::get('/v1/coupons', [CouponController::class, 'index']);
Route::post('/v1/coupons', [CouponController::class, 'store']);
Route::get('/v1/coupons/{id}', [CouponController::class, 'show']);
Route::patch('/v1/coupons/{id}', [CouponController::class, 'update']);
Route::delete('/v1/coupons/{id}', [CouponController::class, 'destroy']);

Route::get('/v1/carts', [CartController::class, 'index']);
Route::post('/v1/carts', [CartController::class, 'store']);
Route::get('/v1/carts/{id}', [CartController::class, 'show']);
Route::patch('/v1/carts/{id}', [CartController::class, 'update']);
Route::delete('/v1/carts/{id}', [CartController::class, 'destroy']);

Route::get('/v1/payments', [PaymentController::class, 'index']);
Route::get('/v1/payments/{id}', [PaymentController::class, 'show']);

Route::get('/v1/colors', [ColorController::class, 'index']);
Route::post('/v1/colors', [ColorController::class, 'store']);
Route::get('/v1/colors/{id}', [ColorController::class, 'show']);
Route::patch('/v1/colors/{id}', [ColorController::class, 'update']);
Route::delete('/v1/colors/{id}', [ColorController::class, 'destroy']);

Route::get('/v1/sizes', [SizeController::class, 'index']);
Route::post('/v1/sizes', [SizeController::class, 'store']);
Route::get('/v1/sizes/{id}', [SizeController::class, 'show']);
Route::patch('/v1/sizes/{id}', [SizeController::class, 'update']);
Route::delete('/v1/sizes/{id}', [SizeController::class, 'destroy']);

Route::get('/v1/productImages', [ProductImageController::class, 'index']);
Route::post('/v1/productImages', [ProductImageController::class, 'store']);
Route::get('/v1/productImages/{id}', [ProductImageController::class, 'show']);