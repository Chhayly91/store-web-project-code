<?php

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

Auth::routes();

Route::get('/', 'HomeController@index')->name('index');
//Route::get('invoice/create',function (){
//    return view('order/create');
//});

Route::get('/product/create', 'ProductController@index')->name('product.create');
Route::post('/product/create', 'ProductController@create')->name('product.create');

Route::get('/product/list', 'ProductController@list')->name('product.list');
Route::get('/product/delete/{id}', 'ProductController@deleteProduct')->name('product.delete');

Route::post('/product/edit','ProductController@editProduct')->name('product.edit');
Route::post('/product/update', 'ProductController@updateProduct')->name('product.update');

Route::get('/product/search', 'ProductController@searchTerm')->name('product.search');
//Route::post('/product/search', 'ProductController@ajaxReadData')->name('product.search');

Route::get('/order/create','OrderController@index')->name('order.create');
Route::post('/order/create', 'OrderController@create')->name('order.create');
Route::get('/order/list','OrderController@list')->name('order.list');
Route::get('/order/search','OrderController@searchTerm')->name('order.search');
Route::get('/order/update/{id}','OrderController@update')->name('order.update');
Route::post('/order/update', 'OrderController@processUpdate')->name('order.processUpdate');
Route::post('/order/delete_item', 'OrderController@delete_item');
Route::get('/order/list/delete/{id}', 'OrderController@delete')->name('order.delete');
Route::get('/order/list/print/{id}', 'OrderController@print')->name('order.print');
Route::get('/order/list/view/{id}', 'OrderController@inv_view')->name('order.view');

Route::get('/customer/create','CustomerController@index')->name('customer.create');
Route::post('/customer/create','CustomerController@create')->name('customer.create');
Route::get('/customer/list', 'CustomerController@list')->name('customer.list');
Route::get('/customer/delete/{id}', 'CustomerController@delete')->name('customer.delete');
Route::post('/phone_number/delete','CustomerController@deletePhone');
Route::post('/customer/edit', 'CustomerController@edit');
Route::post('/customer/update','CustomerController@update');

Route::get('/report/create','ReportController@create')->name('report.create');
Route::post('/report/create','ReportController@filter')->name('report.create');
Route::post('/report/create/print_report','ReportController@print_filter')->name('report.print');
Route::get('/report/create/print_report', function () {
    // authentication this route because it doesn't pass to Controller
    //normally Controller make auth for routes
})->middleware('auth');

//Route::get('/home', 'HomeController@test')->name('home');
