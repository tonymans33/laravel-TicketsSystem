<?php

use Illuminate\Support\Facades\Route;

/*routes for pages controller*/
////////index page
Route::get('/', 'PagesController@index')->name('index');
///////login page
Route::get('/getIn' , 'PagesController@getIn')->name('getIn');
/////language route
Route::get('locale/{locale}', 'PagesController@locale')->name('locale');


/*routes for admin controller*/
////////////add
Route::get('/createAdmin', 'AdminController@createAdmin')->name('createAdmin');
Route::post('/storeAdmin', 'AdminController@storeAdmin')->name('storeAdmin');
///////////login
Route::post('/login', 'AdminController@login')->name('login');
//////////logout
Route::get('/logout', 'AdminController@logout')->name('logout');
////////update user data
Route::get('/updateData', 'AdminController@updateData')->name('updateData');
Route::post('/update', 'AdminController@update')->name('update');



/*routes for tickets controller*/
Route::get('/home', 'TicketController@home')->name('home');
/////////////add
Route::get('/createTicket' , 'TicketController@createTicket')->name('createTicket');
Route::post('/store', 'TicketController@store')->name('store');
/////////////edit
Route::get('/edit/{id}', 'TicketController@edit')->name('edit');
Route::post('/update/{id}', 'TicketController@update')->name('update');
/////////////show
Route::get('/open/{id}', 'TicketController@open')->name('open');
////////////delete
Route::get('/delete/{id}', 'TicketController@delete')->name('delete');
Route::post('/deleteTicket/{id}', 'TicketController@deleteTicket')->name('deleteTicket');
///////////filter
Route::post('/filter', 'TicketController@filter')->name('filter');







