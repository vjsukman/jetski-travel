<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        // Logic for the user dashboard
        return view('user.dashboard');
    }

    public function profile()
    {
        // Logic for displaying user profile
        return view('user.profile');
    }

    public function profile_submit(Request $request)
    {
        // Logic for updating user profile
        // Validate and save the profile data
        return redirect()->route('user_profile')->with('success', 'Profile updated successfully.');
    }
}
