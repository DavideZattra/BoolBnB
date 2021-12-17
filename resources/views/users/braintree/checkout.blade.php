@extends('layouts.app')

@section('content')

    <section class="bg-container p-5">
        <div class="container">
            <div class="text-center py-5">
                <h2 class="text-white">Congratulazioni NOME!</h2>
                <h4>
                    You made a great decision! Your SPONSOR NAME sponsorship has been activated for this apartment: APARTMENT NAME.
                </h4>
                <p class="text-white">Your Sponsorship will be active until: DATE END.</p>
                <div class="py-3">
                    <a class="btn btn-custom" href="{{route('users.apartments.index')}}">Return to your apartments.</a>
                </div>
            </div>
        </div>
    </section>

@endsection