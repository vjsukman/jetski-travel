<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class AdminAuthController extends Controller
{
    public function login()
    {    

        if (Auth::guard('admin')->check()) {
            return redirect()->route('admin_dashboard');
        }
        // If the admin is not logged in, show the login view
        return view('admin.login');
    }   

    public function login_submit(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $check = $request->all();
        $data = [
            'email' => $check['email'],
            'password' => $check['password'],
        ];

        if (Auth::guard('admin')->attempt($data)) {
            return redirect()->route('admin_dashboard');
        } else {
            return redirect()->route('admin_login')->with('error', 'Invalid credentials');
        }
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin_login')->with('success', 'Logged out successfully');
    }

    public function profile()
    {
        return view('admin.profile');
    }

    public function forget_password()
    {
        return view('admin.forget_password');
    }
    
    public function reset_password()
    {
        // Logic for resetting password
        // Validate the request, update the password, etc.
        
        return view('admin.reset_password');
    }
}
