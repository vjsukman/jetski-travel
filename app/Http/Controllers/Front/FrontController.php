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
use App\Models\TeamMember;
use App\Models\Testimonial;
use App\Models\Faq;

class FrontController extends Controller
{
    public function index()
    {
        $sliders = Slider::get();
        $feature = Feature::get();
        $testimonial = Testimonial::get();
        $welcome_item = WelcomeItem::where('id',1)->first();
        return view('front.index', compact('sliders', 'welcome_item', 'feature', 'testimonial' ));
    }

    public function about()
    {
        $welcome_item = WelcomeItem::where('id',1)->first();
        $counter_item = CounterItem::where('id',1)->first();
        $feature = Feature::get();
        return view('front.about' , compact('welcome_item', 'feature','counter_item'));
    }

    public function team_members()
    {
        $team_members = TeamMember::paginate(4);
        return view('front.team_members', compact('team_members'));
    }

    public function team_member($slug)
    {
        $team_member = TeamMember::where('slug', $slug)->first();
        return view('front.team_member', compact('team_member'));
    }

    public function faq()
    {
        $faqs = Faq::all();
        return view('front.faq', compact('faqs'));
    }

}
