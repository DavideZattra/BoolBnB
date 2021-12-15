@extends('layouts.app')

@section('content')

    <div class="container-checkout">
        <h1>Your transaction was successfull! <i class="fas fa-check-circle"></i></h1>
        <p>You made a great decision, sponsoring your apartments increases your views by 80%.</p>
        <h6>
          <a href="{{ url('/') }}">Torna alla homepage</a>
        </h6>
      </div>
    </div>

@endsection