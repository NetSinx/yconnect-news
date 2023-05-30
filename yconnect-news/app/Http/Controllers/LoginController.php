<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
  public function index()
  {
    return view('login.index');
  }

  public function login(Request $request)
  {
    if( RateLimiter::tooManyAttempts($request->ip(), 3) ) {
      $seconds = RateLimiter::availableIn($request->ip());

      return back()->with('failed', 'Login kembali setelah ' . $seconds . ' detik');
    }

    if( RateLimiter::remaining($request->ip(), 3) ) {
      RateLimiter::hit($request->ip(), 120);

      $validator = Validator::make(request()->all(), [
        'username' => 'required|string',
        'password' => 'required|string|min:8'
      ], [
        'username.required' => 'Username wajib diisi!',
        'password.required' => 'Password wajib diisi!',
        'password.min' => 'Password minimal 8 karakter!'
      ]);

      if ($validator->fails()) {
        return back()->withErrors($validator)->withInput();
      }

      $credentials = filter_var(request()->username, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

      if (Auth::attempt([$credentials => request()->username, 'password' => request()->password])) {
        RateLimiter::clear(request()->ip());

        request()->session()->regenerate();

        return redirect()->intended('/dashboard');
      }

      $retries = RateLimiter::retriesLeft($request->ip(), 3);

      return back()->with('failed', 'Email/Password Anda salah!')
                   ->with('retries', 'Maksimal percobaan login: ' . $retries. ' kali');
    }
  }   
}
