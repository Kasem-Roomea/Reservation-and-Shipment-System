<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TripsController;

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
    return view('auth.login');
});

Auth::routes();

Route::resource('home', 'App\Http\Controllers\TripsController');

//الركاب
Route::get('/tickets/{id}', 'App\Http\Controllers\ticketsController@getTickets')->name('tickets');
Route::post('/storeTickets', 'App\Http\Controllers\ticketsController@store')->name('storeTickets');
Route::PATCH('/updateTickets', 'App\Http\Controllers\ticketsController@update')->name('updateTickets');
Route::post('/deleteTickets', 'App\Http\Controllers\ticketsController@destroy')->name('deleteTickets');
Route::post('/deleteTickets', 'App\Http\Controllers\ticketsController@destroy')->name('deleteTickets');
Route::post('/TransferTickets', 'App\Http\Controllers\ticketsController@TransferTickets')->name('TransferTickets');


//الأمانات
Route::get('/trustees/{id}', 'App\Http\Controllers\trusteesController@getTrustees')->name('trustees');
Route::post('/storeTrustees', 'App\Http\Controllers\trusteesController@store')->name('storeTrustees');
Route::PATCH('/updateTrustees', 'App\Http\Controllers\trusteesController@update')->name('updateTrustees');
Route::post('/deleteTrustees', 'App\Http\Controllers\trusteesController@destroy')->name('deleteTrustees');
Route::post('/TransferTrustees', 'App\Http\Controllers\trusteesController@TransferTrustees')->name('TransferTrustees');




//الرحل المتاحة
Route::get('/homes', 'App\Http\Controllers\TripsController@nowTrips');



//الركاب
Route::resource('driver', 'App\Http\Controllers\driversController');

//الباصات
Route::resource('micro', 'App\Http\Controllers\microsController');
