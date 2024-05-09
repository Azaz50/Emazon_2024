<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Admin\AdminController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [HomeController::class, 'index'])->name('home.index');
Route::get('/products', [ProductController::class, 'index'])->name('product.index');
Route::get('/products/{slug}', [ProductController::class, 'show'])->name('product.show');
Route::get('/carts', [CartController::class, 'index'])->name('cart.index');
Route::post('/carts', [CartController::class, 'store'])->name('cart.store');
Route::delete('/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
Route::post('/cart/apply-coupon', [CartController::class, 'applyCoupon'])->name('cart.apply-coupon');
Route::post('/cart/remove-coupon', [CartController::class, 'removeCoupon'])->name('cart.remove-coupon');

Route::middleware('auth:sanctum')->group(function() {


// Route::get('/logins', [LoginController::class, 'index'])->name('login.index');
// Route::get('/registrations', [RegistrationController::class, 'index'])->name('registration.index');
Route::get('/orders', [OrderController::class, 'success'])->name('order.success');
Route::get('/orders', [OrderController::class, 'failure'])->name('order.failure');
Route::post('/order/store', [OrderController::class, 'store'])->name('order.store');
});





Route::get('/auth/login', [LoginController::class, 'index'])->name('auth.login');
Route::post('/auth/logout', LogoutController::class)->name('auth.logout');
Route::get('/auth/register', [RegisterController::class, 'index'])->name('auth.register');
Route::post('/auth/authenticate', [LoginController::class, 'authenticate'])->name('auth.authenticate');


Route::post('/admin/login', [AdminController::class, 'login']);
Route::post('/admin/logout', [AdminController::class, 'logout']);
