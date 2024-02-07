<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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
});

Route::controller(UserController::class)->group(function() {
    Route::get('/register/seeker', 'CreateSeeker')->name('create.seeker');
    Route::post('/register/seeker','StoreSeeker')->name('store.seeker');
    Route::get('/login', 'login')->name('login');
    Route::post('/login', 'postLogin')->name('login.post');
    Route::post('/logout', 'Logout')->name('logout');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
