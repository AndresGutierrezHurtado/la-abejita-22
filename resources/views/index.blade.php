@extends('layouts.app')

@section('title', 'Inicio')

@section('content')
    <main class="flex flex-col">
        <section class="w-full min-h-[400px] px-5 flex justify-center bg-center bg-no-repeat bg-cover bg-[url(/public/images/banner.jpg)] relative">
            <div class="absolute inset-0 bg-gradient-to-b from-black to-black opacity-[20%]"></div>
            <div class="flex flex-col sm:flex-row justify-between gap-5 w-full max-w-[1200px] z-10 py-10 sm:py-0">
                <div class="flex flex-col justify-center items-center gap-4 text-center text-white h-full max-w-[750px]">
                    <h1 class="text-5xl font-bold tracking-tight mb-2">Uniformes Escolares</h1>
                    <p class="font-semibold text-[18px]">¡Bienvenidos a nuestra tienda en línea de uniformes escolares en Bogotá! Somos una empresa dedicada a 
                        ofrecer uniformes de alta calidad y durabilidad para estudiantes.</p>
                    <a href="{{ url('/colegios') }}">                        
                        <button class="py-1 px-8 rounded-xl bg-white shadow-lg font-semibold text-zinc-800 text-lg w-fit duration-300 hover:bg-zinc-200">
                            Ver más
                        </button>
                    </a>
                </div>
                
                @if (Route::has('login'))
                    @auth
                    <!-- Container mi cuenta -->
                    <article class="flex flex-col items-center gap-4 bg-black text-white text-center h-fit px-5 py-10 max-w-[280px] min-w-[260px] mx-auto rounded-md sm:rounded-t-none mb-[20px]">
                        <h1 class="text-2xl font-bold mb-2">¡Bienvenido, {{ Auth::user() -> user_first_name }}!</h1>
                        <p>Nos alegra que seas un <a class="font-semibold text-amber-100">{{ Auth::user() -> role -> role_name }}</a> de esta gran comunidad.</p>
                        <div></div>
                        <a href="{{ url('/profile/user') }}" type="button"
                            class="rounded-md px-3 py-1 border-2 border-white font-semibold">
                            <i class="fa-solid fa-user mr-2"></i>
                            Mi Cuenta
                        </a>
                        @if (Auth::user() -> role -> role_name == 'administrador')
                            <a href="{{ url('/dashboard/users') }}" type="button"
                            class="rounded-md px-3 py-1 border-2 border-white font-semibold">
                                <i class="fa-solid fa-gear mr-2"></i>
                                Administrador
                            </a>
                        @endif
                        <form method="POST" action="{{ url('/logout') }}" onsubmit="alert('estás esguro que quieres cerrar sesión?')">
                            @csrf

                            <button class="bg-red-600 duration-300 hover:bg-red-700 border-2 border-transparent rounded-md px-3 py-1 font-semibold">
                            <i class="fa-solid fa-right-from-bracket mr-2"></i>
                                Cerrar Sesión
                            </button>
                        </form>
                        
                    </article>
                @else
                    <!-- Container inicio sesión -->
                    <article class="flex flex-col items-center gap-5 bg-black text-white text-center h-fit px-7 py-10 max-w-[320px] min-w-[260px] mx-auto rounded-md sm:rounded-t-none mb-[20px]">
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
        <section class="w-full flex justify-center px-5">
            <div class="w-full max-w-[1200px] flex flex-col gap-10 py-10">
                <div class="w-full text-center flex flex-col items-center gap-3">
                    <h1 class="text-5xl font-bold tracking-tight">Colegios</h1>
                    <p class="max-w-[600px]">Busca aquí el colegio junto a su uniforme.</p>
                </div>
                <div class="grid grid-cols-[repeat(auto-fill,_minmax(230px,_1fr))] gap-10">
                    @foreach ( $schools as $school )

                        <article class="w-full max-w-[250px] border border-zinc-300 bg-white rounded-xl mx-auto shadow-md duration-300 hover:shadow-lg hover:scale-[1.03]">
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
                <a href="{{url('/colegios')}}" id="about" class="w-fit py-1 px-10 bg-amber-500 rounded-md font-semibold text-lg mx-auto shadow-sm duration-300 hover:translate-y-1 hover:shadow-md hover:scale-[1.02]">
                    Ver más colegios
                </a>
            </div>
        </section>

        <section class="w-full flex flex-col items-center bg-zinc-800 px-5">
            <div class="w-full max-w-[1200px] flex flex-col md:flex-row gap-10 py-10 text-white">
                <div class="w-full md:w-1/2 flex flex-col gap-2">
                    <h2 class="text-2xl font-bold tracking-tight mb-2">Sobre Nosotros</h2>
                    <p>
                        Nuestra empresa de uniformes escolares, ubicada en el barrio El Ensueño, nos enorgullece brindar productos de calidad 
                        y servicio excepcional a la comunidad educativa. Nos dedicamos a diseñar y confeccionar uniformes escolares duraderos, 
                        cómodos y elegantes, utilizando materiales de primera calidad que garantizan tanto la comodidad como la durabilidad.
                    </p>
                    <p class="hidden md:block">
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

        <section class="w-full flex flex-col items-center px-5">
            <div class="w-full max-w-[1200px] flex flex-col gap-5 py-10">
                <div class="w-full text-center flex flex-col items-center gap-3">
                    <h1 class="text-[45px] font-bold tracking-tight">¿Por qué escogernos?</h1>
                </div>
                <div class="w-full flex flex-col md:flex-row justify-between items-center gap-10">
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
                    <div class="w-full aspect-square max-w-[400px] rounded-full overflow-hidden border-dashed border-8 border-orange-400 ">
                        <img src="/images/foto-seccion.jpg"
                        alt="foto-seccion.jpg" class="object-cover w-full h-full">
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
                        <a href="{{ url('/pdf/Tallas.pdf') }}" target="_blank">
                            <article class="w-full max-w-[310px] flex flex-col gap-2 items-center text-center">
                                <span class="size-[60px] flex items-center justify-center rounded-full bg-yellow-400">
                                    <i class="fa-solid fa-gem text-[35px] text-white"></i>
                                </span>
                                <h3 class="text-xl font-extrabold tracking-tight">Elige tu talla</h3>
                                <p class="text-md">¿Tienes dudas sobre cuál talla escoger? <br> Aquí te enseñamos como.</p>
                            </article>
                        </a>
                    </div>
                </div>
            </div>
        </section>
        
        <section id="contact" class="w-full flex flex-col items-center px-5">
            <div class="w-full max-w-[1200px] py-10">
                <!-- Recuadro con formulario de envío --> 
                <div class="flex flex-col md:flex-row bg-white rounded-lg overflow-hidden shadow-lg">

                    <div class="p-5 flex flex-col gap-3 md:px-8">
                        <h1 class="text-2xl font-bold tracking-tight">¡Queremos escucharte!</h1>
                        <p>Te invitamos a compartir todas sus preguntas, quejas y reclamos para que juntos podamos mejorar y brindarles una experiencia excepcional.</p>
                        <form method="POST" action="{{ url('/send-email') }}" class="w-full flex flex-col gap-4">
                            @csrf

                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <x-auth-session-status class="mb-4" :status="session('status_image')" />

                            <div class="flex flex-col md:flex-row w-full gap-4">
                                <div class="flex flex-col gap-2 w-full md:w-1/2">
                                    <x-input-label for="user_full_name" value="Nombre" />
                                    <x-text-input type="text" id="user_full_name" name="user_full_name" required />
                                </div>
                                <div class="flex flex-col gap-2 w-full md:w-1/2">
                                    <x-input-label for="user_email" value="Correo Electrónico" />
                                    <x-text-input type="email" id="user_email" name="user_email" required />
                                </div>
                            </div>
                            <div class="flex flex-col gap-2 w-full">
                                <x-input-label for="email_subject" value="Asunto" />
                                <x-text-input type="text" id="email_subject" name="email_subject" required />
                            </div>
                            <div class="flex flex-col gap-2 w-full">
                                <x-input-label for="email_message" value="Mensaje" />
                                <textarea name="email_message" id="email_message" required
                                class="border-gray-300 rounded-md shadow-sm resize-none h-[100px]"></textarea>
                            </div>
                            <button class="py-1 px-7 bg-slate-100 rounded-md font-semibold text-slate-600 w-fit border">Enviar</button>
                        </form>
                    </div>
                    
                    <div class="bg-orange-400 w-full md:max-w-[300px] p-5 flex flex-col gap-3">
                        <h1 class="text-2xl font-bold tracking-tight">Contáctanos</h1>
                        <p>Especialistas en uniformes escolares en Bogotá, Colombia. Descubre calidad y variedad en nuestras tiendas.</p>
                        <div class="flex flex-col gap-4">
                            <a href="https://maps.app.goo.gl/Noy3fBKaPamF9Sw9A" target="_blank">
                                <span class="flex items-center gap-2">
                                    <div class="size-[40px] flex-none flex items-center justify-center rounded-full border border-black">
                                        <i class="fa-solid fa-location-dot"></i>
                                    </div>
                                    <p> <strong class="font-semibold">Dirección:</strong> Tv. 69c #68b Sur, Bogotá </p>
                                </span>
                            </a>
                            <span class="flex items-center gap-2">
                                <div class="size-[40px] flex-none flex items-center justify-center rounded-full border border-black">
                                    <i class="fa-solid fa-phone"></i>
                                </div>
                                <p><strong class="font-semibold">Teléfono:</strong> 312 4852078</p>
                            </span>
                            <span class="flex items-center gap-2">
                                <div class="size-[40px] flex-none flex items-center justify-center rounded-full border border-black">
                                    <i class="fa-regular fa-envelope"></i>
                                </div>
                                <p><strong class="font-semibold">Correo:</strong> laabejita22.uni@gmail.com </p>
                            </span>
                        </div>

                        <div class="w-full flex justify-center items-center gap-5 mt-2 text-2xl">
                            <a href="https://wa.me/+573124852078" target="_blank">
                                <div class="size-[50px] flex-none flex items-center justify-center rounded-full border border-black duration-300 hover:scale-105 hover:shadow-lg cursor-pointer">
                                    <i class="fab fa-whatsapp"></i>
                                </div>
                            </a>
                            <a href="https://www.facebook.com/profile.php?id=100092421275450" target="_blank">
                                <div class="size-[50px] flex-none flex items-center justify-center rounded-full border border-black duration-300 hover:scale-105 hover:shadow-lg cursor-pointer">
                                    <i class="fab fa-facebook"></i>
                                </div>
                            </a>
                            <a href="https://www.instagram.com/laabejita22" target="_blank">
                                <div class="size-[50px] flex-none flex items-center justify-center rounded-full border border-black duration-300 hover:scale-105 hover:shadow-lg cursor-pointer">
                                    <i class="fab fa-instagram"></i>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection