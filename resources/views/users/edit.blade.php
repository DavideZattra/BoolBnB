@extends('layouts.app')

@section('content')
<section class="bg-container">

    <div class="container user-edit-container">
        <h4>Insert your info.</h4>
    
        <div class="create-edit-wrapper p-3">
            <div class="container create-container">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>    
                @endif 
                
                <form action="{{ route('users.profile.update')}}" method="POST" enctype="multipart/form-data">
                    
                    @csrf
                    @method('patch')
            
                    <div class="form-group">
                        <label for="name">Modify your name</label>
                        <input class="form-control" type="text" id="name" name="name" placeholder="Insert your name" value="{{ $user->name }}" required>
                    </div>
            
                    <div class="form-group">
                        <label for="surname">Modify your surname</label>
                        <input class="form-control" type="text" id="surname" name="surname" placeholder="Insert your surname" value="{{ $user->surname }}" required>
                    </div>
            
                    <div class="form-group">
                        <label for="email">Modify your email</label>
                        <input class="form-control" type="email" id="email" name="email" placeholder="Insert your email" value="{{ $user->email }}" required>
                    </div>
            
                    <div class="form-group">
                        <label for="birth_date">Modify your birth date</label>
                        <input class="form-control" type="date" id="birth_date" name="birth_date" placeholder="Insert your birth date" value="{{ $user->birth_date }}" required>
                    </div>
            
                    <div class="form-group">
                        <label for="profile_picture">Upload your profile picture</label>
                        <input class="form-control" type="file" id="profile_picture" name="profile_picture" >
                    </div>
                    
                    <button class="btn btn-custom" type="submit">Modify your profile</button>
                    
                </form>  
            </div>
        </div>
    </div>
</section>
@endsection