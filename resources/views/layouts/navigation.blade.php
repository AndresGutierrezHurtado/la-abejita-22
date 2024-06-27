<header class="w-full bg-white px-5 py-2 flex justify-center sticky top-0 z-50">
    <nav class="w-full max-w-[1200px] flex justify-between items-center">
        <!-- Logo  -->
        <a href="{{ url('/') }}" class="h-[55px]">
            <img src="/images/logotipo.png" alt="Logo la Abejita 22" class="max-h-full min-w-[130px] max-w-[130px]">
        </a>

        <!-- Botón para mostrar/ocultar menu responsive -->
        <button id="menu-toggle" class="sm:hidden text-2xl">
            &#9776;
        </button>

        <!-- Links de navegación -->
        <ul class="hidden sm:flex gap-5 text-[20px] font-semibold text-zinc-800">
            <li class="hover:scale-105 hover:text-amber-500 duration-300">
                <a href="{{ url('/') }}">Inicio</a>
            </li>
            <li class="hover:scale-105 hover:text-amber-500 duration-300">
                <a href="{{ url('/colegios') }}">Colegios</a>
            </li>
            <li class="hover:scale-105 hover:text-amber-500 duration-300">
                <a href="{{ url('/#about') }}">Sobre Nosotros</a>
            </li>
            <li class="hover:scale-105 hover:text-amber-500 duration-300">
                <a href="{{ url('/#contact') }}">Contáctanos</a>
            </li>
            @if (Route::has('login'))
                <a class="hidden md:block">|</a>
                <a href="{{ url('/carrito')}}">
                    <button class="text-[16px]">
                        <i class="fa-solid fa-shopping-cart"></i>
                    </button>
                </a>
            @endif
        </ul>
    </nav>
</header>

<!-- Links de navegación para móviles -->
<ul id="nav-menu" class="hidden top-[71px] left-0 w-full py-2 z-50 bg-gray-100 font-semibold text-gray-700">
    <li class="p-2 hover:bg-gray-300">
        <a href="{{ url('/') }}">Inicio</a>
    </li>
    <li class="p-2 hover:bg-gray-300">
        <a href="{{ url('/colegios') }}">Colegios</a>
    </li>
    <li class="p-2 hover:bg-gray-300">
        <a href="{{ url('/#about') }}">Sobre Nosotros</a>
    </li>
    <li class="p-2 hover:bg-gray-300">
        <a href="{{ url('/#contact') }}">Contáctanos</a>
    </li>
    @if (Route::has('login'))
        <hr>
        <a href="{{ url('/carrito')}}" class="">
            <button class="text-[16px] p-2 hover:bg-gray-300 w-full">
                <i class="fa-solid fa-shopping-cart"></i>
            </button>
        </a>
    @endif
</ul>

<script>
    document.getElementById('menu-toggle').addEventListener('click', function() {
        var navMenu = document.getElementById('nav-menu');
        navMenu.classList.toggle('hidden');
        navMenu.classList.toggle('fixed');
    });
</script>
