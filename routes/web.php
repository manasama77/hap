<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\StockInController;
use App\Http\Controllers\UtilityController;
use App\Http\Controllers\StockOutController;
use App\Http\Controllers\TipeItemController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ItemRequestController;
use App\Http\Controllers\CategoryItemController;
use App\Http\Controllers\StockMonitorController;

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

// set default url / to login
Route::get('/', function () {
    return view('auth.login');
});

Route::group(['middleware' => 'auth'], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/item-request', [ItemRequestController::class, 'index'])->name('item-request');
    Route::get('/item-request/create', [ItemRequestController::class, 'create'])->name('item-request.create');
    Route::post('/item-request/store', [ItemRequestController::class, 'store'])->name('item-request.store');
    Route::post('/item-request/store_temp', [ItemRequestController::class, 'store_temp'])->name('item-request.store_temp');
    Route::get('/item-request/get_temp_item', [ItemRequestController::class, 'get_temp_item'])->name('item-request.get_temp_item');
    Route::post('/item-request/update/{id}', [ItemRequestController::class, 'update'])->name('item-request.update');
    Route::post('/item-request/delete/{id}', [ItemRequestController::class, 'destroy'])->name('item-request.delete');



    // warehouse start
    Route::get('/stock-monitor', [StockMonitorController::class, 'index'])->name('stock-monitor');

    Route::get('/stock-in', [StockInController::class, 'index'])->name('stock-in');
    Route::get('/stock-in/create', [StockInController::class, 'create'])->name('stock-in.create');
    Route::post('/stock-in/store', [StockInController::class, 'store'])->name('stock-in.store');
    Route::post('/stock-in/store_temp', [StockInController::class, 'store_temp'])->name('stock-in.store_temp');
    Route::get('/stock-in/get_temp_item', [StockInController::class, 'get_temp_item'])->name('stock-in.get_temp_item');
    Route::post('/stock-in/delete_temp_item', [StockInController::class, 'delete_temp_item'])->name('stock-in.delete_temp_item');

    Route::get('/stock-out', [StockOutController::class, 'index'])->name('stock-out');
    Route::get('/stock-out/create', [StockOutController::class, 'create'])->name('stock-out.create');
    Route::post('/stock-out/store', [StockOutController::class, 'store'])->name('stock-out.store');
    Route::post('/stock-out/store_temp', [StockOutController::class, 'store_temp'])->name('stock-out.store_temp');
    Route::get('/stock-out/get_temp_item', [StockOutController::class, 'get_temp_item'])->name('stock-out.get_temp_item');
    Route::post('/stock-out/delete_temp_item', [StockOutController::class, 'delete_temp_item'])->name('stock-out.delete_temp_item');
    Route::post('/stock-out/destroy/{id}', [StockOutController::class, 'destroy'])->name('stock-out.destroy');
    // warehouse end

    // Configuration start
    Route::get('/user', [UserController::class, 'index'])->name('user');
    Route::get('/user/create', [UserController::class, 'create'])->name('user.create');
    Route::post('/user/store', [UserController::class, 'store'])->name('user.store');
    Route::get('/user/edit/{id}', [UserController::class, 'edit'])->name('user.edit');
    Route::post('/user/update/{id}', [UserController::class, 'update'])->name('user.update');
    Route::post('/user/delete/{id}', [UserController::class, 'destroy'])->name('user.delete');

    Route::get('/team', [TeamController::class, 'index'])->name('team');
    Route::post('/team/store', [TeamController::class, 'store'])->name('team.store');
    Route::post('/team/update/{id}', [TeamController::class, 'update'])->name('team.update');
    Route::delete('/team/delete/{id}', [TeamController::class, 'delete'])->name('team.delete');

    Route::get('/category-item', [CategoryItemController::class, 'index'])->name('category-item');
    Route::post('/category-item/store', [CategoryItemController::class, 'store'])->name('category-item.store');
    Route::post('/category-item/update/{id}', [CategoryItemController::class, 'update'])->name('category-item.update');
    Route::post('/category-item/delete/{id}', [CategoryItemController::class, 'destroy'])->name('category-item.delete');

    Route::get('/tipe-item', [TipeItemController::class, 'index'])->name('tipe-item');
    Route::post('/tipe-item/store', [TipeItemController::class, 'store'])->name('tipe-item.store');
    Route::post('/tipe-item/update/{id}', [TipeItemController::class, 'update'])->name('tipe-item.update');
    Route::post('/tipe-item/delete/{id}', [TipeItemController::class, 'destroy'])->name('tipe-item.delete');

    Route::get('/item', [ItemController::class, 'index'])->name('item');
    Route::post('/item/store', [ItemController::class, 'store'])->name('item.store');
    Route::post('/item/update/{id}', [ItemController::class, 'update'])->name('item.update');
    Route::post('/item/delete/{id}', [ItemController::class, 'destroy'])->name('item.delete');

    Route::get('/vendor', [VendorController::class, 'index'])->name('vendor');
    Route::post('/vendor/store', [VendorController::class, 'store'])->name('vendor.store');
    Route::post('/vendor/update/{id}', [VendorController::class, 'update'])->name('vendor.update');
    Route::post('/vendor/delete/{id}', [VendorController::class, 'destroy'])->name('vendor.delete');

    Route::get('/get_technician_unassign', [UtilityController::class, 'get_technician_unassign'])->name('get_technician_unassign');
    Route::post('/assign_technician', [UtilityController::class, 'assign_technician'])->name('assign_technician');

    // Configuration end
});

Route::get('/work-order', function () {
    return view('pages.work_order.main');
})->name('work-order');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
