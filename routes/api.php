<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\PaketPenjualanController;
use App\Http\Controllers\SalesController;
use App\Models\Customer;
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

Route::get('data-sales',[SalesController::class,'data']);
Route::post('add-sales',[SalesController::class,'stores']);
Route::get('get-sales/{id}',[SalesController::class,'getid']);
Route::post('update-sales/{id}',[SalesController::class,'update_sales']);
Route::delete('hapus-sales/{id}',[SalesController::class,'hapus']);

Route::get('data-customer',[CustomerController::class,'data']);
Route::get('get-paket',[CustomerController::class,'get_paket']);
Route::post('add-customer',[CustomerController::class,'stores']);
Route::get('get-customer/{id}',[CustomerController::class,'getid']);
Route::post('update-customer/{id}',[CustomerController::class,'update_customer']);
Route::delete('hapus-customer/{id}',[CustomerController::class,'hapus']);


Route::get('data-paket',[PaketPenjualanController::class,'data']);
Route::post('add-paket',[PaketPenjualanController::class,'stores']);
Route::get('get-paket/{id}',[PaketPenjualanController::class,'getid']);
Route::post('update-paket/{id}',[PaketPenjualanController::class,'update_paket']);
Route::delete('hapus-paket/{id}',[PaketPenjualanController::class,'hapus']);