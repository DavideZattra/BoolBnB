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

            <form action="{{route('users.apartments.store')}}" method="POST">
                @csrf


                <div class="mb-3">
                  <label for="descriptive_title" class="form-label">Descriptive Title</label>
                  <input type="text" class="form-control" id="descriptive_title" name="descriptive_title" value="{{old('title', $newApartment->descriptive_title)}}">
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
                
                <button type="submit" class="btn btn-primary">Add your apartment</button>
            </form>
        </section>
        
    </div>
@endsection