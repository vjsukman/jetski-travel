<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Mail\Websitemail;

class UserAuthController extends Controller
{

    public function register()
    {
        // Logic for the registration page
        return view('front.register');
    }

    public function register_submit(Request $request)
    {
        // Logic to handle registration form submission
        // Validate and save user data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|string|min:4',
            'password_confirmation' => 'required|same:password',
        ]);

        $token = bin2hex(random_bytes(50));

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->token = $token;
        $user->save();

        // $token = bin2hex(random_bytes(50));
        $verifitication_link = route('register_verify', ['email' =>$request->email,'token' => $token]);
        
        $user->status = 0; // Assuming 0 means inactive

        $subject = 'Registration Successful';
        $message = 'Thank you for registering on our website. Please verify your email address to complete the registration process.<br>
        <a href="' .$verifitication_link.'">Verify Email</a>';

        \Mail::to($request->email)->send(new Websitemail($subject,$message));

        // Create user logic here (e.g., User::create(...))

        return redirect()->back()->with('success', 'Registration successful. Please Check your email for verification.');
    }

    public function register_verify($email, $token)
    {
        // Logic to verify email
        $user = User::where('email', $email)->where('token', $token)->first();

        if (!$user) {
            return redirect()->route('login')->with('error', 'Invalid verification link or user not found.');
        }
        
        $user->token = ''; // Clear the token after verification
        $user->status = 1; // Assuming 1 means active
        $user->update();

        return redirect()->route('login')->with('success', 'Email verified successfully. You can now log in.');
    }

    public function login()
    {
        // Check if the user is already logged in
        if (Auth::guard('user')->check()) {
            return redirect()->route('user_dashboard');
        }
        // Logic for the login page
        return view('front.login');
    }

    public function login_submit(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:4',
        ]);
        $check = $request->all();
        $data = [
            'email' => $check['email'],
            'password' => $check['password'],
            'status' => 1, // Assuming 1 means active
        ];

        if (Auth::guard('user')->attempt($data)) {
            // Authentication passed
            return redirect()->route('user_dashboard')->with('success', 'Login successful.');
        } else {
            // Authentication failed
            return redirect()->route('login')->with('error', 'Invalid email or password.');
        }
    }

    public function logout()
    {
        // Logic to handle user logout
        Auth::guard('user')->logout();
        return redirect()->route('home')->with('success', 'Logged out successfully.');
    }

    public function forget_password()
    {

        return view('user.forget_password');
    }

    public function forget_password_submit(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
        ]);

        $user = User::where('email',$request->email)->first();
        if(!$user) {
            return redirect()->back()->with('error','Email is not found');
        }
        

        $token = hash('sha256',time());
        $user->token = $token;
        $user->update();

        $reset_link = route('reset_password', ['token' => $token, 'email' => $request->email]);
        $subject = "Password Reset";
        $message = "To reset password, please click on the link below:<br>";
        $message .= "<a href='".$reset_link."'>Click Here</a>";

        \Mail::to($request->email)->send(new Websitemail($subject,$message));

        return redirect()->back()->with('success','We have sent a password reset link to your email. Please check your email. If you do not find the email in your inbox, please check your spam folder.');
    }

    
    public function reset_password($token, $email)
    {
        $user = User::where('email', $email)->where('token', $token)->first();
        if(!$user) {
            return redirect()->route('login')->with('error','Token or email is not correct');
        }
        return view('user.reset_password', compact('token','email'));
    }

    public function reset_password_submit(Request $request, $token, $email)
    {
        $request->validate([
            'password' => ['required'],
            'confirm_password' => ['required','same:password'],
        ]);

        $user = User::where('email',$request->email)->where('token',$request->token)->first();
        $user->password = Hash::make($request->password);
        $user->token = "";
        $user->update();

        return redirect()->route('login')->with('success','Password reset is successful. You can login now.');
    }
    
}
