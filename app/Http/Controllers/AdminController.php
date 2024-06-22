<?php

namespace App\Http\Controllers;

use App\Models\School;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function users()    {
        return view('admin.dashboard.users', ['users' => User::paginate(10)]);
    }

    public function products()
    {
        $products = Product::with('schools')->paginate(5);
        
        return view('admin.dashboard.products', ['products' => $products,  ]);
    }

    public function schools()
    {
        return view('admin.dashboard.schools', ['schools' => School::paginate(10)]);
    }
}

