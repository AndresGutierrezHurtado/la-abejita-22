<header class="w-full bg-white p-2 flex justify-center sticky top-0 z-50">
    <nav class="w-full max-w-[1200px] flex justify-between items-center">
        <a href="{{ url('/') }}" clasS="h-[55px]"><img src="/images/logotipo.png" alt="Logo la Abejita 22" class="max-h-full"></a>

        <ul class="flex gap-5 text-[20px] font-semibold text-zinc-800">
            <li class="hover:scale-105 hover:text-amber-500 duration-300">
                <a href="{{ url('/') }}">Inicio</a>
            </li>
            <li class="hover:scale-105 hover:text-amber-500 duration-300">
                <a href="{{ url('/colegios') }}">Colegios</a>
            </li>
            <li class="hover:scale-105 hover:text-amber-500 duration-300">
                <a href="{{ url('/') }}">Sobre Nosotros</a>
            </li>
            <li class="hover:scale-105 hover:text-amber-500 duration-300">
                <a href="{{ url('/') }}">Contáctanos</a>
            </li>
        </ul>
    </nav>
</header>