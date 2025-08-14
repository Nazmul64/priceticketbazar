<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Backend\CommissionSettingController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\UserregistionController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

// Start Admin login routes

// Admin login/logout
Route::get('admin/login', [AdminController::class, 'showLoginForm'])->name('admin.login');
Route::post('admin/login', [AdminController::class, 'login'])->name('admin.login.submit');
Route::post('logout', [AdminController::class, 'logout'])->name('logout');

// Protected admin routes
Route::middleware(['admin'])->group(function () {
    Route::get('admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::resource('commissionsetting', CommissionSettingController::class);
});

// End Admin login routesadmin_login_submit

// ==========================================
// FIXED ROUTES
// ==========================================

// Public routes
Route::get('register', [UserregistionController::class, 'register'])->name('register');
Route::get('user/login', [UserregistionController::class, 'userlogin'])->name('user.login');

// POST routes for form submissions
Route::post('register/submit', [UserregistionController::class, 'registersubmit'])->name('registersubmit');
Route::post('login/submit', [UserregistionController::class, 'loginSubmit'])->name('login.submit');

// Protected routes - IMPORTANT: Make sure this matches your URL
Route::middleware(['user'])->group(function () {
    Route::get('user/dashboard', [UserregistionController::class, 'userdashboard'])->name('userdashboard');
    Route::post('user/logout', [UserregistionController::class, 'logout'])->name('logout');
});



 Route::get('/', [FrontendController::class, 'frontend'])->name('frontend');






