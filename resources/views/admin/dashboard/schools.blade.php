@extends('layouts.app')

@section('title', 'Panel de control de Colegios')

@section('content')
<style>
    td, th {
        padding: 5px;
    }
</style>
<main class="min-h-[90vh] bg-center bg-no-repeat bg-cover bg-[url(/public/images/banner.jpg)] relative py-10">
    <div class="absolute inset-0 bg-gradient-to-b from-black to-black opacity-[20%]"></div>

    <section class="w-full flex justify-center items-center px-5">
        <div class="flex flex-col w-full max-w-[1200px] z-10">
            <div class="bg-white rounded-md p-5 shadow-lg w-full flex flex-col gap-5">
                
                <!-- Seleccionar el dashboard -->
                <select onchange="window.location = this.value"
                class="bg-gray-100 rounded-md border border-gray-300 ">
                    <option value="/dashboard/users">Usuarios</option>
                    <option value="/dashboard/schools" selected>Colegios</option>
                    <option value="/dashboard/products">Productos</option>
                </select>

                <!-- Título dashboard y búsqueda -->
                <span class="flex flex-col md:flex-row gap-3 justify-between items-center">
                    <h1 class="text-2xl font-bold tracking-tight">Tabla de colegios</h1>
                    <form action="{{ url('/dashboard/schools/') }}" method="get" class="flex gap-0">                        
                        <input type="text" name="search" value="{{ request() -> get('search') }}" placeholder="Buscar..." class="rounded-l-md py-1 px-2 border-gray-300 md:min-w-[300px]">
                        <button class="bg-gray-600 rounded-r-md font-semibold text-white py-1 px-2">Buscar</button>
                        @if(request()->has('search') || request()->has('order'))
                            <a href="{{ url('/dashboard/schools/') }}" class="bg-gray-300 rounded-md font-semibold text-black py-1 px-2 ml-2">Limpiar</a>
                        @endif
                    </form>
                </span>
                
                <!-- tabla con la información del dashboard -->
                <div class="w-full text-[11px] sm:text-sm md:text-md">
                    <table class="w-full text-center border border-gray-300 divide-y divide-gray-300">
                        <thead class="bg-gray-200 uppercase font-bold">
                            <tr>
                                <th><a href="{{ url('/dashboard/schools') . '?' . http_build_query(array_merge(request()->except('order'), ['order' => 'school_id'])) }}">ID</a></th>
                                <th><a href="{{ url('/dashboard/schools') . '?' . http_build_query(array_merge(request()->except('order'), ['order' => 'school_name'])) }}">Nombre</a></th>
                                <th class="hidden md:table-cell"><a href="{{ url('/dashboard/schools') . '?' . http_build_query(array_merge(request()->except('order'), ['order' => 'school_address'])) }}">Dirección</a></th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-300">
                            @foreach ( $schools as $school )
                            <tr class="odd:bg-white even:bg-gray-50">
                                    <td>{{ $school -> school_id }}</td>
                                    <td>{{ $school -> school_name }}</td>
                                    <td class="hidden md:table-cell">{{ $school -> school_address }}</td>
                                    <td class="space-x-2 flex justify-center">
                                        <a href="{{ url('/profile/school/' . $school -> school_id) }}" class="bg-amber-500 border-2 border-amber-500 px-2 py-0.5 rounded-md font-semibold text-white"> <i class="fa-solid fa-pen mr-2"></i> Editar</a>
                                        <form action="{{ url('/school/destroy/' . $school -> school_id) }}" method="post"  onsubmit="return confirm('¿Estás seguro que quieres eliminar este colegio?');">
                                            @csrf
                                            @method('DELETE')
                                            <button  class="bg-red-500 border-2 border-red-500 px-2 py-0.5 rounded-md font-semibold text-white"> 
                                                <i class="fa-solid fa-trash-can mr-2"></i> 
                                                Eliminar
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div id="create-modal" class="fixed inset-0 items-center justify-center bg-black bg-opacity-50 z-[100] hidden">
                    <div class="bg-white rounded-lg p-8 max-w-md w-full">
                        <span class="flex justify-between items-center">
                            <h2 class="text-xl font-bold tracking-tight mb-4">Crear Nuevo Colegio:</h2>
                            <button onclick="toggleModal()"
                            class="font-bold text-md border-2 border-black size-8 flex items-center justify-center rounded-full duration-300 hover:bg-gray-200">
                                <i class="fa-solid fa-x"></i>
                            </button>
                        </span>
                        <form action="{{ url('/school/store') }}" method="POST" enctype="multipart/form-data" class="w-full flex flex-col gap-4">
                            @csrf
                            <div class="flex flex-col gap-1 w-full">
                                <x-input-label for="school_name" value="Nombre del Colegio" class="after:content-['*'] after:ml-0.5 after:text-red-500"/>
                                <x-text-input id="school_name" name="school_name"
                                                type="text"
                                                class="block mt-1 w-full" 
                                                autofocus required/>
                            </div>
                            <div class="flex flex-col gap-1 w-full">
                                <x-input-label for="school_address" value="Dirección del Colegio" class="after:content-['*'] after:ml-0.5 after:text-red-500"/>
                                <x-text-input id="school_address" name="school_address"
                                                type="text"
                                                class="block mt-1 w-full" 
                                                autofocus required/>
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
                                file:cursor-pointer">
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
                                file:cursor-pointer">
                            </div>
                            <button type="submit"
                                class="py-2 px-4 bg-blue-500 hover:bg-blue-600 text-white font-semibold rounded-md focus:outline-none focus:shadow-outline">Crear Colegio</button>
                        </form>
                    </div>
                </div>
                
                <button onclick="toggleModal()"
                class="flex items-center justify-center bg-gray-200 border border-gray-300 rounded-md py-1.5 px-5 font-semibold text-lg text-gray-700">
                    <i class="fa-solid fa-plus mr-2"></i>
                    Crear nuevo colegio
                </button>
                
                <!-- Paginación de la tabla -->
                <div class="flex flex-col md:flex-row gap-2 justify-between items-center">
                    {{ $schools -> links() }}
                </div>
            </div>
        </div>
    </section>
</main>
<script>
    let Modal = document.getElementById('create-modal');
    function toggleModal() {
        Modal.classList.toggle('hidden');
        Modal.classList.toggle('flex');
    }
</script>
@endsection