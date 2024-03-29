<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\LoginController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/', function () {
    return redirect('auth/login');
});
Route::group(['prefix' => 'auth', 'as' => 'auth.'], function () {
    Route::get('login',  [LoginController::class, 'login'])->name('login');
    Route::post('login', 'LoginController@admin_login');
    Route::get('logout', 'LoginController@logout')->name('logout');
});

Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::get('dashboard', 'AdminController@dashboard')->name('dashboard');
    Route::any('category', 'AdminController@category')->name('category');
    Route::any('sub-category', 'AdminController@subCategory')->name('sub-category');
    Route::get('get-subs/{id}', 'AdminController@getSubs')->name('get-subs');

    Route::post('category-store', 'AdminController@categoryStore')->name('category-store');
    Route::post('category-update/{id}', 'AdminController@categoryUpdate')->name('category-update');
    Route::delete('category-destroy/{id}', 'AdminController@categoryDestroy')->name('category-destroy');
    
      Route::any('products', 'ProductsController@index')->name('products');

    Route::get('add-products', 'ProductsController@upload')->name('add-products');
    Route::post('product-store', 'ProductsController@store')->name('product-store');
    Route::post('product-update/{id}', 'ProductsController@update')->name('product-update');
    Route::delete('product-destroy/{id}', 'ProductsController@destroy')->name('product-destroy');
    
      Route::any('blogs', 'ProductsController@blogindex')->name('blogs');

  Route::get('add-blogs', 'ProductsController@blogupload')->name('add-blogs');
    Route::post('blogs-store', 'ProductsController@blogstore')->name('blogs-store');
    Route::post('blogs-update/{id}', 'ProductsController@blogupdate')->name('blogs-update');
    Route::delete('blogs-destroy/{id}', 'ProductsController@blogdestroy')->name('blogs-destroy');
  
  
    Route::any('users', 'AdminController@users')->name('users');
    Route::delete('users-destroy/{id}', 'AdminController@usersDestroy')->name('users-destroy');
    
    
      Route::any('shops', 'AdminController@shops')->name('shops');
          Route::delete('shop-destroy/{id}', 'AdminController@shopdestroy')->name('shop-destroy');

      Route::any('requsts_shops', 'AdminController@requsts_shops')->name('requsts_shops');
    Route::post('shop-approve/{id}', 'AdminController@approveShop')->name('shop-approve');

});