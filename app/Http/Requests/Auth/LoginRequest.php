<?php

namespace App\Http\Requests\Auth;

use Illuminate\Auth\Events\Lockout;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class LoginRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'user_email' => ['required', 'string', 'email'],
            'user_password' => ['required', 'string'],
        ];
    }

    public function authenticate(): void
    {

        $credentials = [
            'user_email' => $this->input('user_email'),
            'user_password' => $this->input('user_password')
        ];

        if (! Auth::attempt($credentials, $this->boolean('remember'))) {

            throw ValidationException::withMessages([
                'user_email' => trans('auth.failed'),
            ]);
        }
    }

}
