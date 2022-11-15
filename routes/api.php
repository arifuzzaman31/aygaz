<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\OrderController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => '/user'], function () {
    Route::get('/cylinders/show', ['uses' => 'OrdersController@cylinderList', 'as' => 'cylinders-show']);
    Route::post('/order/store', ['uses' => 'OrdersController@storeOrder', 'as' => 'cylinders-order']);
});

Route::post('/cms', ['uses' => 'CmsController@cms', 'as' => 'cms']);
Route::post('/cmsMulti', ['uses' => 'CmsController@cmsMulti', 'as' => 'cmsMulti']);


Route::post('/dealership_opportunity', ['uses' => 'CylinderController@dealership_View', 'as' => 'dealership_opportunity']);


Route::post('/create/ContactUs', ['uses' => 'ContactController@CreateContactUs', 'as' => 'ContactUs']);
Route::get('/auto_gas/show', ['uses' => 'AutogasController@show', 'as' => 'auto_gas-show']);

Route::post('/all/news/blog', ['uses' => 'NewsController@ShowBlogs', 'as' => 'NewsBlog-show']); //change method post
Route::post('/latest/news/blog', ['uses' => 'NewsController@latestBlog', 'as' => 'latestBlog']); //Change Method
Route::post('/news/blog/by/category', ['uses' => 'NewsController@ShowBlogsbyCategory', 'as' => 'NewsBlog-byCategory']);
Route::post('/news/blog/detail', ['uses' => 'NewsController@ShowBlog_single', 'as' => 'NewsBlog-show-single']);

Route::post('/show/categories', ['uses' => 'NewsController@ShowCategories', 'as' => 'show-Category']); //change methdo

// Only for Admin
Route::post('/deleteMulti', ['uses' => 'CmsController@deleteMulti', 'as' => 'deleteMulti']);
Route::post('/createMultiCMS', ['uses' => 'CmsController@createMultiCMS', 'as' => 'createMultiCMS']);
