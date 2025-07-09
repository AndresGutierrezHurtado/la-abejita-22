@extends('layouts.guest')

@section('navbar')
<header class="bg-base-200 text-base-content border-b border-base-content/10 flex w-full flex-wrap py-4 text-sm md:flex-nowrap md:justify-start md:py-0 sticky top-0 z-50">
    <nav class="w-full max-w-[1300px] mx-auto py-0.5" aria-label="Global">
        <div class="relative md:flex md:items-center lg:gap-7">
            <div class="flex items-center justify-between text-nowrap">
                <div class="tooltip h-15 w-auto">
                    <a href="/">
                        <img
                            src="/images/logo.png"
                            alt="La Abejita 22"
                            class="w-full h-full object-contain">
                    </a>
                    <span class="tooltip-content tooltip-shown:opacity-100 tooltip-shown:visible" role="tooltip">
                        <span class="tooltip-body">Ir a la página principal</span>
                    </span>
                </div>
                <div class="md:hidden">
                    <button type="button" class="collapse-toggle btn btn-outline btn-secondary btn-sm btn-square" data-collapse="#navbar-mega-menu-click" aria-controls="navbar-mega-menu-click" aria-label="Toggle navigation">
                        <span class="icon-[tabler--menu-2] collapse-open:hidden size-4"></span>
                        <span class="icon-[tabler--x] collapse-open:block hidden size-4"></span>
                    </button>
                </div>
            </div>
            <div id="navbar-mega-menu-click" class="collapse hidden grow basis-full overflow-hidden rounded-lg transition-all duration-300 md:block">
                <div class="flex flex-col rounded-lg max-md:mt-3 max-md:border max-md:p-2 md:flex-row md:items-center md:justify-end md:ps-5 md:pe-0.5 gap-2 max-md:border-base-content/20">
                    <ul class="menu md:menu-horizontal text-base py-4 px-0 gap-4 bg-transparent">
                        <li><a href="/schools" class="hover:text-primary hover:scale-105 hover:bg-transparent py-0 px-2 duration-300">Colegios</a></li>
                        <li><a href="/products" class="hover:text-primary hover:scale-105 hover:bg-transparent py-0 px-2 duration-300">Catálogo</a></li>
                        <li><a href="/about" class="hover:text-primary hover:scale-105 hover:bg-transparent py-0 px-2 duration-300">Nosotros</a></li>
                        <li><a href="/contact" class="hover:text-primary hover:scale-105 hover:bg-transparent py-0 px-2 duration-300">Contacto</a></li>
                    </ul>
                </div>
            </div>
            <div class="flex items-center">
                <!-- search -->
                <div class="tooltip">
                    <a href="#" class="btn btn-soft bg-transparent" aria-haspopup="dialog" aria-expanded="false" aria-controls="search-modal" data-overlay="#search-modal">
                        <span class="icon-[tabler--search] size-5"></span>
                    </a>
                    <span class="tooltip-content tooltip-shown:opacity-100 tooltip-shown:visible" role="tooltip">
                        <span class="tooltip-body">Buscar</span>
                    </span>
                </div>
                <!-- cart -->
                @if (auth()->check())
                <div class="tooltip">
                    <a href="/cart" class="btn btn-soft bg-transparent">
                        <span class="icon-[tabler--shopping-cart] size-5"></span>
                    </a>
                    <span class="tooltip-content tooltip-shown:opacity-100 tooltip-shown:visible" role="tooltip">
                        <span class="tooltip-body">Carrito</span>
                    </span>
                </div>
                @endif
                <!-- user -->
                @if (auth()->check())
                <div class="tooltip">
                    <a href="/profile" class="btn btn-soft bg-transparent">
                        <span class="icon-[tabler--user] size-5"></span>
                    </a>
                    <span class="tooltip-content tooltip-shown:opacity-100 tooltip-shown:visible" role="tooltip">
                        <span class="tooltip-body">{{ auth()->user()->user_name . ' ' . auth()->user()->user_lastname ?? 'Usuario' }}</span>
                    </span>
                </div>
                @else
                <div class="tooltip">
                    <a href="/login" class="btn btn-soft bg-transparent">
                        <span class="icon-[tabler--user] size-5"></span>
                    </a>
                    <span class="tooltip-content tooltip-shown:opacity-100 tooltip-shown:visible" role="tooltip">
                        <span class="tooltip-body">Iniciar sesión</span>
                    </span>
                </div>
                @endif
            </div>
        </div>
    </nav>
</header>

<div id="search-modal" class="overlay modal overlay-open:opacity-100 overlay-open:duration-300 hidden" role="dialog" tabindex="-1">
    <div class="overlay-animation-target modal-dialog overlay-open:mt-4 overlay-open:opacity-100 overlay-open:duration-300 mt-12 transition-all ease-out max-w-3xl">
        <div class="modal-content bg-base-200">
            <!-- Search bar -->
            <div class="modal-header p-4 gap-4 items-center">
                <div class="flex items-center gap-2">
                    <span class="icon-[tabler--search] size-5"></span>
                </div>
                <div class="flex w-full items-center gap-2">
                    <input type="text" class="w-full focus:outline-none focus:ring-0 focus:border-none" placeholder="Buscar">
                </div>
            </div>
            <div class="modal-body bg-base-100 min-h-30 p-4">
                <!-- schools -->
                @forelse ($schools ?? [] as $school)

                @empty
                <div class="flex items-center justify-center h-full">
                    <p class="text-sm text-base-content/50">
                        <span>No se encontraron resultados</span>
                    </p>
                </div>
                @endforelse
            </div>
            <div class="modal-footer p-4 flex justify-between items-center">
                <!-- keyboard -->
                <div class="flex items-center gap-2 text-xs">
                    <div class="flex items-center gap-2">
                        <kbd class="kbd kbd-xs">
                            <span class="icon-[tabler--arrow-forward] size-4"></span>
                        </kbd>
                        <span>Para buscar</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <kbd class="kbd kbd-xs">
                            <span class="icon-[tabler--arrow-up] size-4"></span>
                        </kbd>
                        <kbd class="kbd kbd-xs">
                            <span class="icon-[tabler--arrow-down] size-4"></span>
                        </kbd>
                        <span>Para navegar</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <kbd class="kbd kbd-sm">Esc</kbd>
                        <span>Para cerrar</span>
                    </div>
                </div>
                <div>
                    <p class="text-sm text-base-content/50">
                        <span class="text-xs">Search by</span>
                        <span class="text-primary/90 font-medium">
                            Andrés Gutiérrez Hurtado
                        </span>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="fixed bottom-20 right-20 z-50">
    <div class="absolute bottom-0 right-0 z-0">
        <div class="animate-ping bg-green-500 w-12 h-12 rounded-full scale-70"></div>
    </div>
    <a href="https://wa.me/573124852078"
        class="relative z-10 bg-green-500 hover:bg-green-600 text-white w-12 h-12 rounded-full shadow-lg flex items-center justify-center"
        target="_blank"
        aria-label="Chatea por WhatsApp">
        <span class="icon-[tabler--brand-whatsapp] size-8"></span>
    </a>
</div>
@endsection

@section('footer')
<footer class="footer bg-base-200 border-t border-base-content/10 px-6 py-4">
    <div class="flex w-full max-w-[1300px] mx-auto items-center justify-between">
        <aside class="grid-flow-col items-center">
            <p>
                &copy; {{ date('Y') }} <a class="hover:underline" href="#">La Abejita 22</a>
            </p>
            <p class="text-xs text-base-content/50">
                Todos los derechos reservados
            </p>
        </aside>
        <div class="flex gap-4 h-5">
            <a href="https://www.instagram.com/laabejita22/" target="_blank" class="link hover:text-primary duration-300" aria-label="Instagram Link">
                <span class="icon-[tabler--brand-instagram] size-6"></span>
            </a>
            <a href="https://web.facebook.com/la.abejita.uniformes.escolares/" target="_blank" class="link hover:text-primary duration-300" aria-label="Facebook Link">
                <span class="icon-[tabler--brand-facebook] size-6"></span>
            </a>
            <a href="https://g.co/kgs/avsEDFL" target="_blank" class="link hover:text-primary duration-300" aria-label="Google Link">
                <span class="icon-[tabler--brand-google] size-6"></span>
            </a>
        </div>
    </div>
</footer>
@endsection