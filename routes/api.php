<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Amenity;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::namespace('Api')->name("api.")->group(function(){
    
    Route::get('apartments', 'ApartmentController@index');
    Route::get('apartments/sponsored', 'ApartmentController@sponsored');
    Route::get('amenities', function () {
        $data = Amenity::all();
        return response()->json($data);
    });
});
