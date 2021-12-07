@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-12">
                <h3 class="text-uppercase font-weight-bold mb-3 mt-3">{{ $apartment->descriptive_title }}</h3>
                <a href="#" class="map-link">
                    <i class="fas fa-map-marked-alt"></i>
                    {{ $apartment->addresses->country }}, {{ $apartment->addresses->city }}, {{ $apartment->addresses->address }}
                </a>
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
