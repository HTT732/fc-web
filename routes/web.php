<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

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

Route::get('/', 'Client\ProductController@index')->name('home');

Route::group(['prefix' => 'client', 'namespace' => 'Client'], function () {
	Route::resource('product', 'ProductController')->only(['show']);
    
    Route::get('shopping-cart', 'CartController@index')->name('shopping-cart');
    
    Route::get('checkout', 'CartController@showCheckout')->name('checkout');
    
    Route::get('order-complete', 'CartController@showOrderComplete')->name('order-complete');
    
    Route::get('category/{slug}', 'ProductController@getProductOfCategory')->name('category');
    
    Route::get('filter', 'ProductController@filter')->name('filter');
    
    Route::get('category/{slug}/filter', 'CategoryController@filter')->name('category-filter');
    
    Route::get('order/{id}/{quanlity?}', 'OrderController@order')->name('main-page-order');
    
    Route::get('delete/{token}/{id}', 'OrderController@destroy')->name('delete');
    
    Route::post('update', 'OrderController@update')->name('update');
    
    Route::post('checkout', 'CartController@postCheckout')->name('postCheckout');
});

Route::get('login', 'LoginController@login')->name('login');
Route::post('login', 'LoginController@store')->name('login.store');
Route::get('logout', 'LoginController@logout')->name('logout');
Route::get('forgot-password', 'LoginController@forgotPassword')->name('forgot-password');
Route::post('reset-password', 'LoginController@resetPassword')->name('reset-password');

Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => 'auth'], function () {
    Route::resource('admin', 'AdminController')->only(['index', 'show', 'update', 'store']);
    Route::get('change-password', 'AdminController@changePassword')->name('change-password');

    Route::resource('product', 'ProductController', ['as'=>'admin'])->only(['index','edit', 'store', 'update','destroy', 'create']);
    
    Route::resource('category', 'CategoryController', ['as'=>'admin'])->only(['index','edit', 'store', 'create', 'destroy', 'update']);
    
    Route::resource('banner', 'SliderController', ['as'=>'admin'])->only(['index', 'store', 'destroy']);
    
    Route::resource('order', 'OrderController', ['as' => 'admin'])->only(['index', 'show', 'destroy', 'update']);

    Route::post('picture-upload', 'ProductController@pictureUpload')->name('picture-upload');
    Route::post('pciture-delete', 'ProductController@pictureDelete')->name('picture-delete');
});
