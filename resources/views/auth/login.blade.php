@extends('layouts.secondary')

@section('title', 'Inicio de sesión')

@section('content')

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />
    <main class="w-full min-h-screen flex items-center justify-center bg-center bg-no-repeat bg-cover bg-[url(/public/images/banner.jpg)] relative">
        <div class="absolute inset-0 bg-gradient-to-b from-black to-black opacity-[20%]"></div>
        <div class=" w-full p-10 bg-white shadow-lg rounded-md max-w-[500px] mx-auto z-50">

            <div class="text-center flex flex-col items-center justify-center gap-2 py-5">                
                <a href="{{ route('index') }}">
                    <div class="size-[150px] bg-center bg-no-repeat bg-cover bg-[url(/public/images/logo.png)] mx-auto rounded-full"></div>    
                </a>
                <h1 class="text-3xl font-bold tracking-tight capitalize">Inicia sesión</h1>
                <p>Accede a tu cuenta para disfrutar de una mejor experiencia.</p>
            </div>
            
            <form method="POST" action="{{ route('login') }}" class="">
                @csrf

                <!-- Email Address -->
                <div>
                    <x-input-label for="user_email" value="Correo" />
                    <x-text-input id="user_email" class="block mt-1 w-full" type="email" name="user_email" :value="old('user_email')" required autofocus autocomplete="user_email" />
                    <x-input-error :messages="$errors->get('user_email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div class="mt-4">
                    <x-input-label for="user_password" value="Contraseña" />

                    <x-text-input id="user_password" class="block mt-1 w-full"
                                    type="password"
                                    name="user_password"
                                    required autocomplete="user_password" />

                    <x-input-error :messages="$errors->get('user_password')" class="mt-2" />
                </div>

                <!-- Remember Me -->
                <div class="block mt-4">
                    <label for="remember_me" class="inline-flex items-center">
                        <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-amber-500 shadow-sm focus:ring-amber-500" name="remember">
                        <span class="ms-2 text-sm text-gray-600">Recuérdame</span>
                    </label>
                </div>

                <div class="flex flex-col justify-center gap-3 items-center mt-4">
                    <button type="submit" class="mr-3 bg-amber-500 duration-300 hover:bg-amber-500/[0.80] hover:shadow-md px-5 py-1 rounded-md font-semibold w-full">
                        Inicia sesión
                    </button>

                    @if (Route::has('password.request'))
                        <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md" href="{{ route('password.request') }}">
                            ¿Olvidaste tu contraseña?
                        </a>
                    @endif
                </div>
            </form>

            <div class="relative flex py-5 items-center">
                <div class="flex-grow border-t border-gray-400"></div>
                <span class="flex-shrink mx-2 text-gray-400">Ó</span>
                <div class="flex-grow border-t border-gray-400"></div>
            </div>
            
            @if (Route::has('register'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md" href="{{ route('register') }}">
                    ¿No tienes cuenta aún?
                </a>
            @endif
        </div>
    </main>

@endsection
