<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

    Route::group(['prefix' => 'auth', 'as' => 'auth.'], function () {
        Route::post('registration', 'LoginController@customer_register')->name('registration');
        Route::post('store-registration', 'LoginController@store_register')->name('store-registration');
        Route::post('login', 'LoginController@customer_login')->name('login');
        Route::post('logout', 'LoginController@customer_logout')->middleware('auth:api');
        Route::post('add-boys', 'LoginController@add_boys')->name('add-boys');
        Route::post('driver-login', 'LoginController@driverLogin')->name('driver-login');
        Route::post('changePass', 'LoginController@changePass')->name('changePass');


    });
    Route::get('categories', 'ApiController@categories')->name('categories');
    Route::get('products', 'ApiController@products')->name('products');
    Route::get('get-boys/{user}', 'ApiController@getBoys')->name('get-boys');
    Route::post('delete-boys', 'ApiController@deleteBoys')->name('delete-boys');
    Route::get('productsbycat/{cat}', 'ApiController@productsbycat')->name('productsbycat');
    Route::post('buyProductForShop', 'ApiController@buyProductForShop')->name('buyProductForShop');
    Route::get('getShopProducts/{shop}', 'ApiController@getShopProducts')->name('getShopProducts');
    Route::post('delete-product', 'ApiController@deleteProduct')->name('delete-product');
    Route::get('shops', 'ApiController@getShops')->name('shops');
    Route::get('productsbyshop/{cat}/{shop}', 'ApiController@productsbyshop')->name('productsbyshop');
    Route::post('buyProductForUser', 'ApiController@buyProductForUser')->name('buyProductForUser');
    Route::get('getHistory/{user}/{type}', 'ApiController@getHistory')->name('getHistory');
    Route::get('search/{search}', 'ApiController@search')->name('search');
    Route::get('getOrders/{user}', 'ApiController@getOrders')->name('getOrders');
    Route::get('getDriverOrders/{user}', 'ApiController@getDriverOrders')->name('getDriverOrders');
    Route::post('cancelOrder', 'ApiController@cancelOrder')->name('cancelOrder');
    Route::get('blogs', 'ApiController@getBlogs')->name('blogs');
    Route::post('assign-driver', 'ApiController@assignDriver')->name('assign-driver');
    Route::post('completeOrder', 'ApiController@completeOrder')->name('completeOrder');
    Route::get('getDriverHistory/{user}', 'ApiController@getDriverHistory')->name('getDriverHistory');

Route::get('place-api-autocomplete','ApiController@place_api_autocomplete');
Route::get('distance-api','ApiController@distance_api');
Route::get('place-api-details', 'ApiController@place_api_details');
Route::get('geocode-api','ApiController@geocode_api');

