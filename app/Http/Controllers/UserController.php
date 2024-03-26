<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterFormRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    const JOB_SEEKER = 'seeker';
    const JOB_POSTER = 'employer';

    public function CreateSeeker()
    {
        return view('user.seeker-register');
    }

    public function createEmployer()
    {
        return view('user.employer-register');
    }

    public function login()
    {
        return view('user.login');
    }

    public function postLogin(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            return redirect()->route('dashboard');
        }

        return 'Wrong email or password';
    }

    public function Logout()
    {
        auth()->logout();
        return redirect()->route('login');
    }

    public function StoreSeeker(RegisterFormRequest $request)
    {
        $user = User::create([
            'name' => request('name'),
            'email' => request('email'),
            'password' => bcrypt(request('password')),
            'user_type' => self::JOB_SEEKER,
        ]);
        Auth::login($user);
        $user->sendEmailVerificationNotification();
        return response()->json('success');
//        return redirect()->route('verification.notice')->with('successMessage', 'Your account was created');
    }


    public function storeEmployer(RegisterFormRequest $request)
    {
        $user = User::create([
            'name' => request('name'),
            'email' => request('email'),
            'password' => bcrypt(request('password')),
            'user_type' => self::JOB_POSTER
        ]);
        Auth::login($user);
        $user->sendEmailVerificationNotification();
        return response()->json('success');
//        return redirect()->route('verification.notice')->with('successMessage', 'Your account was created');
    }
}
