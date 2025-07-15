@extends('front.layout.layout')
@section('content')
    <div class="page-top" style="background-image: url({{ asset('uploads/banner.jpg') }})">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2>Reset Password</h2>
                    <div class="breadcrumb-container">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item active">Reset Password</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="page-content pt_70 pb_70">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-4 col-lg-5 col-md-6 col-sm-12">
                    <div class="login-form">
                        <form action="{{ route('reset_password_submit', ['token' => $token, 'email' => $email]) }}"
                            method="post">
                            @csrf
                            <div class="form-group">
                                <input type="password" class="form-control" name="password" placeholder="Password"
                                    autofocus>
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control" name="confirm_password"
                                    placeholder="Retype Password">
                            </div>
                            <div class="mb-3">
                                <button type="submit" class="btn btn-primary bg-website">
                                    Submit
                                </button>
                                <a href="{{ route('login') }}" class="primary-color">Back to Login Page</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
