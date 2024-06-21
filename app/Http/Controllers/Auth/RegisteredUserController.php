<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{

    public function create(): View {
        return view('auth.register');
    }

    public function store(Request $request): RedirectResponse {

        $request->validate([
            'user_first_name' => ['required', 'string', 'max:50'],
            'user_last_name' => ['required', 'string', 'max:50'],
            'user_username' => ['required', 'string', 'max:50'],
            'user_email' => ['required', 'string', 'lowercase', 'email', 'max:70', 'unique:'.User::class],
            'user_password' => ['required', 'confirmed', Rules\Password::defaults()]
        ]);

        $user = User::create([
            'user_first_name' => $request->user_first_name,
            'user_last_name' => $request->user_last_name,
            'user_username' => $request->user_username,
            'user_email' => $request->user_email,
            'role_id' => $request->role_id,
            'user_password' => Hash::make($request->user_password),
        ]);

        event(new Registered($user));

        return redirect(route('login', absolute: false));
    }
}
