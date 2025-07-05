<?php

namespace App\Http\Controllers;

class ViewController extends Controller
{
    public function welcome()
    {
        return view('welcome');
    }

    public function contact()
    {
        return view('contact');
    }
}
