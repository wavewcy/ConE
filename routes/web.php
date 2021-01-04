<?php

use Illuminate\Support\Facades\Route;

//home
Route::get('/', function () {
    return view('home-02');
});
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//login
Auth::routes();
// Route::get('/login', function () {
//     return view('auth/login');
// });

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

// Product
Route::get('/product','App\Http\Controllers\productController@showProduct');
Route::get('/product-detail','App\Http\Controllers\productController@productDetail');
Route::get('/product-detail/addToCart','App\Http\Controllers\ordersController@addToCart');
Route::get('/search','App\Http\Controllers\productController@searchProduct');

//order
Route::get('/cart','App\Http\Controllers\ordersController@cart');
Route::get('/cart/delete','App\Http\Controllers\ordersController@cartDelete');
Route::get('/cart/update','App\Http\Controllers\ordersController@cartUpdate');

