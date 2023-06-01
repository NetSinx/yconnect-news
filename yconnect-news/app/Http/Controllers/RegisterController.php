<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    public function index()
    {
        return view('register.index');
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string',
            'username' => 'required|string|min:3|unique:users',
            'email' => 'required|string|unique:users|email:dns',
            'password' => ['required', 'string', Password::min(8)
                                                           ->mixedCase()
                                                           ->symbols()
                                                           ->numbers()
                          ],
            'confpassword' => 'required|string|same:password'
        ], [
            'nama.required' => 'Nama lengkap wajib diisi!',
            'username.required' => 'Username wajib diisi!',
            'username.min' => 'Username minimal 3 karakter!',
            'username.unique' => 'Username sudah ada yang menggunakan. Gunakan username yang lain!',
            'email.required' => 'Alamat email wajib diisi!',
            'email.unique' => 'Alamat email sudah terdaftar! Gunakan email yang lain.',
            'email.email.dns' => 'Format alamat email salah!',
            'password.required' => 'Password wajib diisi!',
            'password.min' => 'Password minimal 8 karakter!',
            'confpassword.required' => 'Konfirmasi password wajib diisi!',
            'confpassword.same' => 'Konfirmasi password tidak sama dengan isian password sebelumnya!'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        User::create([
            'name' => Str::title($request->nama),
            'slug' => Str::slug($request->nama),
            'username' => strtolower($request->username),
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        return redirect('/sign-in')->with('success', 'Registrasi berhasil. Silahkan login!');
    }
}
