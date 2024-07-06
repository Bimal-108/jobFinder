<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PostJobController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\isEmployer;
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

Route::controller(DashboardController::class)->group(function() {
    Route::get('/dashboard', 'index')->name('dashboard')->middleware('verified');
    Route::get('/verify', 'verify')->name('verification.notice');
    Route::get('/resend/verification/email', 'resend')->name('resend.email');
});

Route::controller(SubscriptionController::class)->group(function() {
//    Route::group(['middleware' => ['auth', 'isEmployer', 'donotUser']], function () {
//        Route::get('subscribe',  'subscribe')->name('subscribe');
//    });
    Route::get('subscribe',  'subscribe')->name('subscribe');
    Route::get('pay/weekly', 'initiatePayment')->name('pay.weekly');
    Route::get('pay/monthly', 'initiatePayment')->name('pay.monthly');
    Route::get('pay/yearly', 'initiatePayment')->name('pay.yearly');
    Route::get('payment/success',  'paymentSuccess')->name('payment.success');
    Route::get('payment/cancel',  'cancel')->name('payment.cancel');
});

Route::get('job/creat', [PostJobController::class, 'create'])->name('job.create')->middleware('prenium');

