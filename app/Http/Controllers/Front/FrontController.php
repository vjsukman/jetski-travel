<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Mail\Websitemail;
use App\Models\Slider;
use App\Models\WelcomeItem;

class FrontController extends Controller
{
    public function index()
    {
        $sliders = Slider::get();
        $welcome_item = WelcomeItem::where('id',1)->first();
        return view('front.index', compact('sliders', 'welcome_item'));
    }

    public function about()
    {
        $welcome_item = WelcomeItem::where('id',1)->first();
        return view('front.about' , compact('welcome_item'));
    }

}
