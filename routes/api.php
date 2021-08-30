<?php

namespace App\Http\Controllers\Api;

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


//auth customer
Route::post('customer/login', [customer\AuthController::class, 'login'])->name('api.customer.login');
Route::post('customer/register', [customer\AuthController::class, 'register'])->name('api.customer.register');


Route::group(['middleware' => 'auth:api'], function () {
    Route::get('customer', [customer\AuthController::class, 'getUser'])->name('api.customer.user');
    Route::get('order', [customer\OrderController::class, 'index'])->name('api.order.index');
    Route::post('order', [customer\OrderController::class, 'order'])->name('api.order.store');
});


//auth teknisi
Route::post('teknisi/login', [teknisi\AuthController::class, 'login'])->name('api.teknisi.login');
Route::post('teknisi/register', [teknisi\AuthController::class, 'register'])->name('api.teknisi.register');

Route::group(['middleware' => 'auth:teknisi-api'], function () {
    Route::get('teknisi', [teknisi\AuthController::class, 'getUser'])->name('api.teknisi.user');
    Route::get('repair', [teknisi\RepairController::class, 'index'])->name('api.repair.index');
    Route::post('repair', [teknisi\RepairController::class, 'repair'])->name('api.repair.store');

    Route::get('/cart', [teknisi\CartController::class, 'index'])->name('teknisi.cart.index');
    Route::post('/cart', [teknisi\CartController::class, 'store'])->name('teknisi.cart.store');
    Route::get('/cart/total', [teknisi\CartController::class, 'getCartTotal'])->name('teknisi.cart.total');
    Route::post('/cart/remove', [teknisi\CartController::class, 'removeCart'])->name('teknisi.cart.remove');
    Route::post('/cart/removeAll', [teknisi\CartController::class, 'removeAllCart'])->name('teknisi.cart.removeAll');
});


//category
Route::get('/categories', [CategoryController::class, 'index'])->name('customer.category.index');
Route::get('/category/{slug?}', [CategoryController::class, 'show'])->name('customer.category.show');
Route::get('/categoryHeader', [CategoryController::class, 'categoryHeader'])->name('customer.category.categoryHeader');

//product
Route::get('/products', [ProductController::class, 'index'])->name('customer.product.index');
Route::get('/product/{slug?}', [ProductController::class, 'show'])->name('customer.product.show');