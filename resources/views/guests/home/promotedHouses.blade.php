@section('cdn-entrypoint')
{{-- Css per flickity --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flickity/2.2.2/flickity.min.css" integrity="sha512-BiFZ6oflftBIwm6lYCQtQ5DIRQ6tm02svznor2GYQOfAlT3pnVJ10xCrU3XuXnUrWQ4EG8GKxntXnYEdKY0Ugg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection

<section id="promoted-houses">
    <div class="main-carousel" data-flickity='{ "cellAlign": "left", "contain": true }'>
        <div class="carousel-cell">carousel</div>
        <div class="carousel-cell">carousel</div>
        <div class="carousel-cell">carousel</div>
    </div>
</section>