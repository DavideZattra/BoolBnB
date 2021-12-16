@extends('layouts.app')

@section('content')
    <div class="index-wrapper bg-container">
        <div class="container px-5">
    
            <header class="py-3 mb-5">
                <h4>Your apartments.</h4>
            </header>

            <div class="row justify-content-center px-3">
            
                @forelse ($apartments as $apartment)
                    <div class="card col-12 col-md-5 col-lg-3 m-4 p-0" style="width: 18rem;">
                        <img class="card-img-top" src="{{ asset('storage/' . $apartment->image) }}" alt="immagine copertina dell'appartamento">
                        <div class="card-body">
                            <a class="text-center" href="{{ route('users.apartments.show', $apartment->id ) }}">{{ ucfirst($apartment->descriptive_title) }}</a>
                            <p class="m-0">
                                <span>{{ $apartment->addresses->country }}</span>, 
                                <span>{{ $apartment->addresses->city }}</span> <br>
                                <span>{{ $apartment->addresses->address }}</span>
                            </p>
                        </div>
                    </div>
                @empty
                    <p>You don't have any apartment on this website,
                        <a href="{{ route('users.apartments.create') }}">click this link to create one.</a>
                    </p>
                @endforelse
            </div>

            <div class="p-3 mx-2 d-flex justify-content-md-center">
                {{ $apartments->links() }}
            </div>

            <div class="py-3 mb-5">
                <h5><a href="{{route("users.apartments.create")}}" class="font-italic">Click here to insert a new apartment</a></h5>
            </div>
        </div>
    </div>
@endsection

