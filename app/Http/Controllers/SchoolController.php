<?php

namespace App\Http\Controllers;

use App\Models\School;
use Illuminate\Http\Request;

class SchoolController extends Controller
{
    public function index() {
        $schools = School::take(4)->get();

        return view('index', compact('schools'));
    }

    public function schools() {
        $schools = School::all();

        return view('schools', compact('schools'));
    }

    public function school($id) {
        $school = School::find($id);
        $products = $school -> products()->with('sizes')->paginate(8);

        return view('school', compact('school', 'products'));
    }
}
