<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use App\User;
use App\Models\Apartment;
use App\Models\Address;
use App\Models\Amenity;


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
            
            'descriptive_title' => 'required|string|max:150',
            'rooms' => 'required|numeric',
            'image' => 'image',
            'beds' => 'required|numeric',
            'bathrooms' => 'required|numeric',
            'square_meters' => 'required|numeric',
            'description' => 'required|max:250'
        ]);

        $data['user_id'] = Auth::user()->id;

        $data = $request->all();
        $data['image'] = Storage::put('public', $data['image']);

        $newApartment = new Apartment();

        $newApartment->fill($data);
        $newApartment->save();
        
        $newAddress = new Address();

        $newAddress->fill($data);
        $newAddress['apartment_id'] = $newApartment['id'];
        $newAddress->save();

        if(array_key_exists('amenities', $data)) $newApartment->amenities()->sync($data['amenities']);
        
        return redirect()->route('users.apartments.create', compact('newApartment', 'newAddress'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Apartment $apartment)
    {
        $amenities = $apartment->amenities->pluck('name')->toArray();

        $messages = $apartment->messages->toArray();

        return view('users.apartments.show', compact('apartment', 'amenities', 'messages'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Apartment $apartment, Address $address)
    {
        $amenities = Amenity::all();
        $address = Address::all()->pluck('id')->where('id', '=', 'apartment_id');
        return view('users.apartments.edit', compact('apartment', 'amenities', 'address'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $id, Apartment $apartment, Address $address)
    {

        $request->validate([
            
            'descriptive_title' => 'required|string|max:150',
            'rooms' => 'required|numeric',
            'image' => 'image',
            'beds' => 'required|numeric',
            'bathrooms' => 'required|numeric',
            'square_meters' => 'required|numeric',
            'description' => 'required|string|max:250'
        ]);
        
        $data['user_id'] = Auth::user()->id;

        $data = $request->all();
        
        $apartment->fill($data);
        $apartment->update();

        $address->fill($data); 
        $address->update();
        

        return redirect()->route('users.apartments.create', compact('apartment', 'address'));
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
