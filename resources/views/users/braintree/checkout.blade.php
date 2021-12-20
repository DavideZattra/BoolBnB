@extends('layouts.app')

@section('content')

    <section class="bg-container p-5">
        <div class="container checkout-wrapper px-5">
            <div class="text-center py-5">
                <h2 class="text-white">Congratulations {{ ucfirst($user->name) }} {{ ucfirst($user->surname) }}.</h2>
                <h4 class="text-white">
                    You made a great decision. Your sponsorship has been activated for this apartment.
                </h4>
                <h4 class="text-white">Your Sponsorship will be active until: <span class="text-white">{{ $newSponsorApartment->end}}.</span></h4>
                <h4 class="text-white">Thank You for being a loyal user of LUXINN.</h4>
                <div class="py-3 text-white">
                    <a class="btn btn-custom" href="{{route('users.apartments.index')}}">Return to your apartments.</a>
                </div>
            </div>
        </div>
    </section>
@endsection