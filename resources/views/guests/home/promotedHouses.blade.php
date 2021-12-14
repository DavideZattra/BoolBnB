@section('cdn-entrypoint')
{{-- Css per flickity --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flickity/2.2.2/flickity.min.css" integrity="sha512-BiFZ6oflftBIwm6lYCQtQ5DIRQ6tm02svznor2GYQOfAlT3pnVJ10xCrU3XuXnUrWQ4EG8GKxntXnYEdKY0Ugg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection

<section id="promoted-houses">
    <h2>The best houses you will find today</h2>
    <div class="main-carousel" data-flickity='{ "cellAlign": "left", "contain": true }'>
        <div class="carousel-cell">
            <a href="#"><img src="{{ asset('img/example-house_1.jpeg') }}" alt="House image"></a>
        </div>
        <div class="carousel-cell">
            <a href="#"><img src="{{ asset('img/example-house_2.jpg') }}" alt="House image"></a>
        </div>
        <div class="carousel-cell">
            <a href="#"><img src="{{ asset('img/example-house_3.jpg') }}" alt="House image"></a>
        </div>
        <div class="carousel-cell">
            <a href="#"><img src="{{ asset('img/example-house_4.jpg') }}" alt="House image"></a>
        </div>
        <div class="carousel-cell">
            <a href="#"><img src="{{ asset('img/example-house_5.jpg') }}" alt="House image"></a>
        </div>
        <div class="carousel-cell">
            <a href="#"><img src="{{ asset('img/example-house_6.jpg') }}" alt="House image"></a>
        </div>
        <div class="carousel-cell">
            <a href="#"><img src="{{ asset('img/example-house_7.jpg') }}" alt="House image"></a>
        </div>
        <div class="carousel-cell">
            <a href="#"><img src="{{ asset('img/example-house_8.webp') }}" alt="House image"></a>
        </div>
        <div class="carousel-cell">
            <a href="#"><img src="{{ asset('img/Jose-Jose.jpg') }}" alt="House image"></a>
        </div>
    </div>
</section>