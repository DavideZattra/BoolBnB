<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Apartment;
use App\Models\View;

class StatisticsController extends Controller
{
    public function apartmentStats(Apartment $apartment){

        $totalViews = View::where('apartment_id', $apartment->id)->get();
        $yearViews = View::where('apartment_id', $apartment->id)->get();
        $monthViews = View::where('apartment_id', $apartment->id)->get();
        $weekViews = View::where('apartment_id', $apartment->id)->get();
        $dayViews = View::where('apartment_id', $apartment->id)->get();

        // dd($views);

        return view('users.apartments.statistics.statistics', compact('totalViews', 'yearViews', 'monthViews', 'weekViews', 'dayViews'));
    }
}
