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
@endsection