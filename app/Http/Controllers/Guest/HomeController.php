<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home(){

        return view('guests.home');
    }

    public function search(){

        return view('guests.apartments.advanced_search');
    }
}
