@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            {{-- Titolo e indirizzo --}}
            <div class="col-12 apartment-modify">
                <h3 class="text-uppercase font-weight-bold">{{ $apartment->descriptive_title }}</h3>
                <div class="map-link mb-3 mt-3">
                    <a href="#">
                        <i class="fas fa-map-marked-alt"></i>
                        {{ $apartment->addresses->country }}, {{ $apartment->addresses->city }}, {{ $apartment->addresses->address }}
                    </a>
                </div>
            </div>

            {{-- Sezione immagine --}}
            <div class="col-12 show-img">
                <img src="{{ $apartment->image }}" alt="immagine copertina dell'appartamento">
            </div>
            <div class="col-12 col-md-7 apartment-description mt-5">
                <h4>Description of your apartment:</h4>
                <p>{{ $apartment->description }}</p>
                <p><i class="fab fa-buromobelexperte"></i> rooms: {{ $apartment->rooms }}</p>
                <p><i class="fas fa-bed"></i> beds: {{ $apartment->beds }}</p>
                <p><i class="fas fa-restroom"></i> bathrooms: {{ $apartment->bathrooms }}</p>
                <p><i class="fas fa-home"></i> square meters: {{ $apartment->square_meters }}</p>

                <div class="hr"></div>

                <h3 class="mt-3">Servicies</h3>
                <ul>
                    @foreach ($amenities as $amenitie)
                        <li class="mt-2">{{ $amenitie }}</li>
                    @endforeach
                </ul>
            </div>
            <div class="col-12 col-md-5 mt-5 map-show">
                <img src="https://www.koribanicsandkoribanics.com/wp-content/uploads/sites/1401539/2019/11/google-map-img-small.jpg" alt="">
            </div>

            <div class="hr col-9 mt-5 mb-5"></div>

            <div class="col-12">
                <h3>Messages</h3>
            </div>




            {{-- Sezione immagini multiple da attivare se inseriamo più immagini per la show--}}
            {{-- <div class="col-12 col-md-8 show-img">
                <img src="{{ $apartment->image }}" alt="immagine copertina dell'appartamento">
            </div>
            <div class="col-md-4 d-none d-md-block show-img">
                <div class="row">
                    <div class="col-12">
                        <img src="{{ $apartment->image }}" alt="immagine dell'appartamento">
                    </div>
                </div>
                <div class="row mt-5">
                    <div class="col-12">
                        <img src="{{ $apartment->image }}" alt="immagine dell'appartamento">
                    </div>
                </div>
            </div> --}}
        </div>
    </div>

@endsection
