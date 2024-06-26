@extends('layouts.secondary')

@section('title', 'Inicio de sesión')

@section('content')

<main class="w-full min-h-screen flex items-center justify-center bg-center bg-no-repeat bg-cover bg-[url(/public/images/banner.jpg)] relative px-5">
    <div class="absolute inset-0 bg-gradient-to-b from-black to-black opacity-[20%]"></div>
    <div class=" w-full p-10 bg-white shadow-lg rounded-md max-w-[550px] mx-auto z-50"> 
        <form method="POST" action="{{ route('password.store') }}">
            @csrf

            <!-- Password Reset Token -->
            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            <!-- Email Address -->
            <div>
                <x-input-label for="user_email" :value="'Correo electrónico'" />
                <x-text-input id="user_email" class="block mt-1 w-full" type="email" name="user_email" :value="old('user_email', $request->email)" required autofocus autocomplete="username" />
                <x-input-error :messages="$errors->get('user_email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-input-label for="user_password" :value="'Contraseña'" />
                <x-text-input id="user_password" class="block mt-1 w-full" type="password" name="user_password" required autocomplete="new-password" />
                <x-input-error :messages="$errors->get('user_password')" class="mt-2" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-input-label for="user_password_confirmation" :value="'Confirmar contraseña'" />

                <x-text-input id="user_password_confirmation" class="block mt-1 w-full"
                                    type="password"
                                    name="user_password_confirmation" required autocomplete="new-password" />

                <x-input-error :messages="$errors->get('user_password_confirmation')" class="mt-2" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-primary-button>
                    {{ __('Reset Password') }}
                </x-primary-button>
            </div>
        </form>
    </div>
</main>
@endsection
