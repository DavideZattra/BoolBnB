@extends('layouts.app')

@section('content')

    <section class="bg-container p-5">
        <div class="container checkout-wrapper px-5">
            <div class="text-center py-5">
                <h2 class="text-white">Congratulations {{ ucfirst($user->name) }} {{ ucfirst($user->surname) }}.</h2>
                <h4>
                    You made a great decision. Your sponsorship has been activated for this apartment.
                </h4>
                <h4>Your Sponsorship will be active until: <span class="text-white">{{ $newSponsorApartment->end}}.</span></h4>
                <p class="text-white">Sponsorships help your business increase its credibility and visibility, improve its public image, and build prestige. 
                    Like any form of marketing, it should be used strategically as a way to reach your target customers. 
                    <br> Our LUXINN team is always up to date with the newest marketing strategies, 
                    so that our sponsorships are always the upgraded following the newest trends. 
                </p>
                <h4>Thank You for being a loyal user of LUXINN.</h4>
                <div class="py-3">
                    <a class="btn btn-custom" href="{{route('users.apartments.index')}}">Return to your apartments.</a>
                </div>
            </div>
        </div>
    </section>
@endsection