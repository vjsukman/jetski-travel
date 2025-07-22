<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Mail\Websitemail;
use App\Models\Slider;

class FrontController extends Controller
{
    public function index()
    {
        $sliders = Slider::get();
        return view('front.index', compact('sliders'));
    }

    public function about()
    {
        // Logic for the about page
        return view('front.about');
    }

}
