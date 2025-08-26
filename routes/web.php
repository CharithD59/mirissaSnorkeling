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

Route::get('/', function () {
    return view('home');
});

Route::get('view_booking_page', 'App\Http\Controllers\PageController@view_booking_page');
Route::get('send_contact_mail', 'App\Http\Controllers\PageController@send_contact_mail');
Route::get('send_booking_mail', 'App\Http\Controllers\PageController@send_booking_mail');
Route::POST('/log-whatsapp-click', 'App\Http\Controllers\PageController@logWhatsappClick');