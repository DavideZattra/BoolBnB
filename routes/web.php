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
Auth::routes();

/**
 * Routes for the registered and logged user
 */
Route::middleware('auth')
    ->namespace('User') // this is to call the folder of the controller
    ->name('users.') // this is to call the folder of the view
    ->prefix('users') // this is for the URI calls
    ->group(function () {
    
    //Routes for the dashboard and control of the user profile
    Route::get('MyProfile', 'DashboardController@index')->name('profile');
    Route::get('MyProfile/edit', 'DashboardController@edit')->name('profile.edit');
    Route::patch('Myprofile/update', 'DashboardController@update')->name('profile.update');

    //Routes for the apartment CRUD
    Route::resource('apartments', ApartmentController::class);
    
    //routes for the sponsor
    Route::get('sponsor/{apartment}', 'PaymentController@payment')->name('braintree.payment');
    Route::post('payment/checkout/{apartment}', 'PaymentController@checkout')->name('braintree.checkout');

    //Routes for the statistics of an apartment
    Route::get('statistics/{apartment}', 'StatisticsController@apartmentStats')->name('apartment.stats');
    
});

/**
 * Routes for guest or not logged user
 */
Route::namespace('Guest')->group(function () {
        
    Route::get('/', 'HomeController@home')->name('home');
    Route::get('/home', 'HomeController@home')->name('home');
    Route::post('message', 'MessageController@store')->name('message.store');
    Route::get('/search', 'HomeController@search' )->name('apartments.search');
    
});

/**
 * Mixed use routes
 */

Route::get('apartment/{id}', 'User\ApartmentController@show')->name('guest.apartment');


