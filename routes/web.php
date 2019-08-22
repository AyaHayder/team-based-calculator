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

Auth::routes();

Route::resource('/','TicketController')->names(['store'=>'make.ticket']);

Route::resource('/home', 'TicketController')->names(['index'=>'home','store'=>'make.ticket']);

Route::get('/dashboard','DashboardController@index')->name('dashboard');

Route::resource('dashboard/admin','AdminController')->names(['store'=>'add.user', 'update'=>'update.user', 'destroy'=>'delete.user']);

Route::post('/dashboard/add' , 'DashboardController@addValue')->name('add.value');

Route::post('/dashboard/subtract', 'DashboardController@subtractValue')->name('subtract.value');

Route::post('/dashboard/multiply','DashboardController@multiplyValue')->name('multiply.value');

Route::post('/dashboard/divide','DashboardController@divideValue')->name('divide.value');

Route::post('/dashboard/approve', 'DashboardController@approveValue')->name('approve.value');


