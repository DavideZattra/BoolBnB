@extends('layouts.app')

@section('content')
    <div class="container">

        <section id="post-form">

            {{-- @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>        
            @endif --}}

            <form action="{{route('users.apartments.update', $apartment)}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')


                <div class="mb-3">
                  <label for="descriptive_title" class="form-label">Descriptive Title</label>
                  <input type="text" class="form-control" id="descriptive_title" name="descriptive_title" value="{{old('descriptive_title', $apartment->descriptive_title)}}">
                </div>

                <div class="mb-3">
                    <label for="rooms" class="form-label">Rooms</label>
                    <input type="text" class="form-control" id="rooms" name="rooms" value="{{old('rooms', $apartment->rooms)}}">
                </div>

                <div class="mb-3">
                    <label for="beds" class="form-label">Beds</label>
                    <input type="text" class="form-control" id="beds" name="beds" value="{{old('beds', $apartment->beds)}}">
                </div>

                <div class="mb-3">
                    <label for="bathrooms" class="form-label">Bathrooms</label>
                    <input type="text" class="form-control" id="bathrooms" name="bathrooms" value="{{old('bathrooms', $apartment->bathrooms)}}">
                </div>

                <div class="mb-3">
                    <label for="square_meters" class="form-label">Square Meters</label>
                    <input type="text" class="form-control" id="square_meters" name="square_meters" value="{{old('square_meters', $apartment->square_meters)}}">
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control" id="description" name="description">{{old('description', $apartment->description)}}</textarea>
                </div>

                <div class="form-group">
                    <legend class="h5">Amenities</legend>
                    <div class="form-check form-check-inline">
                        
                        @foreach ($amenities as $amenity)
                            <input type="checkbox" class="form-check-input mx-2" 
                            id="{{ $amenity->id }}" value="{{$amenity->id}}" 
                            name="amenities[]" @if(in_array($amenity->id, old('amenities', $apartment->amenities->pluck('id')->toArray()))) checked @endif> 
                            <label class="form-check-label me-2" for="{{$amenity->id}}">{{$amenity->name}}</label>    
                        @endforeach
                    </div>
                </div>

                <div class="form-check">
                    <input class="form-check-input" type="hidden" value="0" id="visibility" name="visibility">
                    <input class="form-check-input" type="checkbox" value="1" id="visibility" name="visibility">
                    <label class="form-check-label" for="visibility">Visibile</label>
                </div>
                
                <button type="submit" class="btn btn-primary">Edit your apartment</button>
            </form>
        </section>
        
    </div>
@endsection