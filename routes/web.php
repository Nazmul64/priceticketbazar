<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\FrontendController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

// Start Admin login routes
    Route::get('admin', [AdminController::class, 'login'])->name('login');
    Route::post('admin/login/submit', [AdminController::class, 'admin_login_submit'])->name('admin_login_submit');
    Route::post('admin/logout', [AdminController::class, 'logout'])->name('logout');

// End Admin login routesadmin_login_submit


// Start User login login routes
// Route::middleware(['user'])->group(function () {
//    Route::get('userdashboard', [FrontendController::class, 'userdashboard'])->name('userdashboard');
// });
 Route::get('register', [FrontendController::class, 'register'])->name('register');

 Route::get('/', [FrontendController::class, 'frontend'])->name('frontend');






