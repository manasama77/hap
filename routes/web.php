<?php

use App\Http\Controllers\CategoryItemController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\StockMonitorController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UtilityController;
use App\Http\Controllers\VendorController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::group(['middleware' => 'auth'], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // warehouse start
    Route::get('/stock-monitor', [StockMonitorController::class, 'index'])->name('stock-monitor');
    // warehouse end

    // Configuration start
    Route::get('/team', [TeamController::class, 'index'])->name('team');
    Route::post('/team/store', [TeamController::class, 'store'])->name('team.store');
    Route::post('/team/update/{id}', [TeamController::class, 'update'])->name('team.update');
    Route::delete('/team/delete/{id}', [TeamController::class, 'delete'])->name('team.delete');

    Route::get('/user', [UserController::class, 'index'])->name('user');
    Route::get('/user/create', [UserController::class, 'create'])->name('user.create');
    Route::post('/user/store', [UserController::class, 'store'])->name('user.store');
    Route::get('/user/edit/{id}', [UserController::class, 'edit'])->name('user.edit');
    Route::post('/user/update/{id}', [UserController::class, 'update'])->name('user.update');
    Route::post('/user/delete/{id}', [UserController::class, 'destroy'])->name('user.delete');

    Route::get('/category-item', [CategoryItemController::class, 'index'])->name('category-item');
    Route::post('/category-item/store', [CategoryItemController::class, 'store'])->name('category-item.store');
    Route::post('/category-item/update/{id}', [CategoryItemController::class, 'update'])->name('category-item.update');
    Route::post('/category-item/delete/{id}', [CategoryItemController::class, 'destroy'])->name('category-item.delete');

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
