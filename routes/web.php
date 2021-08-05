<?php
namespace App\Http\Controllers\Admin;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', function () {
    //return view('welcome');
    return view('auth.login');
});

/**
 * route for admin
 */

//group route with prefix "admin"
Route::prefix('admin')->group(function () {

    //group route with middleware "auth"
    Route::group(['middleware' => 'auth'], function() {
        
        //route dashboard
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard.index');
        Route::resource('/category', CategoryController::class, ['as' => 'admin']);
        //route product
        Route::resource('/product', ProductController::class, ['as' => 'admin']);
        //route order 'except' => ['create', 'store', 'edit', 'update', 'destroy'], 'as' => 'admin']
        Route::resource('/order', OrderController::class, ['as' => 'admin']);
       // Route::delete('/order/{id}',[OrderController::class,'destroy']);
        //route customer
        Route::get('/customer', [CustomerController::class, 'index'])->name('admin.customer.index');

        //route mitra reseller
        Route::get('/reseller-mitra', [ResellerController::class, 'index'])->name('admin.reseller.index');
        //reoute member customer dari reseller
        Route::get('/member-reseller/{kode_mitra}', [ResellerController::class, 'memberIndex'])->name('admin.reseller.member');
        //route transaksi order reseller
        Route::get('/order-reseller/{kode_mitra}', [ResellerController::class, 'order'])->name('admin.reseller.order');

        Route::get('/reseller-profit', [ResellerController::class, 'showKonfigProfit'])->name('admin.konfig.profit');
        Route::post('/konfig-profit', [ResellerController::class, 'showKonfigProfit'])->name('admin.konfig.store');

        Route::post('/verify-reseller', [ResellerController::class, 'updateVerify'])->name('admin.reseller.verify');
        //route slider
        Route::resource('/slider', SliderController::class, ['except' => ['show', 'create', 'edit', 'update'], 'as' => 'admin']);
        //profile
        Route::get('/profile', [ProfileController::class, 'index'])->name('admin.profile.index');
        //route user
        Route::resource('/user', UserController::class, ['except' => ['show'], 'as' => 'admin']);

        Route::get('/bukti', [BuktidataController::class, 'index'])->name('admin.bukti.index');
        //reoute member customer dari reseller
        Route::get('/bukti/show/{id}', [BuktidataController::class, 'show'])->name('admin.bukti.show');
        Route::put('/bukti/update', [BuktidataController::class, 'update'])->name('admin.bukti.update');

        Route::get('/klaim', [KlaimController::class, 'index'])->name('admin.klaim.index');
        Route::get('/klaim/show/{id}', [KlaimController::class, 'show'])->name('admin.klaim.show');
        Route::put('/klaim/update', [KlaimController::class, 'update'])->name('admin.klaim.update');
    });
});
