<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Order;
use App\Models\Product;
use App\Models\Size;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;

class ProfileController extends Controller
{
    public function show(Request $request, $user_id = null) {

        $user = (!$user_id) ? Auth::user() : User::find($user_id);

        if ( Auth::user()->role_id == 2 || Auth::user()->user_id == $user -> user_id) {
            $orders = Order::where('user_id', $user -> user_id)
            ->join('payments_details', 'orders.order_id', '=', 'payments_details.order_id')
            ->with('paymentDetails', 'soldProducts.product')
            ->orderBy(($request -> input('order') ?? 'created_at'), 'asc')
            ->paginate(10);

            foreach ($orders as &$order) {
                foreach ($order -> soldProducts as $product){
                    $product -> size_name = Size::findOrFail($product -> size_id)->size_name;
                }                
            }
            return view('profile', compact('user', 'orders'));
        } else {
            return redirect('/');
        }

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

            Session::flash('status_profile', 'Perfil actualizado correctamente.');
            return redirect()->back();

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

            Session::flash('status_image', 'Foto de perfil actualizada correctamente.');
            return redirect()->back();

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
            
            Session::flash('status_image', 'Foto de perfil actualizada correctamente.');
            return redirect()->back();
            
        } catch (\Exception $e) {
            return Redirect::back()->withErrors(['error' => 'Ha ocurrido un error al actualizar el perfil.'])->withInput()->with('status', 'error');
        }
    }
    
    public function destroy(Request $request, $user_id = null): RedirectResponse
    {
        // Si el usuario autenticado es el mismo que el usuario a eliminar
        $user = User::findOrFail($user_id);

        if ($request->user()->user_id == $user_id) {
            // Eliminar el usuario
            $user->delete();

            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return Redirect::to('/');

        } else if ($request->user()->role_id == 2) {
            // Eliminar el usuario
            $user->delete();

            return Redirect::back()->with('status', 'User deleted successfully.');
        }
        // Si el usuario no es administrador y no es el mismo, redirigir con un error (caso de seguridad)
        return Redirect::back()->withErrors(['error' => 'Unauthorized action.']);
    }

    public function order($order_id) {
        
        $order = Order::with('paymentDetails', 'soldProducts.product.sizes')->findOrFail($order_id);
        foreach ($order -> soldProducts as $product){
            $product -> size = $product -> product -> sizes -> firstWhere('size_id', $product -> size -> size_id);
            // $item['size_price'] = $item['product']->sizes->firstWhere('size_id', $item['size_id'])->pivot->product_size_price;
        }

        if ( Auth::user()->role_id == 2 || Auth::user()->user_id == $order -> user_id) {
            return view('order', compact('order'));
        } else {
            redirect()->to('/');
        }
    }

}
