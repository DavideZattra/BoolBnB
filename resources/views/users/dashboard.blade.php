@extends('layouts.app')

@section('content')
<div class="container" id='dashboard'>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Your Profile') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="profile-picture">
                        <img src="{{ $user->profile_picture }}" alt="" class="img-fluid">
                    </div>
                    Welcome back {{ ucfirst($user->name) . ' ' . ucfirst($user->surname)}}!
                </div>

                <div class="card-body">
                    {{-- Button to edit the user profile --}}
                    <a href='{{ route('users.edit', Auth::user()->id) }}' class="btn btn-success">
                        Edit your profile
                    </a>
                    {{-- Button that show user apartments --}}
                    <a href='{{ route('users.apartments.index')}}' class="btn btn-success">
                        My Apartments
                    </a>
                </div>
            </div>
        </div>
    </div>

    

</div>
@endsection