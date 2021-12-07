<section id="jumbotron">
    <div id="jumbo" class="d-flex justify-content-end align-items-center">

        {{-- div only visible when > sm --}}
        <div class="jumbo-text jumbo-lg d-none d-md-block text-center">
            <h1>Dream. Travel. Live.</h1>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quae, itaque a tempore similique blanditiis magni nam neque quis praesentium enim quaerat quo. Explicabo tempore ullam commodi sed pariatur, dignissimos nemo!</p>
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

    {{-- div only visible when <= sm --}}
    <div class="jumbo-text jumbo-sm d-block d-md-none text-center">
        <h1>Dream. Travel. Live.</h1>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quae, itaque a tempore similique blanditiis magni nam neque quis praesentium enim quaerat quo. Explicabo tempore ullam commodi sed pariatur, dignissimos nemo!</p>
        <div class="jumbo-button">

            {{-- added route (if user::auth->index/ else->login ) --}}
            @if (Auth::check())
                <button type="button" class="btn btn-sm"><a href="{{route("login")}}">My apartments</a></button>
            @else
                <button type="button" class="btn btn-sm"><a href="{{route("users.apartments.index")}}">My apartments</a></button>
            @endif
        </div>
    </div>
    
</section>