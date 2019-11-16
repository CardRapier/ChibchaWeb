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

Route::get('/', 'PackageController@show')->name('package.show');

Auth::routes(['verify' => true]);

Route::get('/hosting', 'HostingController@showAll')->name('hosting.showAll')->middleware('verified');
Route::get('/hosting/create','HostingController@create')->name('hosting.create')->middleware('verified');
Route::post('/hosting/create','HostingController@store')->name('hosting.store')->middleware('verified');
Route::get('/hosting/view/{user_id}/{hosting_id}','HostingController@view')->name('hosting.view')->middleware('verified');
Route::post('/hosting/upload','HostingController@upload')->name('hosting.upload')->middleware('verified');
Route::post('/hosting/delete','HostingController@delete')->name('hosting.delete')->middleware('verified');

Route::get('/profile', 'UserController@index')->name('profile.show')->middleware('verified');
Route::patch('/profile/update', 'UserController@update')->name('profile.update')->middleware('verified');
Route::patch('/password/change', 'UserController@update_password')->name('password.change')->middleware('verified');

Route::get('/user/payment', 'PaymentController@show_payment')->name('payment.show');
Route::patch('/payment/change', 'PaymentController@change_payment')->name('payment.change');
Route::patch('/payment/remove', 'PaymentController@remove_payment')->name('payment.remove');

Route::get('/payment/create', 'PaymentController@create_payment')->name('payment.create');
Route::post('/payment/store', 'PaymentController@store_payment')->name('payment.store');

Route::get('/domain', 'DomainController@show')->name('domain.show');
Route::post('/domain', 'DomainController@available')->name('domain.available');
Route::get('/domain/email', 'DomainController@email')->name('domain.email');
Route::post('/domain/email', 'DomainController@sendEmail')->name('domain.sendEmail');

Route::get('/user/domain', 'DomainUserController@index')->name('domain.index');