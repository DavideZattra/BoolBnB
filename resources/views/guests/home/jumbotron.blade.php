<section id="jumbotron">
    <div id="jumbo" class="d-flex justify-content-end align-items-center">
        <div class="jumbo-text jumbo-lg d-none d-md-block text-center">
            <h1>Dream. Travel. Live.</h1>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quae, itaque a tempore similique blanditiis magni nam neque quis praesentium enim quaerat quo. Explicabo tempore ullam commodi sed pariatur, dignissimos nemo!</p>
            <div class="jumbo-button">
                <button type="button" class="btn btn-sm"><a href="{{route("users.apartments.index")}}">My apartments</a></button>
            </div>
        </div>
    </div>
    <div class="jumbo-text jumbo-sm d-block d-md-none text-center">
        <h1>Dream. Travel. Live.</h1>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quae, itaque a tempore similique blanditiis magni nam neque quis praesentium enim quaerat quo. Explicabo tempore ullam commodi sed pariatur, dignissimos nemo!</p>
        <div class="jumbo-button">
            @if (Auth::check())
                <button type="button" class="btn btn-sm"><a href="{{route("login")}}">My apartments</a></button>
            @else
            <button type="button" class="btn btn-sm"><a href="{{route("users.apartments.index")}}">My apartments</a></button>
            @endif
        </div>
    </div>
</section>