<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\PaketPenjualanController;
use App\Http\Controllers\SalesController;
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
    if(auth()->check()){
        if(auth()->user()->role == "admin"){
            return redirect('dashboard');
        }elseif(auth()->user()->role == "sales"){
            return redirect('dashboard-sales');
        }
    }else{
        return view('auth.login');
    }

})->name('/');


Route::get('/login', function () {
    
    if(auth()->check()){
        if(auth()->user()->role == "admin"){
            return redirect('dashboard');
        }elseif(auth()->user()->role == "sales"){
            return redirect('dashboard-sales');
        }
    }else{
        return view('auth.login');
    }

})->name('login');

Route::get('/register', function () {
    if(auth()->check()){
        if(auth()->user()->role == "admin"){
            return redirect('dashboard');
        }elseif(auth()->user()->role == "sales"){
            return redirect('dashboard-sales');
        }
    }else{
        return view('auth.register');
    }
})->name('register');
Route::post('postDaftar', [App\Http\Controllers\AuthController::class, 'register'])->name('postregister');
Route::post('postLogin', [App\Http\Controllers\AuthController::class, 'login'])->name('logins');


Route::middleware(['middleware' => 'admin'])->group(function () {
    Route::get('dashboard',[SalesController::class,'dashboard']);
    Route::get('dashboard-paket',[PaketPenjualanController::class,'dashboard_paket']);
});
Route::middleware(['middleware' => 'sales'])->group(function () {
    Route::get('dashboard-sales',[CustomerController::class,'dashboard']);
});


Route::get('logout',[AuthController::class,'logout']);