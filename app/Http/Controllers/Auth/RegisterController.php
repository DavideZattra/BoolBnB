<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Input;
use App\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|min:3|max:40',
            'surname' => 'required|string|min:3|max:40',
            'email' => 'required|email|min:5',
            'profile_picture' => 'required|image|mimes:jpeg,jpg,png',
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
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        if($data['profile_picture']) {
            $data['profile_picture'] = Storage::put('profile-picture', $data['profile_picture']);
        } else {
            $data['profile_picture'] = 0;
        }
        return User::create([
            'name' => $data['name'],
            'surname' => $data['surname'],
            'email' => $data['email'],
            'birth_date' => $data['birth_date'],
            'profile_picture' => $data['profile_picture'],
            'password' => Hash::make($data['password']),
        ]);
    }
}
