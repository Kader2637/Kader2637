<?php
namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Auth\Events\PasswordReset;
use App\Http\Controllers\Controller;
use App\Models\User;

class ResetPasswordController extends Controller
{
    public function showResetForm()
    {
        return view('auth.passwords.reset');
    }

    public function reset(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|confirmed',
        ]);

        $user = User::where('email', $request->email)->first();

        if (! $user) {
            return back()->withErrors(['email' => 'Email tidak ditemukan']);
        }

        $user->password = bcrypt($request->password);
        $user->setRememberToken(Str::random(60));
        $user->save();

        event(new PasswordReset($user));

        return redirect('/login')->with('status', 'Password berhasil direset. Silakan masuk menggunakan password baru.');
    }
}
