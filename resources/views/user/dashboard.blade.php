@extends('layouts.app')

@section('content')
<div class="container">
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

                    Welcome back {{ $user->name . ' ' . $user->surname}}!
                </div>

                <div class="card-body">
                    <a href='{{ route('user.edit', Auth::user()->id) }}' class="btn btn-success">
                        Edit your profile
                    </a>
                </div>
            </div>
        </div>
    </div>

    

</div>
@endsection