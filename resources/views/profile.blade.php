@extends('layouts.app')

@section('title', 'Perfil')

@section('content')
<style>
    td, th {
        padding: 5px;
    }
</style>
<main class="flex flex-col gap-10 py-10 min-h-[90vh] bg-center bg-no-repeat bg-cover bg-[url(/public/images/banner.jpg)] relative">
    <div class="absolute inset-0 bg-gradient-to-b from-black to-black opacity-[20%]"></div>
    <section class="w-full flex justify-center px-5">
        <div class="flex flex-col md:flex-row gap-10 w-full max-w-[1200px] z-10">
            <div class="bg-white rounded-md p-5 shadow-lg w-full md:w-[600px] flex flex-col gap-4">
                <h2 class="text-xl font-bold mb-4">Foto de perfil de {{ $user -> user_username }}:</h2>
                <form method="POST" action="{{ url('/profile/user/updateImage/' . $user -> user_id ) }}" enctype="multipart/form-data" class="flex flex-col items-center justify-center gap-4">
                    @csrf
                    @method('PUT')

                    <x-auth-session-status class="mb-4" :status="session('status_image')" />

                    <div class="size-36 rounded-md overflow-hidden shadow-md">
                        <img src="{{ $user->user_image_url }}" alt="foto {{ $user->user_username }}" class="h-full w-full object-cover">
                    </div>
                    <input type="file" name="user_image_url" id="user_image"
                    class="block w-full border border-gray-300 shadow-sm rounded-lg text-sm focus:z-10 focus:border-blue-500 focus:ring-blue-500 bg-gray-200 cursor-pointer
                    disabled:opacity-50 disabled:pointer-events-none
                    file:bg-gray-50 file:border-0
                    file:mr-4
                    file:py-2 file:px-4
                    file:cursor-pointer">
                    <button id="upload-button" class="px-5 py-1 text-white font-semibold bg-amber-500 rounded-lg w-fit hidden"><i class="fa-solid fa-upload mr-2"></i>Cambiar foto</button>
                </form>
                <form method="POST" action="{{ url('/profile/user/deleteImage/' . $user -> user_id ) }}" enctype="multipart/form-data" 
                onsubmit="return confirm('¿Estás seguro que quieres eliminar esta foto?, esta acción es irrevesible.');"
                class="flex flex-col items-center justify-center gap-4">
                    @csrf
                    @method('PUT')
                    <button class="px-5 py-1 text-white font-semibold bg-red-600 rounded-lg w-fit {{ $user -> user_image_url == '/images/users/nf.jpg' ? 'hidden' : '' }}"> 
                        <i class="fa-regular fa-trash-can mr-2"></i> 
                        Borrar foto 
                    </button>
                </form>
            </div>
            <div class="bg-white flex flex-col justify-between rounded-md p-5 shadow-lg w-full md:w-[1fr]">
                <div>
                    <h2 class="text-xl font-bold mb-4">Información:</h2>
                    <p class="text-xl font-semibold text-gray-900 tracking-tight mb-2">{{ $user->user_first_name . ' ' . $user->user_last_name }}</p>
                    <p><i class="fa-solid fa-user mr-2"></i> {{ $user -> user_username }}</p>
                    <p><i class="fa-regular fa-envelope mr-2"></i> {{ $user -> user_email }}</p>
                    <p><i class="fa-solid fa-location-dot mr-2"></i> {{ $user->user_address ?? 'No especificada' }}</p>
                    <p><i class="fa-solid fa-phone mr-2"></i> {{ $user->user_phone_number ?? 'No especificado' }}</p>
                </div>
                <div class="w-full flex gap-2 justify-between items-end">
                    <div class="tex-center text-gray-800 font-semibold text-sm flex flex-col items-center">
                        <p class="capitalize">{{ $user -> role -> role_name }}</p>
                        <p>*Cuenta creada {{ \Carbon\Carbon::parse($user->created_at)->diffForHumans() }}*</p>
                    </div>
                    <form action="{{ url('/profile/user/destroy/' . $user -> user_id) }}" method="post" 
                    onsubmit="return confirm('¿Estás seguro que quieres eliminar a este usuario?, se perderá toda la información.');">
                        @csrf
                        @method('DELETE')
                        <button  class="bg-red-600 border-2 border-red-600 px-5 py-1 rounded-md font-semibold text-white"> 
                            <i class="fa-solid fa-trash-can mr-2"></i> 
                            Borrar cuenta
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <section class="w-full flex justify-center px-5">
        <form method="POST" action="{{url('/profile/user/' . $user -> user_id)}}" class="flex flex-col gap-5 w-full max-w-[1200px] z-10 bg-white rounded-md p-7 shadow-lg">
            @csrf
            @method('PUT')
            
            <h2 class="text-xl font-bold tracking-tight">Información del Usuario:</h2>    
            
            <x-auth-session-status class="mb-4" :status="session('status_profile')" />

            <!-- Campos del formulario -->
            <div class="grid grid-cols-2 gap-2 gap-x-5">

                <!-- Nombres -->
                <div>
                    <x-input-label for="user_first_name" value="Nombres"/>
                    <x-text-input id="user_first_name" class="block mt-1 w-full" 
                                    type="text" 
                                    name="user_first_name" 
                                    value="{{ $user->user_first_name }}"
                                    required autofocus disabled/>
                    <x-input-error :messages="$errors->get('user_first_name')" class="mt-2" />
                </div>

                <!-- Apellidos -->
                <div>
                    <x-input-label for="user_last_name" value="Apellidos"/>
                    <x-text-input id="user_last_name" class="block mt-1 w-full" 
                                    type="text" 
                                    name="user_last_name" 
                                    value="{{ $user->user_last_name }}"
                                    required autofocus disabled/>
                    <x-input-error :messages="$errors->get('user_last_name')" class="mt-2" />
                </div>

                <!-- Correo electrónico -->
                <div>
                    <x-input-label for="user_email" value="Correo electrónico"/>
                    <x-text-input id="user_email" class="block mt-1 w-full" 
                                    type="email" 
                                    name="user_email" 
                                    value="{{ $user->user_email }}"
                                    required autofocus disabled/>
                    <x-input-error :messages="$errors->get('user_email')" class="mt-2" />
                </div>

                <!-- Nombre de Usuario -->
                <div>
                    <x-input-label for="user_username" value="Usuario"/>
                    <x-text-input id="user_username" class="block mt-1 w-full" 
                                  type="text" 
                                  name="user_username" 
                                  value="{{ $user->user_username }}"
                                    required autofocus disabled/>
                    <x-input-error :messages="$errors->get('user_username')" class="mt-2" />
                </div>

                <!-- Número de Teléfono -->
                <div>
                    <x-input-label for="user_phone_number" value="Teléfono"/>
                    <x-text-input id="user_phone_number" class="block mt-1 w-full" 
                                    type="text" 
                                    name="user_phone_number" 
                                    value="{{ $user->user_phone_number }}"
                                    autofocus disabled/>
                    <x-input-error :messages="$errors->get('user_phone_number')" class="mt-2" />
                </div>

                <!-- Dirección -->
                <div>
                    <x-input-label for="user_address" value="Dirección"/>
                    <x-text-input id="user_address" class="block mt-1 w-full" 
                                    type="text" 
                                    name="user_address" 
                                    value="{{ $user->user_address }}"
                                    autofocus disabled/>
                    <x-input-error :messages="$errors->get('user_address')" class="mt-2" />
                </div>
            </div>

            <!-- Botón de Editar -->
            <div class="w-full flex justify-between items-center">
                <a type="button" id="edit-button" class="px-5 py-2 rounded-md font-semibold text-white duration-300 bg-amber-500 hover:bg-amber-600 cursor-pointer">
                    <i class="fa-regular fa-pen-to-square mr-2"></i>
                    Editar
                </a>

                <button type="submit" id="update-button" class="px-5 py-2 rounded-md font-semibold text-white duration-300 bg-amber-500 hover:bg-amber-600 hidden">
                    <i class="fa-solid fa-upload mr-2"></i>
                    Actualizar
                </button>
            </div>
        </form>
    </section>
    <section class="w-full flex justify-center px-5">
        <div class="flex flex-col gap-5 w-full max-w-[1200px] z-10 bg-white rounded-md p-7 shadow-lg space-y-4" id="compras">
        <h2 class="text-xl font-bold tracking-tight">Compras del Usuario:</h2>

            <x-error-status class="mb-4" :status="$errors->first('error_message')" />

            <x-auth-session-status class="mb-4" :status="session('payment_status')" />
            
            <div class="w-full">
                <table class="w-full text-center border border-gray-300 divide-y divide-gray-300">
                    <thead class="bg-gray-200 uppercase font-bold">
                        <tr>
                            <th><a href="{{ url('/profile/user') . '?' . http_build_query(array_merge(request()->except('order'), ['order' => 'created_at'])) }}">Fecha</a></th>
                            <th>productos</th>
                            <th><a href="{{ url('/profile/user') . '?' . http_build_query(array_merge(request()->except('order'), ['order' => 'payment_amount'])) }}">Precio</a></th>
                            <th>estado</th>
                            <th>Ver</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-300">
                        @foreach ( $orders as $order )
                            <tr class="even:bg-white odd:bg-gray-50">
                                <td>{{ $order -> created_at }}</td>
                                <td>
                                    <ul>
                                        @foreach($order -> soldProducts as $product)
                                            <li>{{ $product -> product_quantity }} - {{ $product -> product -> product_name }} (Talla {{ $product -> size_name }} )</li>
                                        @endforeach
                                    </ul>
                                </td>
                                <td>{{ number_format($order -> paymentDetails -> payment_amount) }} COP</td>
                                <td>{{ $order -> paymentDetails -> payment_description }}</td>
                                <td>
                                    <a href=" {{ url('/order/'. $order -> order_id) }}">
                                        <button class="border-2 border-black py-1 px-3 rounded-md">
                                            <i class="fa-regular fa-eye"></i>
                                        </button>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="flex justify-between items-center p-3">
                {{ $orders -> links() }}
            </div>

        </div>
    </section>
</main>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        let editBtn = document.getElementById('edit-button');
        let updateBtn = document.getElementById('update-button');
        let uploadBtn = document.getElementById('upload-button');
        let fileInput = document.getElementById('user_image');
        let editable = false;

        // Mostrar el botón de actualizar cuando se seleccione un archivo
        fileInput.addEventListener('change', () => {
            if (fileInput.files.length > 0) {
                uploadBtn.classList.remove('hidden');
            } else {
                uploadBtn.classList.add('hidden');
            }
        });

        // Manejar la lógica de edición
        editBtn.addEventListener('click', () => {
            if (!editable) {
                editBtn.innerHTML = "Cancelar";
                updateBtn.classList.remove('hidden');
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
    });
</script>
@endsection
