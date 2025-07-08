<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Contracts\Services\AuthServiceInterface;
use App\Infraestructure\Auth\SanctumProvider;

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

            if (!$response) {
                return redirect()->back()->with('error', 'Error al autenticar usuario')->withInput($request->all());
            }

            return redirect('/');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput($request->all());
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage())->withInput($request->all());
        }
    }

    public function register(Request $request)
    {
        try {
            $request->validate(
                [
                    'user_name' => 'required|string|max:255',
                    'user_lastname' => 'required|string|max:255',
                    'user_email' => 'required|email|unique:users,user_email',
                    'user_phone' => 'required|string|max:255',
                    'user_address' => 'required|string|max:255',
                    'user_password' => 'required|min:8',
                    'password_confirm' => 'required|same:user_password',
                    'policy_agreement' => 'required|boolean',
                ],
                [
                    'user_name.required' => 'El nombre es requerido',
                    'user_name.string' => 'El nombre debe ser una cadena de texto',
                    'user_name.max' => 'El nombre debe tener máximo 255 carácteres',
                    'user_lastname.required' => 'El apellido es requerido',
                    'user_lastname.string' => 'El apellido debe ser una cadena de texto',
                    'user_lastname.max' => 'El apellido debe tener máximo 255 carácteres',
                    'user_email.required' => 'El correo electrónico es requerido',
                    'user_email.email' => 'El correo electrónico ingresado debe ser válido',
                    'user_email.unique' => 'El correo electrónico ingresado ya está en uso',
                    'user_password.required' => 'La contraseña es requerida',
                    'user_phone.required' => 'El teléfono es requerido',
                    'user_phone.string' => 'El teléfono debe ser una cadena de texto',
                    'user_phone.max' => 'El teléfono debe tener máximo 255 carácteres',
                    'user_address.required' => 'La dirección es requerida',
                    'user_address.string' => 'La dirección debe ser una cadena de texto',
                    'user_address.max' => 'La dirección debe tener máximo 255 carácteres',
                    'user_password.min' => 'La contraseña debe tener mínimo 8 carácteres',
                    'password_confirm.required' => 'La confirmación de contraseña es requerida',
                    'password_confirm.same' => 'La confirmación de contraseña no coincide con la contraseña',
                    'policy_agreement.required' => 'Debes aceptar la política de privacidad y los términos',
                    'policy_agreement.boolean' => 'El campo de política de privacidad y los términos debe ser un booleano',
                ]
            );

            $response = $this->authService->register([
                'user_name' => $request->user_name,
                'user_lastname' => $request->user_lastname,
                'user_email' => $request->user_email,
                'user_phone' => $request->user_phone,
                'user_address' => $request->user_address,
                'user_password' => $request->user_password,
            ]);

            if (!$response) {
                return redirect()->back()->with('error', 'Error al registrar usuario')->withInput($request->all());
            }

            return redirect('/login')->with('success', 'Usuario registrado correctamente');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput($request->all());
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage())->withInput($request->all());
        }
    }
}
