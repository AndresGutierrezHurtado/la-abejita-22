@extends('layouts.secondary')

@section('title', 'Inicio de sesión')

@section('content')
    
    <main class="w-full min-h-screen flex items-center justify-center bg-center bg-no-repeat bg-cover bg-[url(/public/images/banner.jpg)] relative">
        <div class="absolute inset-0 bg-gradient-to-b from-black to-black opacity-[20%]"></div>
        <div class=" w-full p-5 md:p-10 bg-white shadow-lg rounded-md max-w-[550px] mx-auto z-50 my-10">

            <div class="text-center flex flex-col items-center justify-center gap-2 py-5">                
                <a href="{{ route('index') }}">
                    <div class="size-[130px] bg-center bg-no-repeat bg-cover bg-[url(/public/images/logo.png)] mx-auto rounded-full"></div>    
                </a>
                <h1 class="text-3xl font-bold tracking-tight capitalize">Inicia sesión</h1>
                <p class="text-lg">Accede a tu cuenta para disfrutar de una mejor experiencia.</p>
            </div>
            
            <form method="POST" action="{{ route('login') }}" class="">
                @csrf

                <!-- Session Status -->
                <x-auth-session-status class="mb-4" :status="session('status')" />
                <!-- Email Address -->
                <div>
                    <x-input-label for="user_email" value="Correo" />
                    <x-text-input id="user_email" class="block mt-1 w-full" 
                                    type="email" 
                                    name="user_email" 
                                    required autofocus/>
                    <x-input-error :messages="$errors->get('user_email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div class="mt-4">
                    <x-input-label for="user_password" value="Contraseña" />
                    <x-text-input id="user_password" class="block mt-1 w-full"
                                    type="password"
                                    name="user_password"
                                    required/>

                    <x-input-error :messages="$errors->get('user_password')" class="mt-2" />
                </div>

                <!-- Remember Me -->
                <div class="block mt-4">
                    <label for="remember_me" class="inline-flex items-center">
                        <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-amber-500 shadow-sm focus:ring-amber-500" name="remember">
                        <span class="ms-2 text-sm text-gray-600">Recuérdame</span>
                    </label>
                </div>

                <div class="flex flex-col gap-3 mt-4">
                    @if (Route::has('password.request'))
                        <p>
                            ¿Olvidaste tu contraseña?, 
                            <a class="text-amber-400 font-semibold hover:underline" href="{{ route('password.request') }}">
                                Recupérala    
                            </a>
                        </p>
                    @endif

                    <button type="submit" class="mr-3 bg-amber-500 duration-300 hover:bg-amber-500/[0.80] hover:shadow-md px-5 py-1 rounded-md font-semibold w-full">
                        Inicia sesión
                    </button>
                </div>
            </form>

            <div class="relative flex py-5 items-center">
                <div class="flex-grow border-t border-gray-400"></div>
                <span class="flex-shrink mx-2 text-gray-400">Ó</span>
                <div class="flex-grow border-t border-gray-400"></div>
            </div>

            <div class="flex flex-col gap-4 mb-5">
                
                <a href="{{ url('/login/facebook/redirect') }}" class="hidden w-full"> <!-- Cambiar de hidden a block cuando esté verificado en fb -->
                    <button class="flex gap-3 items-center justify-center font-semibold text-sky-600 bg-zinc-100 rounded-lg py-1 px-5 border w-full">
                        <i class="fa-brands fa-facebook text-xl"></i>
                        Ingresa con facebook
                    </button>
                </a>

                <a href="{{ url('/login/google/redirect') }}" class="block w-full">
                    <button class="flex gap-3 items-center justify-center font-semibold text-slate-600 bg-zinc-100 duration-300 hover:bg-zinc-200 rounded-lg py-1 px-5 border w-full">
                        <i class="fa-brands fa-google text-xl"></i>
                        Ingresa con google
                    </button>
                </a>

            </div>
            
            @if (Route::has('register'))
                <p>
                    ¿No tienes cuenta aún?, 
                    <a class="text-amber-400 font-semibold hover:underline" href="{{ route('register') }}">
                        Regístrate    
                    </a>
                </p>
            @endif
        </div>
    </main>

@endsection
