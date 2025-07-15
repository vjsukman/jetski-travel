<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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
        $user = User::where('id', Auth::guard('user')->user()->id)->first();
        // Logic for updating user profile
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,'.$user->id,
            'phone' => 'required|string|max:15',
            'country' => 'required|string|max:100',
            'address' => 'required|string|max:255',
            'state' => 'required|string|max:100',
            'city' => 'required|string|max:100',
            'zip' => 'required|string|max:20',
        ]);

        

        if ($request->photo){
            $request->validate([
                'photo' => 'mimes:jpeg,jpg,png,gif|max:2048'
        ]);
        if($user->photo != ''){
            unlink(public_path('uploads/users/' . $user->photo));
        }
        $finalName = 'user_'.time() . '.' . $request->photo->extension();
        $request->photo->move(public_path('uploads/users'), $finalName);
        $user->photo = $finalName;
        }

        if ($request->password != ''){
            $request->validate([
                'password' => 'required',
                'retype_password' => 'required|same:password',
            ]);
            $user->password = Hash::make($request->password);
        }
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->country = $request->country; 
        $user->address = $request->address;
        $user->state = $request->state;
        $user->city = $request->city;
        $user->zip = $request->zip;
        $user->update();
        // Validate and save the profile data
        return redirect()->route('user_profile')->with('success', 'Profile updated successfully.');
    }
}
