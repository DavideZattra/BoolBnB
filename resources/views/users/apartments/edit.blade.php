@extends('layouts.app')

@section('content')
<section id="apartment-form" class="p-3">
    <div class="container">
        <h4>Insert your apartment's info.</h4>

        <div class="create-edit-wrapper p-3">
            <div class="container create-container">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>        
                @endif 

                <form action="{{route('users.apartments.update', $apartment)}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
    
                    <div>
                        <label for="descriptive_title" class="form-label">Descriptive Title</label>
                        <input type="text" class="form-control" id="descriptive_title" name="descriptive_title" value="{{old('descriptive_title', $apartment->descriptive_title)}}">
                    </div>
    
                    <div class="row mt-4 ml-2">
                        <div class="form-check col-6">
                            <input class="form-check-input" type="hidden" value="0" id="visibility" name="visibility">
                            <input class="form-check-input" type="checkbox" value="1" id="visibility" name="visibility">
                            <label class="form-check-label yellow-label" for="visibility">Check this if you want your apartment to be visibile</label>
                        </div>
                
                        <div class="form-group col-6">
                            <div class="dropdown">
    
                                <button class="btn btn-custom dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Choose your amenities
                                </button>
    
                                <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                                    <button class="dropdown-item" type="button">
                                        @foreach ($amenities as $amenity)
                                            <div>
                                                <input type="checkbox" class="form-check-input" id="{{ $amenity->id }}" value="{{$amenity->id}}" name="amenities[]" 
                                                    @if(in_array($amenity->id, old('amenities', []))) checked @endif>
                                                <label class="form-check-label me-2" for="{{$amenity->id}}">{{$amenity->name}}</label>    
                                            </div>
                                        @endforeach
                                    </button>
                                </div>
    
                            </div>
    
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <div class="form-check form-check-inline">
                                    @foreach ($amenities as $amenity)
                                        <input type="checkbox" class="form-check-input mx-2" 
                                        id="{{ $amenity->id }}" value="{{$amenity->id}}" 
                                        name="amenities[]" @if(in_array($amenity->id, old('amenities', $apartment->amenities->pluck('id')->toArray()))) checked @endif> 
                                        <label class="form-check-label me-2" for="{{$amenity->id}}">{{$amenity->name}}</label>    
                                    @endforeach
                                </div>
                            </div>
    
                        </div>
                    </div>
    
                    <div class="row mt-3">
                        <div class="col-6">
                            <label for="image" class="form-label">Image</label>
                            <input type="file" class="form-control" placeholder="Choose an image" id="image" name="image" value="{{old('image', $apartment->image)}}">
                        </div>
                        
                        <div class="col-6">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" id="description" name="description">{{old('description', $apartment->description)}}</textarea>
                        </div>
                    </div>
    
                    <div class="row mt-3">
                        <div class=" col-6">
                            <label for="country" class="form-label">Country</label>
                            <input class="form-control" id="country" name="country" value="{{old('country', $address->country)}}">
                        </div>
    
                        <div class=" col-6">
                            <label for="region" class="form-label">Region</label>
                            <input class="form-control" id="region" name="region" value="{{old('region', $address->region)}}">
                        </div>
                    </div>
    
                    <div class="row mt-3">
                        <div class=" col-6">
                            <label for="province" class="form-label">Province</label>
                            <input class="form-control" id="province" name="province" value="{{old('province', $address->province)}}">
                        </div>
        
                        <div class=" col-6">
                            <label for="city" class="form-label">City</label>
                            <input class="form-control" id="city" name="city" value="{{old('city', $address->city)}}">
                        </div>
                    </div>
    
                    <div class="row mt-3">
                        <div class=" col-6">
                            <label for="address" class="form-label">Address</label>
                            <input class="form-control" id="address" name="address" value="{{old('address', $address->address)}}">
                        </div>
        
                        <div class=" col-6">
                            <label for="zip_code" class="form-label">Zip Code</label>
                            <input class="form-control" id="zip_code" name="zip_code" value="{{old('zip_code', $address->zip_code)}}">
                        </div>
                    </div>
    
                    <div class="row mt-3">
                        <div class=" col-6">
                            <label for="rooms" class="form-label">Rooms</label>
                            <input type="text" class="form-control" id="rooms" name="rooms" value="{{old('rooms', $apartment->rooms)}}">
                        </div>
        
                        <div class=" col-6">
                            <label for="beds" class="form-label">Beds</label>
                            <input type="text" class="form-control" id="beds" name="beds" value="{{old('beds', $apartment->beds)}}">
                        </div>
                    </div>
    
                    <div class="row mt-3">
                        <div class=" col-6">
                            <label for="bathrooms" class="form-label">Bathrooms</label>
                            <input type="text" class="form-control" id="bathrooms" name="bathrooms" value="{{old('bathrooms', $apartment->bathrooms)}}">
                        </div>
        
                        <div class=" col-6">
                            <label for="square_meters" class="form-label">Square Meters</label>
                            <input type="text" class="form-control" id="square_meters" name="square_meters" value="{{old('square_meters', $apartment->square_meters)}}">
                        </div>
                    </div>
                </form>

                <button type="submit" class="btn btn-custom mt-5">Edit your apartment.</button>
            </div>
        </div>
        <a href="{{ route('users.apartments.index') }}"><h4>Click here to go back to your apartments.</h4></a>
    
    </div>
</section>
@endsection