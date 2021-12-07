<?php

namespace App\Http\Controllers\User;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\User;

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

        return view('user.dashboard', compact('user'));
    }

    public function edit()
    {
        $user = Auth::user();

        return view('user.edit', compact('user'));
    }

    public function update(Request $request){

        
        // Get current user
        $userId = Auth::user()->id;
        $user = User::findOrFail($userId);

        
        
        
        // Fill user model
        $user->fill($request->all());

        $user->update();
        

        return redirect()->route('user.dashboard');

    }
}
