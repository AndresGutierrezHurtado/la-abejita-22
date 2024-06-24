<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class NewPasswordController extends Controller
{
    /**
     * Display the password reset view.
     */
    public function create(Request $request): View
    {
        return view('auth.reset-password', ['request' => $request]);
    }

    public function store(Request $request): RedirectResponse
    {
        // Validación de los datos recibidos
        $request->validate([
            'token' => 'required',
            'user_email' => 'required|email',
            'user_password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        // Proceso de restablecimiento de contraseña
        $status = Password::reset(
            $request->only('user_email', 'user_password', 'user_password_confirmation', 'token'),
            function ($user, $password) use ($request) {
                $user->forceFill([
                    'user_password' => Hash::make($password), 
                ])->save();

                event(new PasswordReset($user));
            }
        );

        // Redirección basada en el resultado del restablecimiento de contraseña
        if ($status == Password::PASSWORD_RESET) {
            return redirect()->route('login')->with('status', __($status));
        }

        // En caso de error en el restablecimiento, se lanza una excepción de validación
        return back()->withInput($request->only('user_email'))
                     ->withErrors(['user_email' => trans($status)]);
    }
}
