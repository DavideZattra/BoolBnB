<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use App\Models\Apartment;
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
        $apartments = Apartment::orderBy('created_at','desc')->simplePaginate(6);

        return view('users.apartments.index', compact('apartments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $newApartment = new Apartment();
        $amenities = Amenity::all();

        return view('users.apartments.create', compact('newApartment', 'amenities'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            
            'descriptive_title' => 'required|string|max:120',
            'rooms' => 'numeric',
            'image' => 'image',
            'beds' => 'required|numeric',
            'bathrooms' => 'numeric',
            'square_meters' => 'numeric',
            'description' => 'required|max:120',
            // 'visibility' => 'required'
        ]);

        $data['user_id'] = Auth::user()->id;

        $data = $request->all();
        $data['image'] = Storage::put('public', $data['image']);

        $newApartment = new Apartment();

        $newApartment->fill($data);
        $newApartment->save();

        if(array_key_exists('amenities', $data)) $newApartment->amenities()->sync($data['amenities']);

        return redirect()->route('users.apartments.create', compact('newApartment'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Apartment $apartment)
    {
        return view('users.apartments.show', compact('apartment'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Apartment $apartment)
    {
        return view('users.apartments.edit', compact('apartment'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data['user_id'] = Auth::user()->id;

        $data = $request->all();
        $newApartment = new Apartment();

        $newApartment->fill($data);
        $newApartment->save();

        return redirect()->route('users.apartments.show', compact('newApartment'));
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
