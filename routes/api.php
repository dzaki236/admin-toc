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

Route::post('customer/login', [customer\AuthController::class, 'login'])->name('api.customer.login');
Route::post('customer/register', [customer\AuthController::class, 'register'])->name('api.customer.register');
Route::get('customer', [customer\AuthController::class, 'getUser'])->name('api.customer.user');


Route::post('teknisi/login', [teknisi\AuthController::class, 'login'])->name('api.teknisi.login');
Route::post('teknisi/register', [teknisi\AuthController::class, 'register'])->name('api.teknisi.register');
Route::get('teknisi', [teknisi\AuthController::class, 'getUser'])->name('api.teknisi.user');
