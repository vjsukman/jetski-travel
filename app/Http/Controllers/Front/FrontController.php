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
use App\Models\Feature;
use App\Models\CounterItem;

class FrontController extends Controller
{
    public function index()
    {
        $sliders = Slider::get();
        $feature = Feature::get();
        $welcome_item = WelcomeItem::where('id',1)->first();
        return view('front.index', compact('sliders', 'welcome_item', 'feature','counter_item'));
    }

    public function about()
    {
        $welcome_item = WelcomeItem::where('id',1)->first();
        $counter_item = CounterItem::where('id',1)->first();
        $feature = Feature::get();
        return view('front.about' , compact('welcome_item', 'feature','counter_item'));
    }

}
