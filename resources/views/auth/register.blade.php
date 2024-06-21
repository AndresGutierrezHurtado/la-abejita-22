@extends('layouts.secondary')

@section('title', 'Registro')

@section('content')

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />
    <main class="w-full min-h-screen flex items-center justify-center bg-center bg-no-repeat bg-cover bg-[url(/public/images/banner.jpg)] relative">
        <div class="absolute inset-0 bg-gradient-to-b from-black to-black opacity-[20%]"></div>
        <div class=" w-full p-10 bg-white shadow-lg rounded-md max-w-[600px] mx-auto z-50 my-10">

            <div class="text-center flex flex-col items-center justify-center gap-2 py-5">                
                <a href="{{ route('index') }}">
                    <div class="size-[130px] bg-center bg-no-repeat bg-cover bg-[url(/public/images/logo.png)] mx-auto rounded-full"></div>    
                </a>
                <h1 class="text-3xl font-bold tracking-tight capitalize">Crea tu cuenta</h1>
                <p>Crea tu cuenta para unirte a nuestra comunidad.</p>
            </div>
            <form method="POST" action="{{ route('register') }}">
                @csrf
                <!-- Uknow -->
                 <input type="hidden" name="role_id" value="1">
                <!-- First Name -->
                <div>
                    <x-input-label for="user_first_name" value="Nombres" />
                    <x-text-input id="user_first_name" class="block mt-1 w-full" type="text" name="user_first_name" :value="old('user_first_name')" required autofocus autocomplete="user_first_name" />
                    <x-input-error :messages="$errors->get('user_first_name')" class="mt-2" />
                </div>

                <!-- Last Name -->
                <div class="mt-4">
                    <x-input-label for="user_last_name" value="Apellidos" />
                    <x-text-input id="user_last_name" class="block mt-1 w-full" type="text" name="user_last_name" :value="old('user_last_name')" required autocomplete="user_last_name" />
                    <x-input-error :messages="$errors->get('user_last_name')" class="mt-2" />
                </div>

                <!-- Username -->
                <div class="mt-4">
                    <x-input-label for="user_username" value="Usuario" />
                    <x-text-input id="user_username" class="block mt-1 w-full" type="text" name="user_username" :value="old('user_username')" required autocomplete="user_username" />
                    <x-input-error :messages="$errors->get('user_username')" class="mt-2" />
                </div>

                <!-- Email Address -->
                <div class="mt-4">
                    <x-input-label for="user_email" value="Correo electrónico" />
                    <x-text-input id="user_email" class="block mt-1 w-full" type="email" name="user_email" :value="old('user_email')" required autocomplete="user_email" />
                    <x-input-error :messages="$errors->get('user_email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div class="mt-4">
                    <x-input-label for="password" value="Contraseña" />
                    <x-text-input id="password" class="block mt-1 w-full" type="password" name="user_password" required autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('user_password')" class="mt-2" />
                </div>

                <!-- Confirm Password -->
                <div class="mt-4">
                    <x-input-label for="password_confirmation" value="Confirmar contraseña" />
                    <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password" name="user_password_confirmation" required autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('user_password_confirmation')" class="mt-2" />
                </div>

                <button type="submit" class="mr-3 bg-amber-500 duration-300 hover:bg-amber-500/[0.80] hover:shadow-md px-5 py-1 rounded-md font-semibold w-full mt-5">
                    Regístrate
                </button>
            </form>

            <div class="relative flex py-5 items-center">
                <div class="flex-grow border-t border-gray-400"></div>
                <span class="flex-shrink mx-2 text-gray-400">Ó</span>
                <div class="flex-grow border-t border-gray-400"></div>
            </div>

            <div class="flex flex-col gap-4 mb-5">
                <button class="flex gap-3 items-center justify-center font-semibold text-sky-600 bg-zinc-100 rounded-lg py-1 px-5 border">
                    <i class="fa-brands fa-facebook text-xl"></i>
                    Regístrate con facebook
                </button>

                <button class="flex gap-3 items-center justify-center font-semibold text-slate-600 bg-zinc-100 rounded-lg py-1 px-5 border">
                    <i class="fa-brands fa-google text-xl"></i>
                    Regístrate con google
                </button>

            </div>
            
            @if (Route::has('login'))
                <p>
                    ¿Ya tienes una cuenta creada?
                    <a class="text-amber-400 font-semibold hover:underline" href="{{ route('login') }}">
                        Inicia sesión    
                    </a>
                </p>
            @endif
        </div>
    </main>

@endsection

