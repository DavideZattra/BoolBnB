@section('cdn-entrypoint')
{{-- Css per flickity --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flickity/2.2.2/flickity.min.css" integrity="sha512-BiFZ6oflftBIwm6lYCQtQ5DIRQ6tm02svznor2GYQOfAlT3pnVJ10xCrU3XuXnUrWQ4EG8GKxntXnYEdKY0Ugg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection

<section id="promoted-houses" class="bg-home-section">
    <div class="container">
        <h2 class="text-center font-weight-bold">The best houses you will find today</h2>
    </div>
    <div class="main-carousel scroll" data-flickity='{ "cellAlign": "left", "contain": true }'>

        @forelse ($sponsorApartments as $sponsorApartment)
            <div class="carousel-cell">
                <a href="{{ route('users.apartments.show', $sponsorApartment->apartment->id) }}"><img class="animation-img" src="{{ asset('storage/'.$sponsorApartment->apartment->image) }}" alt="House image"></a>
            </div> 
        @empty

            <h2>no tengo dinero</h2>
            
        @endforelse
        
    </div>
</section>