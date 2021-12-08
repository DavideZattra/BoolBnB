<?php

namespace App\Http\Controllers\User;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\User;
use App\Models\Apartment;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // dd(Auth::user());
        $user = Auth::user();
        $userApartments = $user->apartments->toArray();
        // dd($userApartments);

        return view('users.dashboard', compact('user', 'userApartments'));
    }

    public function edit()
    {
        $user = Auth::user();

        return view('users.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string|min:3|max:40',
            'surname' => 'required|string|min:3|max:40',
            'email' => 'required|email|min:5',
            'profile_picture' => 'nullable|image|mimes:jpeg,jpg,png',
            'birth_date' => 'required|date|before:today',
        ],
        [
            'required' => ':attribute is required',
            'name.min' => 'The name should be at least 3 characters long',
            'name.max' => 'the name should not exceed 40 characters',
            'surname.min' => 'The surname should be at least 3 characters long',
            'surname.max' => 'The surname should not exceed 40 characters',
            'email.email' => 'The email should be an email',
            'email.min' => 'The email should be at least 3 characters long',
            'profile_picture.image' => 'The profile picture should be an image',
            'profile_picture.mimes' => 'The image format must be a jpeg,jpg or png',
            'birth_date.before' => 'Are you coding from the future?'


        ]);

        // Get current user
        $userId = Auth::user()->id;
        $user = User::findOrFail($userId);

        
        
        
        // Fill user model
        $user->fill($request->all());

        $user->update();
        

        return redirect()->route('users.dashboard');

    }
}
