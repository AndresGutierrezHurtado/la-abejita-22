<?php

namespace App\Http\Controllers;

use App\Models\School;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class SchoolController extends Controller
{
    public function index() {
        $schools = School::take(4)->get();

        return view('index', compact('schools'));
    }

    public function schools() {
        $schools = School::paginate(8);

        return view('schools', compact('schools'));
    }

    public function school($id) {
        $school = School::find($id);
        $products = $school -> products()->with('sizes')->paginate(8);

        return view('school', compact('school', 'products'));
    }

    public function store(Request $request): RedirectResponse
    {
        // Crear el colegio con nombre y dirección
        $school = new School();
        $school -> school_name = $request -> school_name;
        $school -> school_address = $request -> school_address;
        
        $school->save();

        // Manejar la subida de la imagen del logo del colegio si se proporciona
        if ($request->hasFile('school_image_url')) {
            $image = $request->file('school_image_url');
            $imageName = $school->school_id . '.jpg';
            $image->move(public_path('images/schools'), $imageName);
            $school->school_image_url = '/images/schools/' . $imageName;
            $school->save();
        }

        // Manejar la subida de la guía de uso (PDF) si se proporciona
        if ($request->hasFile('school_use_guide')) {
            $guide = $request->file('school_use_guide');
            $guideName = $school->id . '.pdf';
            $guide->move(public_path('pdf'), $guideName);
            $school->school_use_guide_url = '/pdf/' . $guideName;
            $school->save();
        }

        // Redirigir o devolver respuesta según sea necesario
        return redirect()->back()->with('status', 'Colegio creado exitosamente.');
    }

    public function profile($school_id) {

        $school = School::find($school_id);

        return view('admin.profile.school', ['school' => $school]);
    }

    public function update(Request $request, $school_id) {
        try {

            $school = School::find($school_id);

            $school->school_name = $request->input('school_name');
            $school->school_address = $request->input('school_address');

            $school->save();

            // Manejar la subida de la imagen del logo del colegio si se proporciona
            if ($request->hasFile('school_image_url')) {
                $image = $request->file('school_image_url');
                $imageName = $school->school_id . '.jpg';
                $image->move(public_path('images/schools'), $imageName);
                $school->school_image_url = '/images/schools/' . $imageName;
                $school->save();
            }

            // Manejar la subida de la guía de uso (PDF) si se proporciona
            if ($request->hasFile('school_use_guide')) {
                $guide = $request->file('school_use_guide');
                $guideName = $school->id . '.pdf';
                $guide->move(public_path('pdf'), $guideName);
                $school->school_use_guide_url = '/pdf/' . $guideName;
                $school->save();
            }
            
            Session::flash('status_profile', 'Perfil actualizado correctamente.');
            return redirect()->back();

        } catch (\Exception $e) {
            return Redirect::back()->withErrors(['error' => 'Ha ocurrido un error al actualizar el perfil.'])->withInput()->with('status', 'error');
        }
    }

    public function destroy($school_id) {        
        $school = School::findOrFail($school_id);

        $school->delete();

        return Redirect::back()->with('status', 'User deleted successfully.');
    }
}
