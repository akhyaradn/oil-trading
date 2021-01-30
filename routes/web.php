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

Route::get('/', function(){
    return view("index2");
});

// Product & service
Route::prefix('cms')->group(function(){
    Route::get('product-service/{flag?}', 'App\Http\Controllers\CMS\ProductServiceController@productServiceList')->name('productServiceList');
    Route::get('product-service/detail/{id?}', 'App\Http\Controllers\CMS\ProductServiceController@formData')->name("formProductService");
    Route::post('product-service/submit/{id?}', 'App\Http\Controllers\CMS\ProductServiceController@submitProductService')->name("submitProductService");
    Route::post('product-service/delete/{id?}', 'App\Http\Controllers\CMS\ProductServiceController@deleteProductService')->name('deleteProductService');
    Route::post('datatable-product-service', 'App\Http\Controllers\CMS\ProductServiceController@datatableProductService')->name('datatableProductService');

    // News
    Route::get('news/{flag?}', 'App\Http\Controllers\CMS\NewsController@newsList')->name('newsList');
    Route::get('news/detail/{id?}', 'App\Http\Controllers\CMS\NewsController@formData')->name('formNews');
    Route::post('news/submit/{id?}', 'App\Http\Controllers\CMS\NewsController@submitNews')->name('submitNews');
    Route::post('news/delete/{id?}', 'App\Http\Controllers\CMS\NewsController@deleteNews')->name('deleteNews');
    Route::post('datatable-news', 'App\Http\Controllers\CMS\NewsController@datatableNews')->name('datatableNews');
});