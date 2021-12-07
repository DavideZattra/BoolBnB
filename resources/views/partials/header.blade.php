<header>
    <nav class="navbar sticky-top navbar-expand-md navbar-custom shadow-sm">
        <div class="container px-5">

            {{-- logo link to home when clicked --}}
            <a id="logo" class="navbar-brand font-weight-bold mr-0" href="{{ url('/') }}">BoolBnB</a>

            {{-- toggle when in sm (login and register replace) --}}
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span id="my_toggler" class="navbar-toggler-icon">
                    {{-- <i class="fas fa-bars"></i> --}}
                </span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav mr-auto">
                    
                </ul>

                {{-- middle of navbar --}}
                <ul class="navbar-nav mx-auto">
                    <li><input class="form-control my_search-bar pl-3" type="search" placeholder="Search" aria-label="Search"></li>
                </ul>
    
                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto">

                    <!-- Authentication Links -->
                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                        @endif
                    @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>
    
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>
    
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

</header>