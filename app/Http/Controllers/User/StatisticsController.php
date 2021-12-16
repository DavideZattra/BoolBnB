<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

use Illuminate\Support\Facades\DB;
use App\Models\Apartment;
use App\Models\View;

class StatisticsController extends Controller
{
    public function apartmentStats(Apartment $apartment){

        $monthlyVisit = View::where('apartment_id', $apartment->id)
            ->where('visited_at', '>', Carbon::now()->subYear()->toDateTimeString())
            ->select(
                DB::raw('YEAR(visited_at) as year'),
                DB::raw('MONTH(visited_at) as month')                
            )->selectRaw('count(id) as views')
            ->groupBy('year', 'month')
            ->get(); 
        
            // dd($monthlyVisit);
        $daylyVisit = View::where('apartment_id', $apartment->id)
            ->where('visited_at', '>', Carbon::now()->subMonth()->toDateTimeString())
            ->select(
                
                DB::raw('MONTH(visited_at) as month'),
                DB::raw('DAY(visited_at) as day'),
                                
            )->selectRaw('count(id) as views')
            ->groupBy('month', 'day')
            ->get();
        // dd($daylyVisit);
        $totalViews = View::where('apartment_id', $apartment->id)->get();
        

        return view('users.statistics.apartment-statistics', compact('monthlyVisit', 'daylyVisit'));
    }
}
