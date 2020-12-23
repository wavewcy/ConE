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


Route::get('/product', function () {
    return view('product');
});

Route::get('/cart','App\Http\Controllers\ordersController@cart');
Route::get('/cart/delete','App\Http\Controllers\ordersController@cartDelete');

// Route::post('/product-detail', function () {
//     return view('product/product-detail');
// });

// Product
Route::get('/product','App\Http\Controllers\productController@showProduct');
Route::post('/product-detail','App\Http\Controllers\productController@productDetail');
Route::post('/product-detail/addToCart','App\Http\Controllers\ordersController@addToCart');
Route::post('/search','App\Http\Controllers\productController@searchProduct');
