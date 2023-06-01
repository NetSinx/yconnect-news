<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\Rules\Password as RulesPassword;

class ResetPasswdController extends Controller
{
  public function index()
  {
    return view('reset-passwd.index');
  }

  public function sendResetPasswd(Request $request)
  {
    $request->validate(['email' => 'required|email:dns']);

    $status = Password::sendResetLink(
      $request->only('email')
    );

    return $status === Password::RESET_LINK_SENT
      ? back()->with(['status' => $status])
      : back()->withErrors(['email' => __($status)]);
  }

  public function formResetPasswd(string $token)
  {
    return view('reset-passwd.reset', ['token' => $token]);
  }

  public function resetPasswd(Request $request)
  {
    $request->validate([
      'token' => 'required',
      'email' => 'required|email',
      'password' => ['required', 'string', RulesPassword::min(8)
                                                    ->mixedCase()
                                                    ->symbols()
                                                    ->numbers()
                    ],
    ]);

    $status = Password::reset(
      $request->only('email', 'password', 'password_confirmation', 'token'),
      function (User $user, string $password) {
        $user->forceFill([
          'password' => Hash::make($password)
        ]);

        $user->save();

        event(new PasswordReset($user));
      }
    );

    return $status === Password::PASSWORD_RESET
      ? redirect()->route('login')->with('success', 'Password berhasil diperbarui!')
      : back()->withErrors(['email' => [__($status)]]);
  }
}
