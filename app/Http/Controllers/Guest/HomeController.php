<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index() {
        return view('guest.home');
    }

    public function search() {
        return view('guests.home');
    }

    public function advancedSearch($location) {

        // $response = file_get_contents('https://api.tomtom.com/search/2/geocode/' . $location . '.json?key=NLbGYpRnYCS3jxXsynN2IfGsmEgZJJzB');

        // $response = json_decode($response);

        // $lat = $response->results[0]->position->lat;
        // $lon = $response->results[0]->position->lon;

        // $lat = json_encode($lat);
        // $lon = json_encode($lon);

        return view('guests.apartments.advanced_search')->with('location', $location);

    }
}
