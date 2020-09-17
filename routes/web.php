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
Route::get('/', 'Post\PostController@index');
Auth::routes();

Route::group(['prefix' => 'posts'], function() {
    Route::get('/', 'Post\PostController@index')->name('posts#index');
    Route::post('search', 'Post\PostController@search')->name('posts#search');
    Route::get('addpost', 'Post\PostController@create')->name('posts#create')->middleware('auth');
    Route::post('confirmcreate', 'Post\PostController@confirmCreate')->name('posts#confirmCreate')->middleware('auth');
    Route::post('store', 'Post\PostController@store')->name('posts#store')->middleware('auth');
    Route::get('{id}/delete','Post\PostController@delete')->name('posts#delete')->middleware('auth');
    Route::get('{id}/updatepost', 'Post\PostController@update')->name('posts#update')->middleware('auth');
    Route::post('{id}/confirmupdatepost', 'Post\PostController@confirmUpdate')->name('posts#confirmUpdate')->middleware('auth');
    Route::post('{id}/updated', 'Post\PostController@updated')->name('posts#updated')->middleware('auth');
    Route::get('uploadcsv', 'Post\PostController@showUpload')->name('posts#showUpload')->middleware('auth');
    Route::get('upload', 'Post\PostController@upload')->name('posts#upload')->middleware('auth');
    Route::post('upload', 'Post\PostController@upload')->name('posts#upload')->middleware('auth');
    Route::get('download', 'Post\PostController@download')->name('posts#download')->middleware('auth');
});

Route::middleware('can:isAdmin')->prefix('users')->group(function () {
    Route::get('/', 'User\UserController@index')->name('users#index');
    Route::post('search', 'User\UserController@search')->name('users#search');
    Route::get('addUser', 'User\UserController@create')->name('users#create')->middleware('auth');
    Route::post('confirmcreate', 'User\UserController@confirmCreate')->name('users#confirmCreate')->middleware('auth');
    Route::post('store', 'User\UserController@save')->name('users#save')->middleware('auth');
    Route::get('{id}/delete', 'User\UserController@delete')->name('users#delete')->middleware('auth');
});

Route::group(['prefix' => 'users'],function ()  {
    Route::get('profile', 'User\UserController@profile') -> name('users#profile') -> middleware('auth');
    Route::get('{id}/edit', 'User\UserController@edit')->name('users#edit')->middleware('auth');
    Route::post('{id}/confirmedit', 'User\UserController@confirmEdit')->name('users#confirmEdit')->middleware('auth');
    Route::post('{id}/updated', 'User\UserController@updated')->name('users#updated')->middleware('auth');
});

Route::group(['profix'=> 'password'], function() {
    Route::get('{id}/reset', 'Auth\PasswordController@edit')->name('password#edit')->middleware('auth');
    Route::post('{id}/update', 'Auth\PasswordController@update')->name('password#update')->middleware('auth');
});

Route::get('/home', 'HomeController@index')->name('home');
