@extends('layouts.secondary')

@section('title', 'Contraseña olvidada')

@section('content')


    <main class="w-full min-h-screen flex flex-col items-center justify-center bg-center bg-no-repeat bg-cover bg-[url(/public/images/banner.jpg)] relative">
        <div class="p-5 bg-white rounded-lg shadow-lg flex flex-col gap-5 max-w-[800px]">  
            <div class="flex flex-col gap-2">                
                <h1 class="text-3xl font-bold tracking-tight text-zinc-800 ">Recupera tu contraseña</h1>
                <p class="text-lg text-zinc-800"> 
                    ¿Olvidaste tu contraseña?, no hay problema. Ingresa tu dirección de correo electrónico y te enviaremos el link para recuperar tu contraseña.
                </p>
            </div>
                
            <form method="POST" action="{{ route('password.email') }}" class="flex flex-col gap-4">
                @csrf
                    
                <!-- Session Status -->
                <x-auth-session-status :status="session('status')" />

                <!-- Email Address -->
                <div>
                    <x-input-label for="email" :value="__('Correo electrónico')" />
                    <x-text-input id="email" class="block mt-1 w-full" type="email" name="user_email" required autofocus />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>
        
                <div class="flex items-center justify-end">
                    <x-primary-button>
                        Enviar
                    </x-primary-button>
                </div>
            </form>
        </div>
    </main>

@endsection
