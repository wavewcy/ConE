<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth as FacadesAuth;
use Auth;

//home
Route::get('/', function () {
    return view('index');
});
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//login
// Auth::routes();

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
Route::post('/product-detail','App\Http\Controllers\productController@productDetail');
Route::post('/product-detail/addToCart','App\Http\Controllers\ordersController@addToCart');
Route::post('/search','App\Http\Controllers\productController@searchProduct');
//order
Route::get('/cart','App\Http\Controllers\ordersController@cart');
Route::get('/cart/delete','App\Http\Controllers\ordersController@cartDelete');
Route::get('/cart/update','App\Http\Controllers\ordersController@cartUpdate');
Route::get('/cart/delivery','App\Http\Controllers\ordersController@cartDelivery');
Route::get('/cart/self','App\Http\Controllers\ordersController@cartSelf');
Route::get('/reorder','App\Http\Controllers\ordersController@reorder');
//admin
Route::get('/admin','App\Http\Controllers\adminController@adminMenu');
Route::get('/customerList','App\Http\Controllers\adminController@customerList');
Route::get('/adminQuotation','App\Http\Controllers\adminController@quotation');
Route::get('/adminQuotation/created','App\Http\Controllers\adminController@createQuotation');
Route::get('/adminQuotation/cancel','App\Http\Controllers\adminController@cancel');
Route::get('/adminQuotation/confirm','App\Http\Controllers\adminController@confirm');
Route::get('/adminQuotation/bargain','App\Http\Controllers\adminController@bargain');
Route::get('/adminQuotation/paymentCancel','App\Http\Controllers\adminController@paymentCancel');
Route::get('/adminQuotation/paymentConfirm','App\Http\Controllers\adminController@paymentConfirm');
// pdf
Route::get('/pdf','App\Http\Controllers\adminController@ViewPdf');
// Route::get('/pdf', function () {
    // return view('admin/QuotationPdf');
// });

// test
Route::get('/test', function () {
    return view('product/test');
});
// customer
Route::get('/customer','App\Http\Controllers\QuotationController@Qconfirm');
Route::get('/confirm','App\Http\Controllers\QuotationController@QuotationConfirm');
Route::get('/cancel','App\Http\Controllers\QuotationController@QuotationCancel');
Route::get('/evidence','App\Http\Controllers\QuotationController@ViewEvi');
Route::post('/upload','App\Http\Controllers\QuotationController@UploadFile');
Route::get('/history','App\Http\Controllers\ordersController@history');

Route::get('/forloop','App\Http\Controllers\ordersController@forloop');
