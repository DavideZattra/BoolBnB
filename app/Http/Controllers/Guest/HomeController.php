<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;
use App\Models\SponsorApartment;

class HomeController extends Controller
{
    public function home(){

        $sponsorApartments = SponsorApartment::where('end', '>', Carbon::now())->with('apartment')->get();

        return view('guests.home', compact('sponsorApartments'));    
    }

    public function search(){

        return view('guests.apartments.advanced_search');
    }
}
