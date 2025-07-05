@extends('layouts.app')

@section('title', 'Contacto')

@section('content')
<section class="w-full px-5">
    <div class="w-full max-w-[1300px] mx-auto py-10">
        <div class="w-full space-y-10">
            <h1 class="text-4xl font-bold mb-2">Contacto</h1>

            <div class="w-full bg-base-200 border border-base-content/20 p-5 rounded-lg">
                <form action="/messages" method="post" class="w-full space-y-5">
                    @csrf

                    <div class="flex flex-col md:flex-row gap-5">
                        <fieldset class="w-full space-y-1">
                            <label for="name" class="w-full label-text after:content-['*'] after:text-error">Nombre Completo: </label>
                            <input type="text" placeholder="Ingresa tu nombre completo" class="input" id="user_name" required />
                        </fieldset>

                        <fieldset class="w-full space-y-1">
                            <label for="email" class="w-full label-text after:content-['*'] after:text-error">Correo Electrónico: </label>
                            <input type="email" placeholder="Ingresa tu correo electrónico" class="input" id="user_email" required />
                        </fieldset>
                    </div>

                    <fieldset class="w-full space-y-1">
                        <label for="phone" class="w-full label-text after:content-['*'] after:text-error">Asunto: </label>
                        <input type="text" placeholder="Ingresa el asunto de tu mensaje" class="input" id="email_subject" required />
                    </fieldset>

                    <fieldset class="w-full space-y-1">
                        <label for="message" class="w-full label-text after:content-['*'] after:text-error">Mensaje: </label>
                        <textarea placeholder="Ingresa tu mensaje" class="textarea h-30 resize-none" id="email_message" required></textarea>
                    </fieldset>

                    <div class="w-full pt-5">
                        <button type="submit" class="btn btn-primary px-20 mx-auto">Enviar</button>
                    </div>

                </form>
            </div>

            <!-- Datos de contacto, mapa-->
        </div>
    </div>
</section>
@endsection