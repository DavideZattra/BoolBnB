<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\SponsorApartment;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home(){

        //Return all the SponsorApartment instances where the attribute ' end' is > of the datetime when the api is called with their relative apartments;
        $sponsorApartments = SponsorApartment::where('end', '>', Carbon::now())->with('apartment')->get();

        return view('guests.home', compact('sponsorApartments'));    
    }

    public function search(){

        return view('guests.apartments.advanced_search');
    }
}
