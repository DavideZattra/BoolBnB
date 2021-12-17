<section class="houses bg-home-section">
    <h2 class="text-center font-weight-bold mb-5">Some city you must visit once in your life...</h2>
    <div class="container scroll">
        <a href="{{ url('/search') }}">
            <div class="row mb-4">
                <div class="col-6 col-md-4 t-ideas"><img src="{{ asset('img/roma.jpeg') }}" alt=""></div>
                <div class="col-6 col-md-5 t-ideas"><img src="{{ asset('img/dubai.jpg') }}" alt=""></div>
                <div class="col-4 col-md-3 t-ideas d-none d-md-block"><img src="{{ asset('img/bruxelles.jpg') }}" alt=""></div>
            </div>
        </a>
        <a href="{{ url('/search') }}">
            <div class="row mb-4">
                <div class="col-6 col-md-3 t-ideas"><img src="{{ asset('img/amsterdam.jpg') }}" alt=""></div>
                <div class="col-6 col-md-3 t-ideas"><img src="{{ asset('img/copenaghen.jpg') }}" alt=""></div>
                <div class="col-md-6 t-ideas d-none d-md-block"><img src="{{ asset('img/venezia.jpg') }}" alt=""></div>
            </div>
        </a>
        <a href="{{ url('/search') }}">
            <div class="row mb-4">
                <div class="col-6 col-md-5 t-ideas"><img src="{{ asset('img/tokyo.jpg') }}" alt=""></div>
                <div class="col-6 col-md-4 t-ideas"><img src="{{ asset('img/vienna.jpg') }}" alt=""></div>
                <div class="col-md-3 t-ideas d-none d-md-block"><img src="{{ asset('img/barcellona.jpg') }}" alt=""></div>
            </div>
        </a>
    </div>
</section>