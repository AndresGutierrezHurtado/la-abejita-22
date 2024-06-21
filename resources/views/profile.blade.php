@extends('layouts.app')

@section('title', 'Perfil')

@section('content')
    <main class="flex flex-col gap-10 py-10 min-h-[90vh]">
        <section class="w-full flex justify-center">
            <div class="flex flex-col md:flex-row gap-10 w-full max-w-[1200px] z-10">
                <div class="bg-white rounded-md p-5 shadow-lg w-full md:w-1/2">
                    <h2 class="text-xl font-bold mb-4">Foto de perfil de {{ $user -> user_username }}:</h2>
                    <div class="size-36 bg-cover bg-center [background-image:url(/public{{ $user -> user_image_url ?? 'images/users/nf.jpg' }})]"></div>
                    <form method="post" class="flex flex-col gap-2">
                        @csrf
                        <input type="file" name="" id="">
                        <button class="px-5 py-1 text-white font-semibold bg-red-600 rounded-lg w-fit"> <i class="fa-regular fa-trash-can mr-2"></i> Borrar foto </button>
                    </form>
                </div>
                <div class="bg-white flex flex-col justify-between rounded-md p-5 shadow-lg w-full md:w-1/2">
                    <div>
                        <h2 class="text-xl font-bold mb-4">Información de {{ $user -> user_username }}:</h2>
                        <p> <strong>Nombre:</strong> {{ $user -> user_first_name . ' ' . $user -> user_last_name}}</p>
                        <p> <strong>Dirección:</strong> {{ $user -> user_address ?? 'No especificada'}}</p>
                        <p> <strong>Teléfono:</strong> {{ $user -> user_phone_number ?? 'No especificado'}}</p>
                    </div>
                    <div class="w-full flex gap-2 justify-between items-end">
                        <p class="text-gray-800 font-semibold text-sm">*Cuenta creada {{ \Carbon\Carbon::parse( $user -> created_at )->diffForHumans() }}*</p>
                        <button class="px-5 py-1 text-white font-semibold bg-red-600 rounded-lg"> <i class="fa-regular fa-trash-can mr-2"></i> Borrar cuenta</button>
                    </div>
                </div>
            </div>
        </section>
        <section class="w-full flex justify-center">
            <div class="flex flex-col gap-10 w-full max-w-[1200px] z-10 bg-white rounded-md p-7 shadow-lg">

                <h2 class="text-xl font-bold tracking-tight">Información del Usuario:</h2>
                
                <div class="grid grid-cols-2 gap-5">
                    <!-- Nombres -->
                    <div>
                        <x-input-label for="user_first_name" value="Nombres"/>
                        <x-text-input id="user_first_name" class="block mt-1 w-full" 
                                        type="text" 
                                        name="user_first_name" 
                                        value="{{ $user -> user_first_name }}"
                                        required autofocus disabled/>
                    </div>
                    
                    <!-- Apellidos -->
                    <div>
                        <x-input-label for="user_last_name" value="Apellidos"/>
                        <x-text-input id="user_last_name" class="block mt-1 w-full" 
                                        type="text" 
                                        name="user_last_name" 
                                        value="{{ $user -> user_last_name }}"
                                        required autofocus disabled/>
                    </div>

                    <!-- Correo electrónico -->
                    <div>
                        <x-input-label for="user_email" value="Correo electrónico"/>
                        <x-text-input id="user_email" class="block mt-1 w-full" 
                                        type="email" 
                                        name="user_email" 
                                        value="{{ $user -> user_email }}"
                                        required autofocus disabled/>
                    </div>
                    
                    <!-- Nombre de Usuario -->
                    <div>
                        <x-input-label for="user_username" value="Usuario"/>
                        <x-text-input id="user_username" class="block mt-1 w-full" 
                                        type="text" 
                                        name="user_username" 
                                        value="{{ $user -> user_username }}"
                                        required autofocus disabled/>
                    </div>
                    
                    <!-- Número de Teléfono -->
                    <div>
                        <x-input-label for="user_phone_number" value="Teléfono"/>
                        <x-text-input id="user_phone_number" class="block mt-1 w-full" 
                                        type="number" 
                                        name="user_phone_number" 
                                        value="{{ $user -> user_phone_number}}"
                                        required autofocus disabled/>
                    </div>

                    <!-- Dirección -->
                    <div>
                        <x-input-label for="user_address" value="Dirección"/>
                        <x-text-input id="user_address" class="block mt-1 w-full" 
                                        type="text" 
                                        name="user_address" 
                                        value="{{ $user -> user_address }}"
                                        required autofocus disabled/>
                    </div>
                </div>
                
                <!-- Botón de Editar -->
                <div>
                    <a href="{{ url('/editar-perfil') }}" class="px-5 py-2 rounded-md font-semibold text-white bg-amber-600">
                        <i class="fa-regular fa-pen-to-square mr-2"></i>
                        Editar
                    </a>
                </div>
            </div>
        </section>

    
    </main>
@endsection