@extends('layouts.app')

@section('title', 'Inicio')

@section('content')
    <main class="flex flex-col gap-[100px]">
        <section class="w-full min-h-[400px] flex justify-center bg-center bg-no-repeat bg-cover bg-[url(/public/images/banner.jpg)] relative">
            <div class="absolute inset-0 bg-gradient-to-b from-black to-black opacity-[20%]"></div>
            <div class="flex gap-10 max-w-[1200px] z-10">
                <div class="flex flex-col justify-center items-center gap-4 text-center text-white h-full max-w-[750px]">
                    <h1 class="text-5xl font-bold tracking-tight mb-2">Uniformes Escolares</h1>
                    <p class="font-semibold text-[16px]">¡Bienvenidos a nuestra tienda en línea de uniformes escolares en Bogotá! Somos una empresa dedicada a 
                        ofrecer uniformes de alta calidad y durabilidad para estudiantes de todos los niveles escolares.</p>
                    <button class="py-1 px-5 rounded-lg bg-white shadow-lg font-semibold text-zinc-800 w-fit duration-300 hover:bg-zinc-200">Ver más</button>
                </div>
                
                @if (Route::has('login'))
                    @auth
                    <!-- Container mi cuenta -->
                    <article class="flex flex-col items-center gap-4 bg-black text-white text-center h-fit px-5 py-10 max-w-[280px]">
                        <h1 class="text-2xl font-bold mb-2">¡Bienvenido, {{ Auth::user() -> user_username }}!</h1>
                        <p>Nos alegra que seas un {{Auth::user() -> role_id }} de esta gran comunidad.</p>
                        <div></div>
                        <a href="{{ url('/profile') }}" type="button">Mi Cuenta</a>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <a href="{{ url('/logout') }}" type="button" 
                            onclick="event.preventDefault(); 
                            this.closest('form').submit();">
                            Cerrar Sesión
                            </a>
                        </form>
                        
                    </article> 
                @else
                    <!-- Container mi cuenta -->
                    <article class="flex flex-col items-center gap-4 bg-black text-white text-center h-fit px-5 py-10 max-w-[280px]">
                    <h1 class="text-2xl font-bold mb-2">Invitado</h1>
                        <p>Inicia sesión para poder disfrutar de una mejor experiencia de compras.</p>
                        <a href="{{ url('/login') }}" class="bg-white font-semibold w-fit py-1 px-5 text-black rounded-full hover:bg-zinc-200 duration-300"> Inicia Sesión </a>
                        <p>¿No tienes cuenta aún?, <a href="{{ url('/register') }}" class="text-amber-300 hover:underline">regístrate</a> </p>
                    </article> 
                    @endauth
                @endif
            </div>
        </section>
    </main>
@endsection
