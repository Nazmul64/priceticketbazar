<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Backend\AboutController;
use App\Http\Controllers\Backend\CommissionSettingController;
use App\Http\Controllers\Backend\DepositdetilsController;
use App\Http\Controllers\Backend\DepositeContrller;
use App\Http\Controllers\Backend\DepositeController;
use App\Http\Controllers\Backend\LotterycreateController;
use App\Http\Controllers\Backend\PrivacypolicyController;
use App\Http\Controllers\Backend\SettingController;
use App\Http\Controllers\Backend\WaletaSetupController;
use App\Http\Controllers\Backend\WhychooseinvestmentplanConroller;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\TotalreferreduseController;
use App\Http\Controllers\UserlottryController;
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
    Route::resource('waletesetting', WaletaSetupController::class);
    Route::post('/deposites/{deposit}/status', [DepositeContrller::class, 'updateStatus'])->name('deposites.updateStatus');
    Route::get('/deposites/index', [DepositeContrller::class, 'approveindex'])->name('approve.index');
    Route::get('/deposites/delete/{id}', [DepositeContrller::class, 'approvedelete'])->name('approve.delete');
    Route::resource('lottery', LotterycreateController::class);
    Route::resource('whychooseusinvesment', WhychooseinvestmentplanConroller::class);
    Route::resource('aboutus', AboutController::class);
    Route::resource('settings', SettingController::class);
    Route::resource('privacypolicy',PrivacypolicyController::class);
});

// End Admin login routesadmin_login_submit

// ==========================================
// FIXED ROUTES
// ==========================================

// Public routes
Route::get('register', [UserregistionController::class, 'register'])->name('register');
Route::get('user/login', [UserregistionController::class, 'userlogin'])->name('user.login');

// POST routes for form submissions
Route::post('register/submit', [UserregistionController::class, 'registersubmit'])->name('register.submit');
Route::post('login/submit', [UserregistionController::class, 'loginSubmit'])->name('login.submit');

// Protected routes - IMPORTANT: Make sure this matches your URL
Route::middleware(['user'])->group(function () {
    Route::get('user/dashboard', [UserregistionController::class, 'userdashboard'])->name('user.dashboard');
    Route::resource('deposite', DepositeContrller::class);
    Route::get('/my-referrals', [TotalreferreduseController::class, 'myReferrals'])->name('my.referrals');
    Route::get('/user-referrals/{id}', [TotalreferreduseController::class, 'userReferrals'])->name('user.referrals');
    Route::get('/my-referrals-count', [TotalreferreduseController::class, 'totalCount'])->name('my.referrals.count');
    Route::get('/commissions', [TotalreferreduseController::class, 'commissions'])->name('user.commissions');
    Route::get('/referrals_nested', [TotalreferreduseController::class, 'referrals_nested'])->name('referrals.nested');
    Route::get('/userlotter/show', [UserlottryController::class, 'userlotter'])->name('userlotter.index');
    Route::post('/buy-package/{packageId}', [UserlottryController::class, 'buyPackage'])->name('buy.package');
    Route::get('/user/chat', [ChatController::class, 'index'])->name('user.chat');

});


// Frontend route
 Route::get('/', [FrontendController::class, 'frontend'])->name('frontend');
 Route::get('privacy', [FrontendController::class, 'privacy'])->name('privacy');






