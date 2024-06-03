@extends('layouts.app')

@section('title', 'Inicio')

@section('content')
    <main class="flex flex-col">
        <section class="w-full min-h-[400px] flex justify-center bg-center bg-no-repeat bg-cover bg-[url(/public/images/banner.jpg)] relative">
            <div class="absolute inset-0 bg-gradient-to-b from-black to-black opacity-[20%]"></div>
            <div class="flex justify-between gap-5 w-full max-w-[1200px] z-10">
                <div class="flex flex-col justify-center items-center gap-4 text-center text-white h-full max-w-[750px]">
                    <h1 class="text-5xl font-bold tracking-tight mb-2">Uniformes Escolares</h1>
                    <p class="font-semibold text-[18px]">¡Bienvenidos a nuestra tienda en línea de uniformes escolares en Bogotá! Somos una empresa dedicada a 
                        ofrecer uniformes de alta calidad y durabilidad para estudiantes de todos los niveles escolares.</p>
                    <button class="py-1 px-8 rounded-xl bg-white shadow-lg font-semibold text-zinc-800 text-lg w-fit duration-300 hover:bg-zinc-200">
                        Ver más
                    </button>
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
                    <article class="flex flex-col items-center gap-5 bg-black text-white text-center h-fit px-7 py-10 max-w-[320px]">
                    <h1 class="text-3xl font-bold mb-2">Invitado</h1>
                        <p>Inicia sesión para poder disfrutar de una mejor experiencia de compras.</p>
                        <a href="{{ url('/login') }}" class="bg-white font-semibold w-fit py-1 px-7 text-black rounded-full hover:bg-zinc-200 duration-300 text-lg"> 
                            Inicia Sesión 
                        </a>
                        <p>¿No tienes cuenta aún?, <a href="{{ url('/register') }}" class="text-amber-300 hover:underline">regístrate</a> </p>
                    </article> 
                    @endauth
                @endif
            </div>
        </section>
        <section class="w-full flex justify-center">
            <div class="w-full max-w-[1200px] flex flex-col gap-5 py-10">
                <div class="w-full text-center flex flex-col items-center gap-3">
                    <h1 class="text-5xl font-bold tracking-tight">Colegios</h1>
                    <p class="max-w-[600px]">Busca aquí el colegio junto a su uniforme.</p>
                </div>
                <div class="grid grid-cols-[repeat(auto-fill,_minmax(230px,_1fr))] gap-10">
                    @foreach ( $schools as $school )

                        <article class="w-full max-w-[250px] border border-zinc-300 bg-white rounded-xl mx-auto">
                            <a href="/colegios/{{$school -> school_id}}" class="flex justify-center items-center p-2">
                                <img src="{{$school -> school_image_url}}" alt="logo-agm" class=" max-h-[190px]">
                            </a>
                            <hr class="border-zinc-300">
                            <div class="p-3 text-xl font-bold text-center">
                                <h1>{{$school -> school_name}}</h1>
                            </div>
                        </article>

                    @endforeach
                </div>
                <a href="{{url('/colegios')}}" class="w-fit py-1 px-10 bg-amber-500 rounded-md font-semibold text-lg mx-auto shadow-sm ">
                    Ver más colegios
                </a>
            </div>
        </section>
        <section class="w-full flex flex-col items-center bg-zinc-800">
            <div class="w-full max-w-[1200px] flex gap-10 py-10 text-white">
                <div class="w-full md:w-1/2 flex flex-col gap-2">
                    <h2 class="text-2xl font-bold tracking-tight mb-2">Sobre Nosotros</h2>
                    <p>
                        Nuestra empresa de uniformes escolares, ubicada en el barrio El Ensueño, nos enorgullece brindar productos de calidad 
                        y servicio excepcional a la comunidad educativa. Nos dedicamos a diseñar y confeccionar uniformes escolares duraderos, 
                        cómodos y elegantes, utilizando materiales de primera calidad que garantizan tanto la comodidad como la durabilidad.
                    </p>
                    <p>
                        Estamos comprometidos con la excelencia en cada paso del proceso, desde la selección de telas hasta la atención personalizada, 
                        asegurando que cada detalle cumpla con los estándares más altos. En nuestra empresa de uniformes escolares, nos esforzamos por 
                        hacer de la experiencia de comprar uniformes un momento placentero y satisfactorio para padres y estudiantes.
                    </p>
                </div>
                <div class="w-full md:w-1/2">
                    <h2 class="text-2xl font-bold tracking-tight mb-4">Nuestras fortalezas</h2>
                    <div class="flex flex-col gap-5">
                        <div class="flex flex-col gap-2">
                            <span class="flex justify-between">
                                <p>Calidad de la tela</p>
                                <p class="font-semibold">97%</p>
                            </span>
                            <span class="h-5 w-full block rounded-sm bg-slate-200 overflow-hidden">
                                <span class="h-full w-[97%] block bg-orange-400"></span>
                            </span>
                        </div>
                        <div class="flex flex-col gap-2">
                            <span class="flex justify-between">
                                <p>Calidad del servicio</p>
                                <p class="font-semibold">92%</p>
                            </span>
                            <span class="h-5 w-full block rounded-sm bg-slate-200 overflow-hidden">
                                <span class="h-full w-[92%] block bg-orange-400"></span>
                            </span>
                        </div>
                        <div class="flex flex-col gap-2">
                            <span class="flex justify-between">
                                <p>Rapidez de entrega</p>
                                <p class="font-semibold">95%</p>
                            </span>
                            <span class="h-5 w-full block rounded-sm bg-slate-200 overflow-hidden">
                                <span class="h-full w-[95%] block bg-orange-400"></span>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="w-full flex flex-col items-center">
            <div class="w-full max-w-[1200px] flex flex-col gap-5 py-10">
                <div class="w-full text-center flex flex-col items-center gap-3">
                    <h1 class="text-[45px] font-bold tracking-tight">¿Por qué escogernos?</h1>
                </div>
                <div class="w-full flex justify-between">
                    <div class="flex flex-col justify-center items-center gap-10">
                        <article class="w-full max-w-[310px] flex flex-col gap-2 items-center text-center">
                            <span class="size-[60px] flex items-center justify-center rounded-full bg-green-400">
                                <i class="fa-solid fa-truck text-[30px] text-white"></i>
                            </span>
                            <h3 class="text-xl font-extrabold tracking-tight">Domicilios</h3>
                            <p class="text-md">Operamos en Bogotá y puedes pagar a través de nuestra pasarela de pagos.</p>
                        </article>
                        <article class="w-full max-w-[310px] flex flex-col gap-2 items-center text-center">
                            <span class="size-[60px] flex items-center justify-center rounded-full bg-teal-400">
                                <i class="fa-solid fa-shirt text-[33px] text-white"></i>
                            </span>
                            <h3 class="text-xl font-extrabold tracking-tight">Alta calidad</h3>
                            <p class="text-md">Contamos con los mejores materiales para la creación de nuestros uniformes.</p>
                        </article>
                    </div>
                    <div class="size-[400px] rounded-full overflow-hidden border-dashed border-8 border-orange-400 ">
                        <img src="/images/foto-seccion.jpg"
                        alt="foto-seccion.jpg" class="min-h-full min-w-full h-auto w-auto object-cover">
                    </div>
                    <div class="flex flex-col justify-center items-center gap-10">
                        <article class="w-full max-w-[310px] flex flex-col gap-2 items-center text-center">
                            <span class="size-[60px] flex items-center justify-center rounded-full bg-pink-400">
                                <i class="fa-regular fa-handshake text-[30px] text-white"></i>
                            </span>
                            <h3 class="text-xl font-extrabold tracking-tight">Fácil y rápido</h3>
                            <p class="text-md">
                                Un sitio web fácil de usar: busca el colegio, 
                                elige los productos, ingresa tus datos de entrega,
                                recíbe los productos en la comodidad de tu casa.
                            </p>
                        </article>
                        <article class="w-full max-w-[310px] flex flex-col gap-2 items-center text-center">
                            <span class="size-[60px] flex items-center justify-center rounded-full bg-yellow-400">
                                <i class="fa-solid fa-gem text-[35px] text-white"></i>
                            </span>
                            <h3 class="text-xl font-extrabold tracking-tight">Elige tu talla</h3>
                            <p class="text-md">¿Tienes dudas sobre cuál talla escoger? <br> Aquí te enseñamos como.</p>
                        </article>
                    </div>
                </div>
            </div>
        </section>
        <section class="w-full flex flex-col items-center">
            <div class="w-full max-w-[1200px] py-10">
                <!-- Recuadro con formulario de envío --> 
                <div class="flex bg-white rounded-lg overflow-hidden shadow-lg">
                    <div class="p-5 flex flex-col gap-3 md:px-8">
                        <h1 class="text-2xl font-bold tracking-tight">¡Queremos escucharte!</h1>
                        <p>Te invitamos a compartir todas sus preguntas, quejas y reclamos para que juntos podamos mejorar y brindarles una experiencia excepcional.</p>
                        <form action="" class="w-full flex flex-col gap-4">
                            @csrf
                            <div class="flex w-full gap-4">
                                <div class="flex flex-col gap-2 w-full md:w-1/2">
                                    <x-input-label for="user_full_name" value="Nombre" />
                                    <x-text-input type="email" id="user_full_name" class="" name="user_full_name" required autofocus />
                                </div>
                                <div class="flex flex-col gap-2 w-full md:w-1/2">
                                    <x-input-label for="user_email" value="Correo Electrónico" />
                                    <x-text-input type="email" id="user_email" class="" name="user_email" required autofocus />
                                </div>
                            </div>
                            <div class="flex flex-col gap-2 w-full">
                                <x-input-label for="email_subject" value="Asunto" />
                                <x-text-input type="text" id="email_subject" class="" name="email_subject" required autofocus />
                            </div>
                            <div class="flex flex-col gap-2 w-full">
                                <x-input-label for="email_message" value="Mensaje" />
                                <textarea name="email_message" id="email_message" required autofocus
                                class="border-gray-300 rounded-md shadow-sm resize-none h-[100px]"></textarea>
                            </div>
                            <button class="py-1 px-7 bg-slate-100 rounded-md font-semibold text-slate-600 w-fit border">Enviar</button>
                        </form>
                    </div>
                    <div class="bg-orange-400 w-full max-w-[300px] p-5 flex flex-col gap-3">
                        <h1 class="text-2xl font-bold tracking-tight">Contáctanos</h1>
                        <p>Especialistas en uniformes escolares en Bogotá, Colombia. Descubre calidad y variedad en nuestras tiendas.</p>
                        <div class="flex flex-col gap-4">
                            <span class="flex items-center gap-2">
                                <div class="size-[40px] flex-none flex items-center justify-center rounded-full border border-black">
                                    <i class="fa-solid fa-location-dot"></i>
                                </div>
                                <p><a class="font-semibold">Dirección:</a> Diagonal 60 D Sur 70 c 31</p>
                            </span>
                            <span class="flex items-center gap-2">
                                <div class="size-[40px] flex-none flex items-center justify-center rounded-full border border-black">
                                    <i class="fa-solid fa-phone"></i>
                                </div>
                                <p><a class="font-semibold">Teléfono:</a> 312 4852078</p>
                            </span>
                            <span class="flex items-center gap-2">
                                <div class="size-[40px] flex-none flex items-center justify-center rounded-full border border-black">
                                    <i class="fa-regular fa-envelope"></i>
                                </div>
                                <p><a class="font-semibold">Correo:</a> Laabejita.uni@gmail.com</p>
                            </span>
                        </div>

                        <div class="w-full flex justify-center items-center gap-5 mt-2 text-2xl">
                            <div class="size-[50px] flex-none flex items-center justify-center rounded-full border border-black duration-300 hover:scale-105 hover:shadow-lg cursor-pointer">
                                <i class="fab fa-whatsapp"></i>
                            </div>
                            <div class="size-[50px] flex-none flex items-center justify-center rounded-full border border-black duration-300 hover:scale-105 hover:shadow-lg cursor-pointer">
                                <i class="fab fa-facebook"></i>
                            </div>
                            <div class="size-[50px] flex-none flex items-center justify-center rounded-full border border-black duration-300 hover:scale-105 hover:shadow-lg cursor-pointer">
                                <i class="fab fa-instagram"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection