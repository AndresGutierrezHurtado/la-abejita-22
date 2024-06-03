<?php

namespace App\Http\Controllers;

use App\Models\School;
use Illuminate\Http\Request;

class SchoolController extends Controller
{
    public function index()
    {
        // Obtiene todos los registros de la tabla 'posts'
        $schools = School::all();

        return view('index', compact('schools'));
    }
}
