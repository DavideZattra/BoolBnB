<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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
    return view('guests.home');
});

Route::get('/search', function () {
    return view('guests.apartments.advanced_search')->name('search');
});

Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');

Route::middleware('auth')
    ->namespace('User') // this is to call the folder of the controller
    ->name('users.') // this is to call the folder of the view
    ->prefix('users') // this is for the URI calls
    ->group(function () {
        Route::get('/', 'DashboardController@index')->name('dashboard');
        Route::get('/edit', 'DashboardController@edit')->name('edit');
        Route::patch('/update', 'DashboardController@update')->name('update');
        // Route::resource('/', DashboardController::class)->except('create', 'store');
        Route::resource('apartments', ApartmentController::class);
});

