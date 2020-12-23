<?php

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

Route::get('/cart', function () {
    return view('cart');
});

// Route::get('/login', function () {
//     return view('auth/login');
// });

// Product
Route::get('/product','App\Http\Controllers\productController@showProduct');
Route::post('/product-detail','App\Http\Controllers\productController@productDetail');
Route::post('/search','App\Http\Controllers\productController@searchProduct');

// register
Route::get('/CustomerReg', function () {
    return view('auth/CustomerReg');
});

Route::get('/EmployeeReg', function () {
    return view('auth/EmployeeReg');
});

Route::get('/register', function () {
    return view('auth/register');
});

Route::post('/CustomerCheck','App\Http\Controllers\registerController@CustomerReg');
Route::post('/EmpCheck','App\Http\Controllers\registerController@EmpReg');


Route::get('/', function () {
    return view('home-02');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
