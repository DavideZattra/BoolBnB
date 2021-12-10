@extends('layouts.app')

@section('content')
<div class="container" id='dashboard'>

    <div class="row justify-content-center wrapper">

        <div class="col-12 pb-4">
            <h2>My Dashboard.</h2>
        </div>

        {{-- Profile information --}}
        <div class="col-12 col-md-12 col-lg-6">
            <div class="card">

                <div class="card-header ">My Profile</div>
                <div class="card-body d-md-flex align-items-center">
                    <div class="col-12 col-md-6 d-flex align-items-center">
                        <div class="profile-pic">
                            <img src="{{ asset('storage/'. $user->profile_picture) }}" alt="" >
                        </div>
                    </div>

                    <div class="user-data col-12 col-md-6">
                        <ul>
                            <li><span>Name:</span> {{ $user->name }}</li>
                            <li><span>Surname:</span> {{ $user->surname }}</li>
                            <li><span>Email:</span> {{ $user->email }}</li>
                            <li><span>Birth date:</span> {{ $user->birth_date }}</li>
                        </ul>
                    </div>
                </div>

                <div class="card-footer">
                    {{-- Button to edit the user profile --}}
                    <a href='{{ route('users.edit', Auth::user()->id) }}' class="btn btn-custom">
                        Edit your profile
                    </a>
                </div>

            </div>
        </div>

        {{-- apartments information --}}
        <div class="col-12 col-md-6">
            <div class="card">

                <div class="card-header">My Apartments</div>
                <div class="card-body">

                    
                    <ul class="apartment-list">
                        @forelse ($userApartments as $apartment)
                        {{-- @dd($apartment) --}}
                            <li class="list-group-item"><a href="{{ route('users.apartments.show', $apartment['id'] ) }}">{{ ucfirst($apartment['descriptive_title']) }}</a></li>
                        @empty
                            <li class="list-group-item">Insert a new apartment and become a member of our family!</li>
                        @endforelse
                    </ul>
                </div>

                <div class="card-footer d-flex justify-content-between">
                    {{-- Button that show user apartments --}}
                    <a href='{{ route('users.apartments.index')}}' class="btn btn-dark">
                        My Apartments
                    </a>
                    {{-- Button that allow user to insert a new apartment --}}
                    <a href='{{ route('users.apartments.create')}}' class="btn btn-dark">
                        Insert new apartment
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
