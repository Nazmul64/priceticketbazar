<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Backend\AboutController;
use App\Http\Controllers\Backend\CommissionSettingController;
use App\Http\Controllers\Backend\ContactController;
use App\Http\Controllers\Backend\CounterController;
use App\Http\Controllers\Backend\DepositdetilsController;
use App\Http\Controllers\Backend\DepositeContrller;
use App\Http\Controllers\Backend\DepositeController;
use App\Http\Controllers\Backend\LotterycreateController;
use App\Http\Controllers\Backend\LotteryResultController;
use App\Http\Controllers\Backend\PartnarController;
use App\Http\Controllers\Backend\PrivacypolicyController;
use App\Http\Controllers\Backend\SettingController;
use App\Http\Controllers\Backend\SliderController;
use App\Http\Controllers\Backend\TermsconditionController;
use App\Http\Controllers\Backend\WaletaSetupController;
use App\Http\Controllers\Backend\WhychooseinvestmentplanConroller;
use App\Http\Controllers\Backend\WithdrawcommissonController;
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
    Route::get('/users', [AdminController::class, 'userList'])->name('chat.users');   // sidebar list
    Route::get('/fetch', [AdminController::class, 'fetch'])->name('chat.fetch');      // fetch messages
    Route::post('/send', [AdminController::class, 'send'])->name('chat.send');
    Route::resource('slider',SliderController::class);
    Route::resource('counter',CounterController::class);
    Route::resource('contact',ContactController::class);
    Route::resource('partner',PartnarController::class);
    Route::resource('Termscondition',TermsconditionController::class);
    Route::get('userlist-for-admin', [AdminController::class, 'userlistadmin'])->name('admin.userlist');
    Route::put('/users/{id}/status', [AdminController::class, 'updateStatus'])->name('users.updateStatus');
    Route::resource('withdrawcommisson',WithdrawcommissonController::class);


// Show all lotteries with purchased tickets count
Route::get('/admin/lottery/purchases', [LotteryResultController::class, 'purchasedTickets'])
    ->name('admin.lottery.purchases');

// Show form to declare winners
Route::get('/admin/lottery/{lottery}/declare', [LotteryResultController::class, 'showDeclareForm'])
    ->name('admin.lottery.showDeclare');

// Declare winners
Route::post('/admin/lottery/{lottery}/declare', [LotteryResultController::class, 'declareResult'])
    ->name('admin.lottery.declare');


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
    Route::get('user/chat',        [ChatController::class, 'index'])->name('user.chat');
    Route::get('user/chat/fetch',  [ChatController::class, 'fetch'])->name('user.chat.fetch');
    Route::post('user/chat/send',  [ChatController::class, 'send'])->name('user.chat.send');
    Route::get('user/chat/list',   [ChatController::class, 'userList'])->name('user.chat.list');
    Route::get('/userlotter/history', [UserlottryController::class, 'userlotterhistory'])->name('userlotter.history');


});


// Frontend route
 Route::get('/', [FrontendController::class, 'frontend'])->name('frontend');
 Route::get('privacy', [FrontendController::class, 'privacy'])->name('privacy');
 Route::get('contacts', [FrontendController::class, 'contacts'])->name('contacts');
 Route::get('termsconditions', [FrontendController::class, 'termsconditions'])->name('termsconditions');






