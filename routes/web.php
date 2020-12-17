<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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
Route::resource('products', 'ProductsController')->middleware('auth');
Route::resource('categories', 'CategoryController')->middleware('auth');
Route::resource('flavors', 'FlavorController')->middleware('auth');
Route::resource('measurements', 'MeasurementController')->middleware('auth');

Route::get('/checkout', 'PageController@checkout')->name('checkout')->middleware('auth');

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/', 'CartController@shop')->name('shop');
Route::get('/cart', 'CartController@cart')->name('cart.index');
Route::post('/add', 'CartController@add')->name('cart.store');
Route::post('/update', 'CartController@update')->name('cart.update');
Route::post('/remove', 'CartController@remove')->name('cart.remove');
Route::post('/clear', 'CartController@clear')->name('cart.clear');
