@extends('layouts.app')

@section('content')
    <div class="container">

        <section id="post-form">

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>        
            @endif 

            
            <form action="{{route('users.apartments.store', $newAddress)}}" method="POST" enctype="multipart/form-data">
                @csrf


                <div class="mb-3">
                  <label for="descriptive_title" class="form-label">Descriptive Title</label>
                  <input type="text" class="form-control" id="descriptive_title" name="descriptive_title" value="{{old('descriptive_title', $newApartment->descriptive_title)}}">
                </div>

                <div class="mb-3">
                    <label for="country" class="form-label">Country</label>
                    <input class="form-control" id="country" name="country">{{old('country', $newAddress->country)}}>
                </div>

                <div class="mb-3">
                    <label for="region" class="form-label">Region</label>
                    <input class="form-control" id="region" name="region">{{old('region', $newAddress->region)}}>
                </div>

                <div class="mb-3">
                    <label for="province" class="form-label">Province</label>
                    <input class="form-control" id="province" name="province">{{old('province', $newAddress->province)}}>
                </div>

                <div class="mb-3">
                    <label for="city" class="form-label">City</label>
                    <input class="form-control" id="city" name="city">{{old('city', $newAddress->city)}}>
                </div>

                <div class="mb-3">
                    <label for="address" class="form-label">Address</label>
                    <input class="form-control" id="address" name="address">{{old('address', $newAddress->address)}}>
                </div>

                <div class="mb-3">
                    <label for="zip_code" class="form-label">Zip Code</label>
                    <input class="form-control" id="zip_code" name="zip_code">{{old('zip_code', $newAddress->zip_code)}}>
                </div>

                <div class="mb-3">
                    <label for="image" class="form-label">Image</label>
                    <input type="file" class="form-control" placeholder="Choose an image" id="image" name="image" value="{{old('image', $newApartment->image)}}">
                </div>

                <div class="mb-3">
                    <label for="rooms" class="form-label">Rooms</label>
                    <input type="text" class="form-control" id="rooms" name="rooms" value="{{old('rooms', $newApartment->rooms)}}">
                </div>

                <div class="mb-3">
                    <label for="beds" class="form-label">Beds</label>
                    <input type="text" class="form-control" id="beds" name="beds" value="{{old('beds', $newApartment->beds)}}">
                </div>

                <div class="mb-3">
                    <label for="bathrooms" class="form-label">Bathrooms</label>
                    <input type="text" class="form-control" id="bathrooms" name="bathrooms" value="{{old('bathrooms', $newApartment->bathrooms)}}">
                </div>

                <div class="mb-3">
                    <label for="square_meters" class="form-label">Square Meters</label>
                    <input type="text" class="form-control" id="square_meters" name="square_meters" value="{{old('square_meters', $newApartment->square_meters)}}">
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control" id="description" name="description">{{old('description', $newApartment->description)}}</textarea>
                </div>

                <div class="form-group">
                    <legend class="h5">Amenities</legend>
                    <div class="form-check form-check-inline">
                        
                        @foreach ($amenities as $amenity)
                            <input type="checkbox" class="form-check-input mx-2" 
                            id="{{ $amenity->id }}" value="{{$amenity->id}}" 
                            name="amenities[]" @if(in_array($amenity->id, old('amenities', []))) checked @endif>

                            <label class="form-check-label me-2" for="{{$amenity->id}}">{{$amenity->name}}</label>    
                        @endforeach
                    </div>
                </div>

                <div class="form-check">
                    <input class="form-check-input" type="hidden" value="0" id="visibility" name="visibility">
                    <input class="form-check-input" type="checkbox" value="1" id="visibility" name="visibility">
                    <label class="form-check-label" for="visibility">Visibile</label>
                </div>
                
                <button type="submit" class="btn btn-primary">Add your apartment</button>
            </form>
        </section>
        
    </div>
@endsection