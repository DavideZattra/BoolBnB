<section id="jumbotron">
    <div id="jumbo" class="d-flex justify-content-end align-items-center align-items-md-start">
        <div class="jumbo-text jumbo-lg d-block d-md-none text-center col-12 d-flex align-items-center justify-content-center white-block">
            <div>
                <img src="{{ asset('/img/logo-white.png') }}" alt="logo">
                <h2>Dream. Travel. Live.</h2>
    
                <div class="jumbo-button">
    
                    {{-- added route (if user auth->index/ else->login ) --}}
                    @if (Auth::check())
                        <button type="button" class="btn btn-custom"><a href="{{route("users.apartments.index")}}">My profile</a></button>
                    @else
                        <button type="button" class="btn btn-custom"><a href="{{route("register")}}">Create a profile.</a></button>
                    @endif
                </div>
            </div>
        </div>

        <div class="jumbo-text jumbo-lg d-none d-md-block text-center col-md-12 col-lg-6 black-block scroll">

            <img src="{{ asset('/img/logo-black.png') }}" alt="logo">
            <h2>Dream. Travel. Live.</h2>

            <div class="jumbo-button">
                {{-- added route (if user auth->index/ else->login ) --}}
                @if (Auth::check())
                    <button type="button" class="btn btn-sm"><a href="{{route("users.apartments.index")}}">My profile</a></button>
                @else
                    <button type="button" class="btn btn-sm"><a href="{{route("register")}}">Create a profile.</a></button>
                @endif
            </div>
        </div>

    </div>

</section>