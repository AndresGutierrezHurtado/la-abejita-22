<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    public function rules(): array
    {
        return [[
            'user_first_name' => 'required|string',
            'user_last_name' => 'required|string',
            'user_username' => 'required|string',
            'user_email' => 'required|email',
            'user_phone_number' => 'nullable|numeric',
            'user_address' => 'nullable|string',
        ]];
    }
}
