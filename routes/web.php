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

Route::get('/home', 'HomeController@index')->name('home');
Route::get('add/product/view', 'ProductController@addproductview');
Route::post('add/product/insert', 'ProductController@addproductinsert');
Route::get('/delete/product/{product_id}', 'ProductController@deleteproduct');
Route::get('/edit/product/{product_id}', 'ProductController@editproduct');
Route::post('/edit/product/insert', 'ProductController@editproductinsert');
Route::get('/restore/product/{product_id}', 'ProductController@restoreproduct');
Route::get('force/delete/product/{product_id}', 'ProductController@forcedeleteproduct');
Route::get('add/category/view', 'CategoryController@addcategoryview');
Route::post('add/category/insert', 'CategoryController@addcategoryinsert');
Route::get('contact/message/view', 'HomeController@contactmessageview');
Route::get('change/menu/status/{category_id}', 'HomeController@changemenustatus');
Route::get('read/contact/message/{contact_id}', 'HomeController@readcontactmessage');

//Front end routes
Route::get('/', 'FrontendController@index');
Route::get('contact', 'FrontendController@contact');
Route::post('contact/insert', 'FrontendController@contactinsert');
Route::get('/product/details/{product_id}', 'FrontendController@productdetails'); 
Route::get('/category/wise/product/{category_id}', 'FrontendController@categorywiseproduct'); 
Route::get('/add/to/cart/{product_id}', 'FrontendController@addtocart'); 
Route::get('/cart', 'FrontendController@cart'); 
Route::get('/delete/from/cart/{cart_id}', 'FrontendController@deletefromcart'); 
Route::get('clear/cart', 'FrontendController@clearcart'); 
