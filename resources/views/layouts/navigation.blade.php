<header class="w-full bg-white px-5 py-2 flex justify-center sticky top-0 z-50">
    <nav class="w-full max-w-[1200px] flex justify-between items-center">
        <a href="{{ url('/') }}" clasS="h-[55px]"><img src="/images/logotipo.png" alt="Logo la Abejita 22" class="max-h-full min-w-[130px] max-w-[130px]"></a>

        <button id="menu-toggle" class="sm:hidden text-2xl">
            &#9776;
        </button>

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