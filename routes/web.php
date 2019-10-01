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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('edit/{user}', 'UserController@edit')->name('user.edit');
Route::get('user/{id}', 'UserController@show')->name('user.show');
Route::post('update/{id}', 'UserController@update')->name('user.update');
Route::post('add/', 'UserController@store')->name('user.store');
Route::post('delete/{id}', 'UserController@delete')->name('user.delete');
Route::get('create/', 'UserController@create')->name('user.create');
