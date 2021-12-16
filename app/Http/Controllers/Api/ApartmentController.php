<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Apartment;
use App\Models\SponsorApartment;
use Illuminate\Support\Carbon;

class ApartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Apartment::where('visibility', true)->with('amenities')->with('addresses')->get();

        return response()->json($data);
    }  

    
    public function sponsored(){

        $data = SponsorApartment::where('end', '>', Carbon::now())->with('apartment')->get();

        

        return response()->json($data);
    }
    
}
