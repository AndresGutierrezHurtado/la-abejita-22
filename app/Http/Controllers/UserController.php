<?php

namespace App\Http\Controllers;

use App\Contracts\Services\UserServiceInterface;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    private $userService;

    public function __construct(UserServiceInterface $userService)
    {
        $this->userService = $userService;
    }

    public function update(Request $request, $id)
    {
        try {
            $request->validate(
                [
                    'user_name' => 'required|string|max:255',
                    'user_lastname' => 'required|string|max:255',
                    'user_phone' => 'required|string|max:255',
                    'user_address' => 'required|string|max:255',
                    'user_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                    'role_id' => 'required|exists:roles,role_id',
                ],
                [
                    'user_name.required' => 'El nombre es requerido',
                    'user_name.string' => 'El nombre debe ser una cadena de texto',
                    'user_name.max' => 'El nombre debe tener menos de 255 caracteres',
                    'user_lastname.required' => 'El apellido es requerido',
                    'user_lastname.string' => 'El apellido debe ser una cadena de texto',
                    'user_lastname.max' => 'El apellido debe tener menos de 255 caracteres',
                    'user_phone.required' => 'El teléfono es requerido',
                    'user_phone.string' => 'El teléfono debe ser una cadena de texto',
                    'user_phone.max' => 'El teléfono debe tener menos de 255 caracteres',
                    'user_address.required' => 'La dirección es requerida',
                    'user_address.string' => 'La dirección debe ser una cadena de texto',
                    'user_image.image' => 'La imagen debe ser una imagen',
                    'user_image.mimes' => 'La imagen debe ser un archivo de imagen',
                    'user_image.max' => 'La imagen debe tener menos de 2MB',
                    'role_id.required' => 'El rol es requerido',
                    'role_id.exists' => 'El rol no existe',
                ]
            );

            $image = $request->file('user_image');

            $response = $this->userService->updateUser($id, [
                'user_name' => $request->user_name,
                'user_lastname' => $request->user_lastname,
                'user_phone' => $request->user_phone,
                'user_address' => $request->user_address,
                'user_image' => $image,
                'role_id' => $request->role_id,
            ]);

            return redirect()->back()->with('success', 'Usuario actualizado correctamente');
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage())->withInput();
        }
    }
}
