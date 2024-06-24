<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;

class AuthController extends Controller
{
    public function facebook_redirect() {
        return Socialite::driver('facebook')->redirect();
    }

    public function facebook_callback() {
        $user = Socialite::driver('facebook')->user();
        $user -> role_id  = 1;

        $user = User::firstOrCreate([
            'user_email' => $user -> getEmail(),
        ],[
            'user_first_name' => $user -> getName(),
            'user_last_name' => $user -> getName(),
            'user_username' => $user -> getNickname(),
            'user_image_url' => $user -> getAvatar(),
            'role_id' => 1,
        ]);

        auth() -> login($user);
        return redirect()->to('/');
    }

    public function google_redirect() {
        return Socialite::driver('google')->redirect();

    }
    
    public function google_callback() {
        $user = Socialite::driver('google')->user();

        $user = User::firstOrCreate([
            'user_email' => $user -> getEmail(),
        ],[
            'user_first_name' => explode(' ', $user -> getName())[0],
            'user_last_name' => implode(' ', array_slice(explode(' ', $user->getName()), 1)),
            'user_username' => $user -> getNickname() ?? explode(' ', $user -> getName())[0] . '_' . explode(' ', $user -> getName())[1],
            'user_image_url' => $user -> getAvatar(),
            'role_id' => 1,
        ]);
        
        auth() -> login($user);
        return redirect()->to('/');
    }
}
