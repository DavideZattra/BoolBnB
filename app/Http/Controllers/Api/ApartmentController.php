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
    public function index(){
        //Return the array of apartments where the visibility value is truewith their amenities and adress;
        $data = Apartment::where('visibility', true)->with('amenities')->with('addresses')->get();

        return response()->json($data);
    }  

    
    public function sponsored(){

        //Return all the sponsor apartment instances where the attribute ' end' is > of the datetime when the api is called with their relative apartments;
        $data = SponsorApartment::where('end', '>', Carbon::now())->with('apartment')->get();

        return response()->json($data);
    }
    
}
