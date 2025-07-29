<?php

use App\Http\Middleware\Admin;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Front\FrontController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\User\UserAuthController;
use App\Http\Controllers\Admin\AdminSliderController;
use App\Http\Controllers\Admin\AdminWelcomeItemController;
use App\Http\Controllers\Admin\AdminFeatureController;
use App\Http\Controllers\Admin\AdminCounterItemController;
use App\Http\Controllers\Admin\AdminTestimonialController;

Route::get('/', [FrontController::class, 'index'])->name('home');
Route::get('/about', [FrontController::class, 'about'])->name('about');
Route::get('/login', [UserAuthController::class, 'login'])->name('login');
Route::post('/login', [UserAuthController::class, 'login_submit'])->name('login_submit');
Route::get('/logout', [UserAuthController::class, 'logout'])->name('logout');
Route::get('/register', [UserAuthController::class, 'register'])->name('register');
Route::post('/register', [UserAuthController::class, 'register_submit'])->name('register_submit');
Route::get('/verify-email/{email}/{token}', [UserAuthController::class, 'register_verify'])->name('register_verify');
Route::post('/verify-email/{email}/{token}', [UserAuthController::class, 'register_verify'])->name('register_verify_submit');
Route::get('/forget-password', [UserAuthController::class, 'forget_password'])->name('forget_password');
Route::post('/forget-password', [UserAuthController::class, 'forget_password_submit'])->name('forget_password_submit');
Route::get('/reset-password/{token}/{email}', [UserAuthController::class, 'reset_password'])->name('reset_password');
Route::post('/reset-password/{token}/{email}', [UserAuthController::class, 'reset_password_submit'])->name('reset_password_submit');



// User Routes
Route::middleware('user')->prefix('user')->group(function () {
    Route::get('/dashboard', [UserController::class, 'index'])->name('user_dashboard');
    Route::get('/profile', [UserController::class, 'profile'])->name('user_profile');
    Route::post('/profile', [UserController::class, 'profile_submit'])->name('user_profile_submit');
    
});

Route::prefix('user')->group(function () {
    
});

// Admin Routes
Route::middleware('admin')->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('admin_dashboard');
    
    Route::get('/profile', [AdminAuthController::class, 'profile'])->name('admin_profile');
    Route::post('/profile', [AdminAuthController::class, 'profile_submit'])->name('admin_profile_submit');

    Route::get('/slider/index', [AdminSliderController::class, 'index'])->name('admin_slider_index');
    Route::get('/slider/create', [AdminSliderController::class, 'create'])->name('admin_slider_create');
    Route::post('/slider/create', [AdminSliderController::class, 'create_submit'])->name('admin_slider_create_submit');
    Route::get('/slider/edit/{id}', [AdminSliderController::class, 'edit'])->name('admin_slider_edit');
    Route::post('/slider/edit/{id}', [AdminSliderController::class, 'edit_submit'])->name('admin_slider_edit_submit');
    Route::get('/slider/delete/{id}', [AdminSliderController::class, 'delete'])->name('admin_slider_delete');

    Route::get('/testimonial/index', [AdminTestimonialController::class, 'index'])->name('admin_testimonial_index');
    Route::get('/testimonial/create', [AdminTestimonialController::class, 'create'])->name('admin_testimonial_create');
    Route::post('/testimonial/create', [AdminTestimonialController::class, 'create_submit'])->name('admin_testimonial_create_submit');
    Route::get('/testimonial/edit/{id}', [AdminTestimonialController::class, 'edit'])->name('admin_testimonial_edit');
    Route::post('/testimonial/edit/{id}', [AdminTestimonialController::class, 'edit_submit'])->name('admin_testimonial_edit_submit');
    Route::get('/testimonial/delete/{id}', [AdminTestimonialController::class, 'delete'])->name('admin_testimonial_delete');

    Route::get('/feature/index', [AdminFeatureController::class, 'index'])->name('admin_feature_index');
    Route::get('/feature/create', [AdminFeatureController::class, 'create'])->name('admin_feature_create');
    Route::post('/feature/create', [AdminFeatureController::class, 'create_submit'])->name('admin_feature_create_submit');
    Route::get('/feature/edit/{id}', [AdminFeatureController::class, 'edit'])->name('admin_feature_edit');
    Route::post('/feature/edit/{id}', [AdminFeatureController::class, 'edit_submit'])->name('admin_feature_edit_submit');
    Route::get('/feature/delete/{id}', [AdminFeatureController::class, 'delete'])->name('admin_feature_delete');

    Route::get('/welcome-item/index', [AdminWelcomeItemController::class, 'index'])->name('admin_welcome_item_index');
    Route::post('/welcome-item/update', [AdminWelcomeItemController::class, 'update'])->name('admin_welcome_item_update');

    Route::get('/counter-item/index', [AdminCounterItemController::class, 'index'])->name('admin_counter_item_index');
    Route::post('/counter-item/update', [AdminCounterItemController::class, 'update'])->name('admin_counter_item_update');
    

});

Route::prefix('admin')->group(function () {
    Route::get('/login',[AdminAuthController::class, 'login'])->name('admin_login');
    Route::post('/login', [AdminAuthController::class, 'login_submit'])->name('admin_login_submit');
    Route::get('/logout', [AdminAuthController::class, 'logout'])->name('admin_logout');
    Route::get('/forget-password', [AdminAuthController::class, 'forget_password'])->name('admin_forget_password');
    Route::post('/forget-password', [AdminAuthController::class, 'forget_password_submit'])->name('admin_forget_password_submit');
    Route::get('/reset-password/{token}/{email}',[AdminAuthController::class,'reset_password'])->name('admin_reset_password');
    Route::post('/reset-password/{token}/{email}',[AdminAuthController::class,'reset_password_submit'])->name('admin_reset_password_submit');


});