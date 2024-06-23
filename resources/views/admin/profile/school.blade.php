@extends('layouts.app')

@section('title', 'Perfil ' . $school -> school_name )

@section('content')
<main class="flex flex-col gap-10 py-10 min-h-[90vh] bg-center bg-no-repeat bg-cover bg-[url(/public/images/banner.jpg)] relative">
    <div class="absolute inset-0 bg-gradient-to-b from-black to-black opacity-[20%]"></div>
    <section class="w-full flex justify-center">
        <div class="flex flex-col md:flex-row gap-10 w-full max-w-[1200px] z-10">
            <div class="bg-white rounded-md p-7 shadow-lg w-full max-w-[400px] flex flex-col justify-center items-center gap-4 h-fit">
                <h1 class="text-2xl font-bold tracking-tight">Información del colegio:</h1>
                <div class="size-44 border-2 border-black rounded-full overflow-hidden shadow-md">
                    <img src="{{ $school -> school_image_url }}" alt="Foto de {{ $school -> school_name }}" class="object-cover h-full w-full">
                </div>
                <div class="text-center">
                    <h2 class="text-xl font-bold tracking-tight text-gray-800">{{ $school -> school_name }}</h2>
                    <p class="italic text-gray-700"><strong>Ubicación:</strong> {{ $school -> school_address }}</p>
                </div>
                <button id="edit-button" class="border border-gray-300 rounded-md w-full py-1.5 bg-gray-50 duration-300 hover:bg-gray-200">Editar</button>
            </div>
            <div class="bg-white rounded-md p-7 shadow-lg w-full flex flex-col gap-4">
                <h1 class="text-2xl font-bold tracking-tight">Editar colegio:</h1>
                <form action="{{ url('/profile/school/' . $school -> school_id) }}" method="post" 
                class="flex flex-col gap-4">
                    @csrf
                    @method('PUT')
                    
                    <x-auth-session-status class="mb-4" :status="session('status_profile')" />

                    <div class="flex flex-col gap-1 w-full">
                        <x-input-label for="school_name" value="Nombre del Colegio" class="after:content-['*'] after:ml-0.5 after:text-red-500"/>
                        <x-text-input id="school_name" name="school_name"
                                        type="text"
                                        class="block mt-1 w-full" 
                                        value="{{ $school -> school_name }}"
                                        autofocus required disabled/>
                    </div>

                    <div class="flex flex-col gap-1 w-full">
                        <x-input-label for="school_address" value="Dirección del Colegio" class="after:content-['*'] after:ml-0.5 after:text-red-500"/>
                        <x-text-input id="school_address" name="school_address"
                                        type="text"
                                        class="block mt-1 w-full" 
                                        value="{{ $school -> school_address }}"
                                        autofocus required disabled/>
                    </div>

                    <div class="flex flex-col gap-1 w-full">
                        <x-input-label for="school_image_url" value="Logo del Colegio (JPG)"/>
                        <input id="school_image_url" name="school_image_url" 
                        accept=".jpg,.jpeg,.png"
                        type="file"
                        class="block w-full border border-gray-300 shadow-sm rounded-lg text-sm focus:z-10 focus:border-blue-500 focus:ring-blue-500 bg-gray-200 cursor-pointer
                        disabled:opacity-50 disabled:pointer-events-none
                        file:bg-gray-50 file:border-0
                        file:mr-4
                        file:py-2 file:px-4
                        file:cursor-pointer"
                        disabled>
                    </div>

                    <div class="flex flex-col gap-1 w-full">
                        <x-input-label for="school_use_guide" value="Guía de Uso (PDF)"/>
                        <input id="school_use_guide" name="school_use_guide" 
                        accept=".pdf" 
                        type="file"
                        class="block w-full border border-gray-300 shadow-sm rounded-lg text-sm focus:z-10 focus:border-blue-500 focus:ring-blue-500 bg-gray-200 cursor-pointer
                        disabled:opacity-50 disabled:pointer-events-none
                        file:bg-gray-50 file:border-0
                        file:mr-4
                        file:py-2 file:px-4
                        file:cursor-pointer" 
                        disabled>
                    </div>
                    
                    <button id="submit-button" class="bg-amber-500 font-semibold py-1.5 px-5 text-white rounded-md shadow-md mt-4 hidden">
                        <i class="fa-solid fa-upload mr-2"></i>
                        Actualizar
                    </button>

                </form>
            </div>
        </div>
    </section>
</main>
<script>
    let editable = false;
    // Manejar la lógica de edición
    document.getElementById('edit-button').addEventListener('click', () => {
        if (!editable) {
            document.getElementById('edit-button').innerHTML = "Cancelar";
            document.getElementById('submit-button').classList.remove('hidden');
            document.querySelectorAll('input').forEach(input => {
                input.removeAttribute('disabled');
            })
        } else {
            if (confirm('¿Quieres regresar y perder los cambios?')) {
                window.location.reload();
            }
        }
        editable = !editable;
    });
</script>
@endsection