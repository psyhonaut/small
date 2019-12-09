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

Route::get('/', 'HomeController@index')->name('home');

Route::resource('ticket', 'TicketController')
  ->only(['create', 'store', 'show', 'storeReply'])
  ->names('ticket');

Route::resource('ticketReply', 'TicketReplyController')
  ->only(['store'])
  ->names('ticketReply');
