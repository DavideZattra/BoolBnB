<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\ModelNotFoundException;

use App\User;
use App\Models\Apartment;
use App\Models\Address;
use App\Models\Amenity;
use App\Models\View;
use DateTime;
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
        $apartments = Apartment::where('user_id', Auth::user()->id)->orderBy('created_at','desc')->simplePaginate(6);

        return view('users.apartments.index', compact('apartments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Address $newAddress)
    {
        $newApartment = new Apartment();
        
        $amenities = Amenity::all();

        return view('users.apartments.create', compact('newApartment', 'amenities', 'newAddress'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Address $newAddress)
    {

        $request->validate([
            
            'descriptive_title' => 'required|string|min:15|max:150',
            'rooms' => 'required|numeric|min:1',
            'image' => 'image|mimes:jpeg,jpg,png',
            'beds' => 'required|numeric|min:1',
            'bathrooms' => 'required|numeric|min:1',
            'square_meters' => 'required|numeric|min:9',
            'description' => 'required|min:50|max:255',
            'country' => 'required|string|min:4',
            'region' => 'required|string|min:4',
            'province' => 'required|string|min:4',
            'city' => 'required|string|min:2',
            'address' => 'required|string|min:4',
            'zip_code' => 'required|numeric|min:3',

        ],
        [
            'required' => ':attribute is required',
            'numeric' => ':attribute should be a number',
            'descriptive_title.min' => 'Descriptive title must be longer than 15 characters',
            'descriptive_title.max' => 'Descriptive title should not exceed 150 characters',
            'rooms.min' => 'The apartment should have at least 1 room ',
            'image.image' => 'The apartment image should be an image',
            'image.mimes' => 'Image file format should be a .jpeg, .jpg or a .png',
            'beds:min' => 'The apartment should have at least 1 bed ',
            'bathrooms.min' => 'The apartment should have at least 1 bathroom ',
            'square_meters' => 'The apartment should be bigger than 9 meters ', 
            'description.min' => 'Apartment description should be longer than 50 characters to increase attractiveness',
            'description.max' => 'Apartment description should not be longer than 255 characters ',
            'country.min' => 'Country attribute should be long at least 4 characters',
            'region.min' => 'Region attribute should be long at least 4 characters',
            'province.min' => 'Province attribute should be long at least 4 characters',
            'city.min' => 'City attribute should be long at least 2 characters',
            'address.min' => 'Address attribute should be long at least 4 characters',
            'zip_code.min' => 'Zip code attribute should be at least a 3 digit number',


        ]);

        $data = $request->all();

        $apiQuery = str_replace(' ', '-', $data['country']) . '-' .  str_replace(' ', '-', $data['region']) . '-' .  str_replace(' ', '-', $data['city']) . '-' .  str_replace(' ', '-', $data['address']) ;
        $response = file_get_contents('https://api.tomtom.com/search/2/geocode/' . $apiQuery . '.json?key=NLbGYpRnYCS3jxXsynN2IfGsmEgZJJzB');
        $response = json_decode($response);
        
        $data['user_id'] = Auth::user()->id;
        $data['image'] = Storage::put('apartment-images', $data['image']);
        $data['lat'] = $response->results[0]->position->lat;
        $data['lon'] = $response->results[0]->position->lon;
        

        $newApartment = new Apartment();

        $newApartment->fill($data);
        $newApartment->save();
        
        $newAddress = new Address();

        $newAddress->fill($data);
        $newAddress['apartment_id'] = $newApartment['id'];

        $newAddress->save();

        $apartment = $newApartment;

        if(array_key_exists('amenities', $data)) $newApartment->amenities()->sync($data['amenities']);
        
        return redirect()->route('users.apartments.show', compact('apartment'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $apartment)
    {
        $apartment = Apartment::findOrFail($apartment);
        // dd($apartment);
        
        // data to get the array of view il the last 8 hours
        $clientView = View::where('apartment_id', $apartment->id)
        ->where('ip_address', $request->ip())
        ->where('created_at', '>', Carbon::now()->subHours(8)->toDateTimeString())->get(); 
        
        $amenities = $apartment->amenities->pluck('name')->toArray();
        
        $messages = $apartment->messages->toArray();

        if (Auth::user() && Auth::user()->id == $apartment->user_id):

            return view('users.apartments.show', compact('apartment', 'amenities', 'messages'));

        elseif (!count($clientView) ): 

            $data['ip_address'] = $request->ip();
            $data['apartment_id'] = $apartment->id;
            $data['visited_at'] = date("Y-m-d H:i:s");

            $newView = new View();
            $newView->fill($data);
            
            $newView->save();

            return view('users.apartments.show', compact('apartment', 'amenities', 'messages'));

        else:
            
            return view('users.apartments.show', compact('apartment', 'amenities', 'messages'));
        endif;
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Apartment $apartment)
    {
        $amenities = Amenity::all();
        $address = $apartment->addresses;

        return view('users.apartments.edit', compact('apartment', 'amenities', 'address'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $id, Apartment $apartment)
    {

        $request->validate([
            
            'descriptive_title' => 'required|string|min:15|max:150',
            'rooms' => 'required|numeric|min:1',
            'image' => 'image|mimes:jpeg,jpg,png',
            'beds' => 'required|numeric|min:1',
            'bathrooms' => 'required|numeric|min:1',
            'square_meters' => 'required|numeric|min:9',
            'description' => 'required|min:50|max:255',
            'country' => 'required|string|min:4',
            'region' => 'required|string|min:4',
            'province' => 'required|string|min:2',
            'city' => 'required|string|min:2',
            'address' => 'required|string|min:4',
            'zip_code' => 'required|numeric|min:3',

        ],
        [
            'required' => ':attribute is required',
            'numeric' => ':attribute should be a number',
            'descriptive_title.min' => 'Descriptive title must be longer than 15 characters',
            'descriptive_title.max' => 'Descriptive title should not exceed 150 characters',
            'rooms.min' => 'The apartment should have at least 1 room ',
            'image.image' => 'the apartment image should be an image',
            'image.mimes' => 'Image file format should be a .jpeg, .jpg or a .png',
            'beds:min' => 'The apartment should have at least 1 bed ',
            'bathrooms.min' => 'The apartment should have at least 1 bathroom ',
            'square_meters' => 'The apartment should be bigger than 9 meters ', 
            'description.min' => 'apartment description should be longer than 50 characters to increase attractiveness',
            'description.max' => 'apartment description should not be longer than 255 characters ',
            'country.min' => 'Country attribute should be long at least 4 characters',
            'region.min' => 'Region attribute should be long at least 4 characters',
            'province.min' => 'Province attribute should be long at least 4 characters',
            'city.min' => 'City attribute should be long at least 2 characters',
            'address.min' => 'Address attribute should be long at least 4 characters',
            'zip_code.min' => 'Zip code attribute should be at least a 3 digit number',


        ]);
        
        $data['user_id'] = Auth::user()->id;

        $data = $request->all();
        
        if(array_key_exists('image', $data)){

            $data['image'] = Storage::put('apartment-images', $data['image']);
        }
        
        $apartment->fill($data);

        $apartment->update();

        $address = $apartment->addresses;
        $address->fill($data); 
        $address->update();
        
        if(array_key_exists('amenities', $data)) $apartment->amenities()->sync($data['amenities']);
        return redirect()->route('users.apartments.show', compact('apartment'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Apartment $apartment)
    {
        $apartment->delete();

        return redirect()->route('users.apartments.index')->with('alert-message', " '$apartment->descriptive_title ' has been deleted");
    }
}
