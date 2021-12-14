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
    return view('guests.apartments.advanced_search');
});

Auth::routes();

// Route::get('/payment/process', 'PaymentController@process')->name('payment.process');

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

Route::namespace('User') // this is to call the folder of the controller
    ->name('users.') // this is to call the folder of the view
    ->prefix('users') // this is for the URI calls
    ->group(function () {
        
        // Route::resource('/', DashboardController::class)->except('create', 'store');
        Route::resource('apartments', ApartmentController::class)->only('show');
        Route::post('message', 'MessageController@store')->name('store');
});

Route::get('/process', function () {
    $gateway = new Braintree\Gateway([
        'environment' => config('services.braintree.environment'),
        'merchantId' => config('services.braintree.merchantId'),
        'publicKey' => config('services.braintree.publicKey'),
        'privateKey' => config('services.braintree.privateKey')
    ]);

    $token = $gateway->ClientToken()->generate();

    return view('users.dashboard', [
        'token' => $token
    ]);
});

// Route::post('/checkout', function (Request $request) {
//     $gateway = new Braintree\Gateway([
//         'environment' => config('services.braintree.environment'),
//         'merchantId' => config('services.braintree.merchantId'),
//         'publicKey' => config('services.braintree.publicKey'),
//         'privateKey' => config('services.braintree.privateKey')
//     ]);

//     $amount = $request->amount;
//     $nonce = $request->payment_method_nonce;

//     $result = $gateway->transaction()->sale([
//         'amount' => $amount,
//         'paymentMethodNonce' => $nonce,
//         'customer' => [
//             'firstName' => 'Tony',
//             'lastName' => 'Stark',
//             'email' => 'tony@avengers.com',
//         ],
//         'options' => [
//             'submitForSettlement' => true
//         ]
//     ]);

//     if ($result->success) {
//         $transaction = $result->transaction;
//         // header("Location: transaction.php?id=" . $transaction->id);

//         return back()->with('success_message', 'Transaction successful. The ID is:'. $transaction->id);
//     } else {
//         $errorString = "";

//         foreach ($result->errors->deepAll() as $error) {
//             $errorString .= 'Error: ' . $error->code . ": " . $error->message . "\n";
//         }

//         // $_SESSION["errors"] = $errorString;
//         // header("Location: index.php");
//         return back()->withErrors('An error occurred with the message: '.$result->message);
//     }
// });

// Route::get('/hosted', function () {
//     $gateway = new Braintree\Gateway([
//         'environment' => config('services.braintree.environment'),
//         'merchantId' => config('services.braintree.merchantId'),
//         'publicKey' => config('services.braintree.publicKey'),
//         'privateKey' => config('services.braintree.privateKey')
//     ]);

//     $token = $gateway->ClientToken()->generate();

//     return view('hosted', [
//         'token' => $token
//     ]);

