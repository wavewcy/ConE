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

Route::get('/', function () {
    return view('home-02');
});

Route::get('/cart', function () {
    return view('cart');
});

Route::get('/product-detail', function () {
    return view('product-detail');
});

Route::get('/product','App\Http\Controllers\productController@showProduct');
Route::post('/search','App\Http\Controllers\productController@searchProduct');