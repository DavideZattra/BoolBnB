@extends('layouts.app')

@section('content')
    <div class="index-wrapper">
        <div class="container px-5">
    
            <header class="py-3">
                <h4><a href="{{route("users.apartments.create")}}">Insert a new apartment</a></h4>
            </header>

            <div class="row justify-content-center px-3">
            
                @forelse ($apartments as $apartment)
                    <div class="card col-12 col-md-5 col-lg-3 m-4 p-0" style="width: 18rem;">
                        {{-- <img class="card-img-top" src="https://thumbor.forbes.com/thumbor/960x0/https%3A%2F%2Fspecials-images.forbesimg.com%2Fimageserve%2F1026205392%2FBeautiful-luxury-home-exterior-at-twilight%2F960x0.jpg%3Ffit%3Dscale" alt=""> --}}
                        <img class="card-img-top" src="{{ $apartment->image }}" alt="">
                        <div class="card-body">
                            <a class="text-center" href="{{ route('users.apartments.show', $apartment->id ) }}">{{ ucfirst($apartment->descriptive_title) }}</a>
                            <p>
                                <span>{{ $apartment->addresses->country }}</span>, 
                                <span>{{ $apartment->addresses->city }}</span> <br>
                                <span>{{ $apartment->addresses->address }}</span>
                            </p>
                        </div>
                    </div>
                @empty
                    <p>You don't have any apartment on this website,
                        <a href="{{ route('users.apartments.create', $apartment ) }}">click this link to create one.</a>
                    </p>
                @endforelse
            </div>
            
            <footer class="footer p-3 mx-2 d-flex justify-content-md-center">
                {{ $apartments->links() }}
            </footer>
    
        </div>
    </div>
@endsection

