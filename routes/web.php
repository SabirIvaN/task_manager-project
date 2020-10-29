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

Route::get('/', 'WelcomeController@show')->name('welcome');

Route::resource('/tasks', 'TaskController');

Route::resource('/labels', 'LabelController');

Route::resource('/statuses', 'StatusController');
