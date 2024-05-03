<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
//    return view('user.index');
})->name('home');
Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect('/login');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::controller(UserController::class)->group(function() {
    Route::get('/register/seeker', 'CreateSeeker')->name('create.seeker');
    Route::post('/register/seeker','StoreSeeker')->name('store.seeker');
    Route::get('/login', 'login')->name('login');
    Route::post('/login/post', 'postLogin')->name('postlogin');
    Route::post('/logout', 'Logout')->name('logout');
    Route::get('/register/employer', 'createEmployer')->name('create.employer');
    Route::post('/register/employer', 'storeEmployer')->name('store.employer');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware('verified');
Route::get('/verify', [DashboardController::class, 'verify'])->name('verification.notice');
Route::get('/resend/verification/email', [DashboardController::class, 'resend'])->name('resend.email');


Route::get('subscribe', [SubscriptionController::class, 'subscribe'])->middleware('auth');
Route::get('pay/weekly', [SubscriptionController::class, 'initiatePayment'])->name('pay.weekly')->middleware('auth');
Route::get('pay/monthly', [SubscriptionController::class, 'initiatePayment'])->name('pay.monthly')->middleware('auth');
Route::get('pay/weekly', [SubscriptionController::class, 'initiatePayment'])->name('pay.yearly')->middleware('auth');

