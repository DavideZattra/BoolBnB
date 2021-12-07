@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            {{-- Titolo e indirizzo --}}
            <div class="col-12">
                <h3 class="text-uppercase font-weight-bold mb-3 mt-3">{{ $apartment->descriptive_title }}</h3>
                <h3 class="text-uppercase font-weight-bold mb-3 mt-3">{{ $apartment->descriptive_title }}</h3>
                <div class="map-link mb-3 mt-3">
                    <a href="#">
                        <i class="fas fa-map-marked-alt"></i>
                        {{ $apartment->addresses->country }}, {{ $apartment->addresses->city }}, {{ $apartment->addresses->address }}
                    </a>
                </div>
            </div>
            {{-- Sezione immagini --}}
            <div class="col-12 col-md-8 show-img">
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
            </div>
        </div>
    </div>





    <div class="container">
        <div class="col-12">
            <h3 class="text-right">
            <a href="{{ route('users.apartments.index') }}">Torna a apartments</a>
            </h3>
        </div>
        <div class="card col-12">
            <div class="card-body">
                <h5 class="card-title text-uppercase font-weight-bold mb-4">{{ $apartment->descriptive_title }}</h5>
                <h6 class="card-subtitle mb-2 text-muted">{{ $apartment->rooms }}</h6>
                <img class="show-copertina" src="{{ $apartment->image }}" alt="Copertina di {{ $apartment->descriptive_title }}">
                <p class="card-text">{{ $apartment->description }}</p>
                <div class="d-flex">
                    <a href="{{ route('users.apartments.edit', $apartment) }}" class="btn btn-primary mr-5">Modifica</a>
                    <form action="{{route('users.apartments.destroy', $apartment->id )}}" method="POST">
                        @csrf
                        @method('DELETE')

                        <button class="btn btn-danger" type="submit">Elimina</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
