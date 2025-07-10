@extends('layouts.app')

@section('title', 'Inicio')

@section('content')
<section
    id="hero"
    class="w-full text-primary-content px-5"
    style="background: linear-gradient(to right, var(--color-primary) 40%, rgba(0,0,0,0.5)), url('/images/foto-seccion.jpg'); background-size: cover; background-position: center;">
    <div class="w-full max-w-[1300px] mx-auto py-10 md:py-20 lg:py-35">
        <div class="max-w-2xl">
            <h1 class="text-4xl font-bold mb-2">Bienvenido a La Abejita 22</h1>
            <p class="text-primary-content/80 text-lg mb-6">
                Descubre nuestra colección exclusiva de productos artesanales y únicos.
                Cada pieza está creada con amor y dedicación para brindarte calidad y estilo.
            </p>
            <div class="flex flex-col sm:flex-row gap-4">
                <a href="#productos" class="btn rounded-lg">
                    Ver Productos
                </a>
                <a href="#contacto" class="btn btn-outline rounded-lg border-primary-content text-primary-content hover:bg-primary-content hover:text-primary">
                    Contáctanos
                </a>
            </div>
        </div>
    </div>
</section>

<!-- SCHOOLS (LOGO CLOUD) -->
<section class="w-full px-5">
    <div class="w-full max-w-[1300px] mx-auto py-20">
        <div class="flex flex-col md:flex-row items-center gap-10">
            <div class="space-y-4 w-3/5">
                <h2 class="text-base-content font-semibold md:text-3xl lg:text-4xl">
                    Padres que prefieren nuestra calidad para vestir a sus hijos
                </h2>
                <p class="text-base-content/80 text-xl">
                    Cada vez más familias nos eligen por la calidad, comodidad y durabilidad de nuestros uniformes, confeccionados para acompañar el día a día escolar de tus hijos.
                </p>
                <a href="#" class="btn btn-primary orm1x icsol">Conoce más</a>
            </div>
            <div class="grid grid-cols-3 gap-4 w-2/5">
                <a href="/schools/id" class="tooltip">
                    <div class="bg-base-300/10 rounded-box flex items-center justify-center p-5 h-30 cursor-pointer group duration-300 hover:-translate-y-1">
                        <img src="/images/schools/ensueno.png" alt="Logo del colegio El Ensueño" class="w-full h-full object-contain tooltip-toggle group-hover:scale-110 duration-300 max-h-25">
                    </div>
                    <div class="tooltip-content tooltip-shown:opacity-100 tooltip-shown:visible" role="tooltip">
                        <div class="tooltip-body">
                            Colegio El Ensueño IED
                        </div>
                    </div>
                </a>
                <a href="/schools/id" class="tooltip">
                    <div class="bg-base-300/10 rounded-box flex items-center justify-center p-5 h-30 cursor-pointer group duration-300 hover:-translate-y-1 col-span-2">
                        <img src="/images/schools/carranza.png" alt="Logo del colegio Carranza" class="w-full h-full object-contain tooltip-toggle group-hover:scale-110 duration-300 max-h-25">
                    </div>
                    <div class="tooltip-content tooltip-shown:opacity-100 tooltip-shown:visible" role="tooltip">
                        <div class="tooltip-body">
                            Colegio Maria Mercedes Carranza IED
                        </div>
                    </div>
                </a>
                <a href="/schools/id" class="tooltip">
                    <div class="bg-base-300/10 rounded-box flex items-center justify-center p-5 h-30 cursor-pointer group duration-300 hover:-translate-y-1 col-span-2">
                        <img src="/images/schools/caried.svg" alt="Logo del colegio Agudelo Restrepo" class="w-full h-full object-contain tooltip-toggle group-hover:scale-110 duration-300 max-h-25">
                    </div>
                    <div class="tooltip-content tooltip-shown:opacity-100 tooltip-shown:visible" role="tooltip">
                        <div class="tooltip-body">
                            Colegio Agudelo Restrepo IED
                        </div>
                    </div>
                </a>
                <a href="/schools/id" class="tooltip">
                    <div class="bg-base-300/10 rounded-box flex items-center justify-center p-5 h-30 cursor-pointer group duration-300 hover:-translate-y-1">
                        <img src="/images/schools/currea.png" alt="Logo del colegio Maria Currea" class="w-full h-full object-contain tooltip-toggle group-hover:scale-110 duration-300 max-h-25">
                    </div>
                    <div class="tooltip-content tooltip-shown:opacity-100 tooltip-shown:visible" role="tooltip">
                        <div class="tooltip-body">
                            Colegio Maria Currea Manrique IED
                        </div>
                    </div>
                </a>
                <a href="/schools/id" class="tooltip">
                    <div class="bg-base-300/10 rounded-box flex items-center justify-center p-5 h-30 cursor-pointer group duration-300 hover:-translate-y-1">
                        <img src="/images/schools/salmona.png" alt="Logo del colegio Rogelio Salmona" class="w-full h-full object-contain tooltip-toggle group-hover:scale-110 duration-300 max-h-25">
                    </div>
                    <div class="tooltip-content tooltip-shown:opacity-100 tooltip-shown:visible" role="tooltip">
                        <div class="tooltip-body">
                            Colegio Rogelio Salmona IED
                        </div>
                    </div>
                </a>
                <a href="/schools/id" class="tooltip">
                    <div class="bg-base-300/10 rounded-box flex items-center justify-center p-5 h-30 cursor-pointer group duration-300 hover:-translate-y-1 col-span-2">
                        <img src="/images/schools/angela.png" alt="Logo del colegio Angela Restrepo Moreno" class="w-full h-full object-contain tooltip-toggle group-hover:scale-110 duration-300 max-h-25">
                    </div>
                    <div class="tooltip-content tooltip-shown:opacity-100 tooltip-shown:visible" role="tooltip">
                        <div class="tooltip-body">
                            Colegio Angela Restrepo Moreno IED
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</section>
@endsection