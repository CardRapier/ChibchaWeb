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

Route::post('/login/custom','LoginController@login')->name('login.custom');

Route::get('/hosting', 'HostingController@showAll')->name('hosting.showAll')->middleware('verified');

Route::get('/hosting/create','HostingController@create')->name('hosting.create')->middleware('verified');
Route::post('/hosting/create','HostingController@store')->name('hosting.store')->middleware('verified');
Route::post('/hosting/process','HostingController@process')->name('hosting.process')->middleware('verified');
Route::get('/hosting/done','HostingController@done')->name('hosting.done')->middleware('verified');
Route::get('/hosting/share/{hosting_id}','HostingController@share')->name('hosting.share')->middleware('verified');
Route::post('/hosting/share','HostingController@sharing')->name('hosting.sharing')->middleware('verified');

Route::get('/hosting/show/{user_id}/{hosting_id}','HostingController@show')->name('hosting.show')->middleware('verified');
Route::post('/hosting/upload','HostingController@upload')->name('hosting.upload')->middleware('verified');
Route::post('/hosting/delete','HostingController@delete')->name('hosting.delete')->middleware('verified');

Route::get('/profile', 'UserController@index')->name('profile.show')->middleware('verified');
Route::patch('/profile/update', 'UserController@update')->name('profile.update')->middleware('verified');
Route::patch('/password/change', 'UserController@update_password')->name('password.change')->middleware('verified');

Route::get('/domain', 'DomainController@show')->name('domain.show');
Route::post('/domain', 'DomainController@available')->name('domain.available');
Route::get('/domain/email', 'DomainController@email')->name('domain.email');
Route::post('/domain/email', 'DomainController@sendEmail')->name('domain.sendEmail');

Route::get('/contact','PackageController@contact')->name('contact.show');
Route::post('/contact','PackageController@contactEmail')->name('contact.email');

Route::get('/user/domain', 'DomainUserController@index')->name('domain.index')->middleware('verified');
Route::post('/user/domain', 'DomainUserController@register')->name('domain.register')->middleware('verified');
Route::post('/user/transfer', 'DomainUserController@transfer')->name('domain.transfer')->middleware('verified');

Route::get('/user/userTicket', 'TicketController@index')->name('ticket.index')->middleware('verified');
Route::post('/user/userTicket', 'TicketController@addTicket')->name('ticket.addTicket')->middleware('verified');
Route::get('/user/userTicket/{id}', 'TicketController@showTicket')->name('ticket.showTicket')->middleware('verified');

Route::get('/admin','AdminController@index')->name('admin.index')->middleware('admin');
Route::get('/admin/users','AdminController@showUsers')->name('admin.showUsers')->middleware('admin');
Route::get('/admin/distributor', 'DistributorController@index')->name('admin.distributor')->middleware('admin');
Route::post('/admin/distributor', 'DistributorController@addDistributor')->name('admin.addDistributor')->middleware('admin');
Route::get('/admin/tickets','AdminController@showTickets')->name('admin.showTickets')->middleware('admin');
Route::get('/admin/support/tickets','AdminController@showTicketsSupport')->name('admin.showTicketsSupport')->middleware('admin');
Route::get('/admin/editTicket/{ticketId}','AdminController@editTicket')->name('editTicket')->middleware('admin');
Route::post('/admin/tickets','AdminController@updateTicket')->name('admin.updateTicket')->middleware('admin');
Route::get('/support/editTicket/{ticketId}','AdminController@editTicketSupport')->name('editTicketSupport')->middleware('admin');
Route::post('/support/tickets','AdminController@updateTicketSupport')->name('admin.updateTicketSupport')->middleware('admin');
Route::get('/admin/users/userEdit/{id}','UserController@userEdit')->name('admin.userEdit')->middleware('admin');
Route::put('/admin/users/editUserAdmin/{id}','UserController@editUserAdmin')->name('admin.editUserAdmin')->middleware('admin');
Route::put('/admin/users/userEditPassword/{id}','UserController@userEditPassword')->name('admin.userEditPassword')->middleware('admin');
