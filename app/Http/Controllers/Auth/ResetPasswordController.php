<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Support\Facades\Password;

class ResetPasswordController extends Controller
{
    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = '/login';

    /**
     * Get the password reset validation rules.
     *
     * @return array
     */
    protected function rules()
    {
        return [
            'email' => 'required|email',
            'password' => 'required|min:4|confirmed',
        ];
    }

    protected function validationErrorMessages()
    {
        return [
            'password.min' => 'Password harus memiliki minimal 4 karakter',
            'password.confirmed' => 'Konfirmasi password harus sama dengan password',

        ];
    }

    /**
     * Reset the given user's password.
     *
     * @param  \Illuminate\Contracts\Auth\CanResetPassword  $user
     * @param  string  $password
     * @return void
     */
    protected function reset($user, $password)
    {
        if (!empty($password)) {
            $user->password = bcrypt($password);
            $user->save();
        }
    }

    /**
     * Reset the given user's password.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    public function resetPassword(Request $request)
    {
        $request->validate($this->rules(), $this->validationErrorMessages());

        // Find the user by email
        $user = User::where('email', $request->email)->first();

        // Return error message if email address not found
        if (!$user) {
            return back()->withInput($request->only('email'))
                        ->withErrors(['email' => 'Email tidak ada ']);
        }

        // Reset the password
        $this->reset($user, $request->password);

        // Log the user in automatically after resetting their password
        auth()->login($user);

        // Redirect the user to the home page
        return redirect($this->redirectTo);
    }
}
