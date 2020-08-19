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

Auth::routes(['verify' => true]);

Route::get('/', 'WelcomeController@show');

Route::resource('/tasks', 'TaskController');

Route::resource('/statuses', 'StatusController');

Route::get('/home', 'HomeController@index')->name('home')->middleware('verified');
