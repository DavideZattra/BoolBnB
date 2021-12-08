@extends('layouts.app')

@section('content')
<div class="container my-5" id='dashboard'>

    <div class="row justify-content-center">

        <div class="col-12 text-center">My Dashboard</div>

        {{-- Profile information --}}
        <div class="col-12 col-md-6">

            <div class="card">

                <div class="card-header ">My Profile</div>

                <div class="card-body d-md-flex ">

                    <div class="profile-pic col-12 col-md-6">
                        <img src="{{ $user->profile_picture }}" alt="" class="img-fluid">
                    </div>

                    <div class="user-data col-12 col-md-6">
                        <ul>

                            <li>Name: {{ $user->name }}</li>
                            <li>Surname: {{ $user->surname }}</li>
                            <li>Email: {{ $user->email }}</li>
                            <li>Birth date: {{ $user->birth_date }}</li>

                        </ul>
                    </div>

                </div>

                <div class="card-footer">
                    
                    {{-- Button to edit the user profile --}}
                    <a href='{{ route('users.edit', Auth::user()->id) }}' class="btn btn-dark">
                        Edit your profile
                    </a>
                    
                </div>

            </div>

        </div>
        {{-- apartments information --}}
        <div class="col-12 col-md-6">

            <div class="card">

                <div class="card-header">My Apartments</div>

                <ul class="list-group list-group-flush">

                    @forelse ($userApartments as $apartment)
                        
                    <li class="list-group-item">{{ $apartment['descriptive_title'] }}</li>

                    @empty
                        
                    <li class="list-group-item">Insert a new apartment and become a member of our family!</li>

                    @endforelse

                </ul>

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



        {{--<div class="card-body">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif
            <div class="profile-picture">
                <img src="{{ $user->profile_picture }}" alt="" class="img-fluid">
            </div>
            Welcome back {{ ucfirst($user->name) . ' ' . ucfirst($user->surname)}}!
        </div> --}}

        