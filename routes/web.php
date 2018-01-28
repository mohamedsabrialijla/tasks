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

Route::get('/', 'HomeController@index');
Route::get('/home', 'HomeController@index');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// this is route of task //

Route::get('/dashboard', 'TaskController@dashboard')->name('dashboard');

Route::get('/task', 'TaskController@index')->name('task.all');
Route::post('/task', 'TaskController@store')->name('task.store');
Route::get('/task/create', 'TaskController@create')->name('task.create');
Route::get('task/{id}/delete', 'TaskController@destroy')->name('task.destroy');
Route::get('/task/{id}/edit', 'TaskController@edit')->name('task.edit');
Route::post('/task/{id}', 'TaskController@update')->name('task.update');
