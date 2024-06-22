<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\User;
use Carbon\Carbon;

class ProfileController extends Controller
{
    public function show($user_id = null): View {
        $user = (!$user_id) ? Auth::user() : User::find($user_id);
        return view('profile', compact('user'));
    }

    public function update(ProfileUpdateRequest $request, $user_id): RedirectResponse {
        
        try {

            $user = User::find($user_id);

            $user->user_first_name = $request->input('user_first_name');
            $user->user_last_name = $request->input('user_last_name');
            $user->user_username = $request->input('user_username');
            $user->user_email = $request->input('user_email');
            $user->user_phone_number = $request->input('user_phone_number');
            $user->user_address = $request->input('user_address');

            $user->save();

            return redirect()->back()->with('status', 'Perfil actualizado correctamente.');

        } catch (\Exception $e) {
            return Redirect::back()->withErrors(['error' => 'Ha ocurrido un error al actualizar el perfil.'])->withInput()->with('status', 'error');
        }

    }

    public function update_img($user_id) {

        try {

            $image_path = '/images/users/' . $user_id . '.jpg';    
            move_uploaded_file($_FILES['user_image_url']['tmp_name'], $_SERVER['DOCUMENT_ROOT'] . $image_path);

            $user = User::find($user_id);

            $user -> user_image_url = $image_path;

            $user -> save();
    
            return redirect()->back()->with('status', 'Foto de perfil actualizada correctamente.');

        } catch (\Exception $e) {
            return Redirect::back()->withErrors(['error' => 'Ha ocurrido un error al actualizar el perfil.'])->withInput()->with('status', 'error');
        }

    }

    public function delete_img($user_id) {
        try {
            $image_path = '/images/users/nf.jpg';
            
            $user = User::find($user_id);

            $user -> user_image_url = $image_path;

            $user -> save();
            
            return redirect()->back()->with('status', 'Foto de perfil actualizada correctamente.');
            
        } catch (\Exception $e) {
            return Redirect::back()->withErrors(['error' => 'Ha ocurrido un error al actualizar el perfil.'])->withInput()->with('status', 'error');
        }
    }
}
