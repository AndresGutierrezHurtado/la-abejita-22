<?php

namespace App\Http\Controllers;

use App\Contracts\Services\UserServiceInterface;
use App\Contracts\Services\AuthServiceInterface;

class ViewController extends Controller
{
    protected $userService;
    protected $userSession;

    public function __construct(UserServiceInterface $userService, AuthServiceInterface $authService)
    {
        $this->userService = $userService;
        $this->userSession = $authService->getUser();
    }

    public function welcome()
    {
        return view('welcome');
    }

    public function contact()
    {
        return view('contact');
    }

    public function schools()
    {
        return view('schools');
    }

    public function products()
    {
        return view('products');
    }

    public function product()
    {
        return view('product');
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

    /**
     * Profile routes
     */
    public function profile()
    {
        return view('app.profile', [
            'user' => $this->userSession,
        ]);
    }

    public function cart()
    {
        return view('app.cart');
    }

    public function orders()
    {
        return view('app.orders');
    }

    public function schoolManagement()
    {
        return view('app.school-management');
    }

    public function productManagement()
    {
        return view('app.product-management');
    }

    public function userManagement()
    {
        return view('app.user-management');
    }

    public function orderManagement()
    {
        return view('app.order-management');
    }
}
