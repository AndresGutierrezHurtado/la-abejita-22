@extends('layouts.app')

@section('title', 'Panel de control de productos')

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
                    <option value="/dashboard/schools">Colegios</option>
                    <option value="/dashboard/products" selected>Productos</option>
                </select>

                <!-- Título dashboard y búsqueda -->
                <span class="flex justify-between items-center">

                    <h1 class="text-2xl font-bold tracking-tight">Tabla de productos</h1>

                    <form action="{{ url('/dashboard/products/') }}" method="get" class="flex gap-0">
                        <input type="text" name="search" value="{{ request()->get('search') }}" placeholder="Buscar..." class="rounded-l-md py-1 px-2 border-gray-300 w-[300px]">
                        <button type="submit" class="bg-gray-600 rounded-r-md font-semibold text-white py-1 px-2">Buscar</button>
                        @if(request()->has('search') || request()->has('order'))
                            <a href="{{ url('/dashboard/products/') }}" class="bg-gray-300 rounded-md font-semibold text-black py-1 px-2 ml-2">Limpiar</a>
                        @endif
                    </form>
                </span>

                <!-- tabla con la información del dashboard -->
                <div class="w-full">
                    <table class="w-full text-center border border-gray-300 divide-y divide-gray-300">
                        <thead class="bg-gray-200 uppercase font-bold">
                            <tr>
                                <th><a href="{{ url('/dashboard/products') . '?' . http_build_query(array_merge(request()->except('order'), ['order' => 'product_id'])) }}">ID</a></th>
                                <th><a href="{{ url('/dashboard/products') . '?' . http_build_query(array_merge(request()->except('order'), ['order' => 'product_name'])) }}">Nombre</a></th>
                                <th><a href="{{ url('/dashboard/products') . '?' . http_build_query(array_merge(request()->except('order'), ['order' => 'product_description'])) }}">Descripción</a></th>
                                <th>Colegios</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-300">
                            @foreach ( $products as $product )
                                <tr class="even:bg-white odd:bg-gray-50">
                                    <td>{{ $product -> product_id }}</td>
                                    <td>{{ $product -> product_name }}</td>
                                    <td>{{ $product -> product_description }}</td>
                                    <td>
                                        <ul>
                                            @foreach($product -> schools as $school)
                                                <li>{{ $school -> school_name }}</li>
                                            @endforeach
                                        </ul>
                                    </td>
                                    <td class="space-x-2 flex justify-center">
                                        <a href="{{ url('/profile/product/' . $product -> product_id) }}" class="bg-amber-500 border-2 border-amber-500 px-2 py-0.5 rounded-md font-semibold text-white"> <i class="fa-solid fa-pen mr-2"></i> Editar</a>
                                        <form action="{{ url('/product/destroy/' . $product -> product_id) }}" method="post"  onsubmit="return confirm('¿Estás seguro que quieres eliminar este producto?');">
                                            @csrf
                                            @method('DELETE')
                                            <button class="bg-red-500 border-2 border-red-500 px-2 py-0.5 rounded-md font-semibold text-white"> 
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

                <div id="create-modal" class="absolute left-0 w-full top-0 min-h-screen items-center justify-center z-50 hidden">
                    <div class="fixed inset-0 bg-black bg-opacity-50" onclick="toggleModal()"></div>
                    <div class="bg-white rounded-lg p-8 max-w-[700px] w-full my-10 z-50">

                        <span class="flex justify-between items-center">
                            <h2 class="text-xl font-bold tracking-tight mb-4">Crear nuevo producto:</h2>
                            <button onclick="toggleModal()"
                            class="font-bold text-md border-2 border-black size-8 flex items-center justify-center rounded-full duration-300 hover:bg-gray-200">
                                <i class="fa-solid fa-x"></i>
                            </button>
                        </span>

                        <form action="{{ url('/product/store') }}" method="POST" enctype="multipart/form-data" class="w-full flex flex-col gap-4">
                            @csrf

                            <x-auth-session-status class="mb-4" :status="session('status')" />

                            <div class="flex flex-col gap-1 w-full">
                                <x-input-label for="product_name" value="Nombre del producto" class="after:content-['*'] after:ml-0.5 after:text-red-500"/>
                                <x-text-input id="product_name" name="product_name"
                                                type="text"
                                                class="block mt-1 w-full" 
                                                autofocus required/>
                            </div>

                            <div class="flex flex-col gap-1 w-full">
                                <x-input-label for="product_description" value="Descripción del producto" class="after:content-['*'] after:ml-0.5 after:text-red-500"/>
                                <x-text-input id="product_description" name="product_description"
                                                type="text"
                                                class="block mt-1 w-full" 
                                                autofocus required/>
                            </div>

                            <div class="flex flex-col gap-1 w-full">
                                <x-input-label for="product_image_url" value="Foto principal del producto (JPG)"/>
                                <input id="product_image_url" name="product_image_url" 
                                accept=".jpg,.jpeg,.png"
                                type="file"
                                class="block w-full border border-gray-300 shadow-sm rounded-lg text-sm focus:z-10 focus:border-blue-500 focus:ring-blue-500 bg-gray-200 cursor-pointer
                                disabled:opacity-50 disabled:pointer-events-none
                                file:bg-gray-50 file:border-0
                                file:mr-4
                                file:py-2 file:px-4
                                file:cursor-pointer">
                            </div>
                            
                            <div class="flex-col gap-2 w-full">
                                <x-input-label for="schools" value="Colegios"/>
                                <div id="schools">
                                    @foreach($schools as $school)
                                        <label class="flex items-center space-x-2">
                                            <input type="checkbox" name="schools[]" value="{{ $school->school_id }}">
                                            <span>{{ $school->school_name }}</span>
                                        </label>
                                    @endforeach
                                </div>
                            </div>

                            
                            <div class="flex-col gap-2">
                                <x-input-label for="sizes" value="Tallas Disponibles"/>
                                <div id="sizes" class="p-2">
                                    <table class="w-full text-center">
                                        <thead>
                                            <tr>
                                                <th>Disponible</th>
                                                <th>Talla</th>
                                                <th>Precio</th>
                                                <th>Cantidad</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($sizes as $size)
                                                <tr>
                                                    <td>
                                                        <input type="checkbox" name="sizes[]" value="{{ $size->size_id }}">
                                                    </td>
                                                    <td>{{ $size->size_name }}</td>
                                                    <td>
                                                        <x-text-input id="size_price_{{ $size->size_id }}" 
                                                                    name="size_prices[{{ $size->size_id }}]"
                                                                    type="number"
                                                                    value="0"/>
                                                    </td>
                                                    <td>
                                                        <x-text-input id="size_stock_{{ $size->size_id }}" 
                                                                    name="size_stocks[{{ $size->size_id }}]"
                                                                    type="number"
                                                                    value="0"/>
                                                    </td>
                                                </tr>
                                            @endforeach                                    
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <button type="submit"
                                class="py-2 px-4 bg-blue-500 hover:bg-blue-600 text-white font-semibold rounded-md focus:outline-none focus:shadow-outline">Crear producto</button>
                        </form>
                    </div>
                </div>
                
                <button onclick="toggleModal()"
                class="flex items-center justify-center bg-gray-200 border border-gray-300 rounded-md py-1.5 px-5 font-semibold text-lg text-gray-700">
                    <i class="fa-solid fa-plus mr-2"></i>
                    Crear nuevo producto
                </button>

                <!-- Paginación de la tabla -->
                <div class="flex justify-between items-center">
                    {{ $products -> links() }}
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