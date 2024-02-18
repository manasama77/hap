<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UtilController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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


Route::group(['prefix' => 'dashboard'], function () {
    Route::get('/count', [DashboardController::class, 'get_count'])->name('dashboard.count');
});

Route::get('/get_list_item', [UtilController::class, 'get_list_item'])->name('get_list_item');
Route::get('/get_list_item_sn', [UtilController::class, 'get_list_item_sn'])->name('get_list_item_sn');
