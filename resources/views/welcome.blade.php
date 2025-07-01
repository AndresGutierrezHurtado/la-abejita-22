@extends('layouts.app')

@section('title', 'Inicio')

@section('content')
<section id="hero" class="w-full bg-primary text-primary-content px-5">
    <div class="w-full max-w-[1300px] mx-auto py-10">
        <div class="max-w-2xl">
            <h1 class="text-4xl font-bold mb-2">Bienvenido a La Abejita 22</h1>
            <p class="text-primary-content/80 text-lg mb-6">
                Descubre nuestra colección exclusiva de productos artesanales y únicos.
                Cada pieza está creada con amor y dedicación para brindarte calidad y estilo.
            </p>
            <div class="flex flex-col sm:flex-row gap-4">
                <a href="#productos" class="btn btn-secondary rounded-lg">
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