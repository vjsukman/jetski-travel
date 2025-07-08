<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Mail\Websitemail;

class FrontController extends Controller
{
    public function index()
    {
        // Logic for the home page
        return view('front.index');
    }

    public function about()
    {
        // Logic for the about page
        return view('front.about');
    }

}
