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

    /**
     * Auth routes
     */
    public function login()
    {
        return view('auth.login');
    }

    public function register()
    {
        return view('auth.register');
    }

    public function forget()
    {
        return view('auth.forget');
    }

    public function authcode()
    {
        return view('auth.authcode');
    }

    public function reset()
    {
        return view('auth.reset');
    }
}
