<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Models\SponsorApartment;
use Illuminate\Support\Carbon;


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
    $sponsorApartments = SponsorApartment::where('end', '>', Carbon::now())->with('apartment')->get();
    return view('guests.home', compact('sponsorApartments'));
});

Route::get('/search', function () {
    return view('guests.apartments.advanced_search');
});

Route::get('/home', 'Guest\HomeController@index')->name('home');

Auth::routes();

Route::middleware('auth')
    ->namespace('User') // this is to call the folder of the controller
    ->name('users.') // this is to call the folder of the view
    ->prefix('users') // this is for the URI calls
    ->group(function () {

        Route::get('/', 'DashboardController@index')->name('dashboard');
        Route::get('/edit', 'DashboardController@edit')->name('edit');
        Route::patch('/update', 'DashboardController@update')->name('update');

        Route::resource('apartments', ApartmentController::class);
        
        Route::get('/{apartment}/payment', 'PaymentController@payment')->name('braintree.payment');

        Route::post('payment/checkout/{apartment}', 'PaymentController@checkout')->name('braintree.checkout');
        Route::get('{apartment}/statistics', 'StatisticsController@apartmentStats')->name('apartments.stats');
});

Route::namespace('User') // this is to call the folder of the controller
    ->name('users.') // this is to call the folder of the view
    ->prefix('users') // this is for the URI calls
    ->group(function () {
        
        // Route::resource('/', DashboardController::class)->except('create', 'store');
        Route::resource('apartments', ApartmentController::class)->only('show');
        Route::post('message', 'MessageController@store')->name('store');
});