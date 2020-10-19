<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::group([
    'middleware' => 'api',
], function () {
    Route::post('/logout', 'Auth\LoginController@logout');
    Route::post('/login', 'Auth\LoginController@login');

});

Route::get('/postlist', 'API\PostController@index');
Route::post('/post/search', 'API\PostController@search')->middleware('auth:api');
Route::post('/post/create', 'API\PostController@store')->middleware('auth:api');
Route::get('/post/getPost/{id}', 'API\PostController@update');
Route::post('/post/confirmupdate', 'API\PostController@updated')->middleware('auth:api');
Route::get('/post/delete/{id}', 'API\PostController@delete')->middleware('auth:api');
Route::post('/post/upload', 'API\PostController@upload')->middleware('auth:api');
Route::get('/post/download', 'API\PostController@download')->middleware('auth:api');
Route::get('/userlist', 'API\UserController@index')->middleware('auth:api');
Route::post('/user/search', 'API\UserController@search');
Route::post('/user/create', 'API\UserController@save')->middleware('auth:api');
Route::post('/user/update', 'API\UserController@updated')->middleware('auth:api');
Route::get('/user/delete/{id}', 'API\UserController@delete')->middleware('auth:api');
Route::post('/user/changepassword', 'Auth\PasswordController@update');



