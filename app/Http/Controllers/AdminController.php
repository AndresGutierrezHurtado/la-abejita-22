<?php

namespace App\Http\Controllers;

use App\Models\School;
use App\Models\Product;
use App\Models\User;
use App\Models\Size;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function users(Request $request)    {
        
        $query = User::query();

        if ($request->has('search')) {
            $searchTerm = $request->input('search');
            $query->where(function ($query) use ($searchTerm) {
                $query->where('user_first_name', 'like', '%' . $searchTerm . '%')
                      ->orWhere('user_last_name', 'like', '%' . $searchTerm . '%')
                      ->orWhere('user_username', 'like', '%' . $searchTerm . '%')
                      ->orWhere('user_id', 'like', '%' . $searchTerm . '%')
                      ->orWhere('user_email', 'like', '%' . $searchTerm . '%');
            });
        }

        $query->orderBy(($request->input('order') ?? 'user_id'), 'asc');

        $users = $query->paginate(10);

        return view('admin.dashboard.users', ['users' => $users]);
    }

    public function products(Request $request)
    {

        $query = Product::query();

        if ($request->has('search')) {
            $query->where('product_name', 'like', '%' . $request->input('search') . '%');
        }

        $query->orderBy(($request->input('order') ?? 'product_id'), 'asc');
        

        $products = $query->with('schools')->paginate(5);
        $schools = School::all();
        $sizes = Size::all();
        
        return view('admin.dashboard.products', ['products' => $products, 'schools' => $schools, 'sizes' => $sizes]);
    }

    public function schools(Request $request)
    {
        $query = School::query();

        if ($request->has('search')) {
            $query->where('school_name', 'like', '%' . $request->input('search') . '%');
        }

        $query->orderBy(($request->input('order') ?? 'school_id'), 'asc');
        

        $schools = $query->paginate(10);

        return view('admin.dashboard.schools', ['schools' => $schools]);
    }
}

