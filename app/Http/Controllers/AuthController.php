<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Contracts\Services\AuthServiceInterface;

class AuthController extends Controller
{
    protected $authService;

    public function __construct(AuthServiceInterface $authService)
    {
        $this->authService = $authService;
    }

    public function login(Request $request)
    {
        try {
            $request->validate(
                [
                    'user_email' => 'required|email',
                    'user_password' => 'required|min:8',
                    'user_remember' => 'nullable|boolean'
                ],
                [
                    'user_email.required' => 'El correo electrónico es requerido',
                    'user_email.email' => 'El correo electrónico ingresado debe ser válido',
                    'user_password.required' => 'La contraseña es requerida',
                    'user_password.min' => 'La contraseña debe tener mínimo 8 carácteres',
                    'user_remember.boolean' => 'El campo de recordar contraseña debe ser un booleano',
                ]
            );

            $response = $this->authService->login([
                'user_email' => $request->user_email,
                'user_password' => $request->user_password,
                'user_remember' => $request->user_remember ?? false,
            ]);

            if ($response) {
                return redirect('/');
            }

            return redirect()->back()->with('error', 'Error al autenticar usuario');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput($request->all());
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage())->withInput($request->all());
        }
    }
}
