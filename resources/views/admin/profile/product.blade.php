@extends('layouts.app')

@section('title', 'Perfil ' . $product -> product_name )

@section('content')

<main class="flex flex-col gap-10 py-10 min-h-[90vh] bg-center bg-no-repeat bg-cover bg-[url(/public/images/banner.jpg)] relative">
    <div class="absolute inset-0 bg-gradient-to-b from-black to-black opacity-[20%]"></div>
    <section class="w-full flex justify-center px-5">
        <div class="flex flex-col md:flex-row gap-10 w-full max-w-[1200px] z-10">
            <div class="flex flex-col gap-10 w-full max-w-[400px]">
                <div class="bg-white rounded-md p-7 shadow-lg w-full flex flex-col justify-center items-center gap-4 h-fit">
                    <span class="w-full flex justify-between items-center gap-5">
                        <h1 class="text-2xl font-bold tracking-tight">Información:</h1>
                        <a class="font-bold text-lg border-2 border-black rounded-full size-7 flex items-center justify-center hover:bg-gray-200 duration-300" 
                        href="{{ url('/dashboard/products') }}"><</a>
                    </span>
                    <div class="size-44 border-2 border-black rounded-md overflow-hidden shadow-lg flex justify-center items-center">
                        <img src="{{ $product -> product_image_url }}" alt="Foto de {{ $product -> product_name }}" class="max-h-full max-w-full w-auto h-auto">
                    </div>
                    <div class="text-center">
                        <h2 class="text-xl font-bold tracking-tight text-gray-800">{{ $product -> product_name }}</h2>
                        <p class="italic text-gray-700"><strong>Descripción:</strong> {{ $product -> product_description }}</p>
                    </div>
                    <button id="edit-button" class="border border-gray-300 rounded-md w-full py-1.5 bg-gray-50 duration-300 hover:bg-gray-200">Editar</button>
                </div>
                <div class="bg-white rounded-md p-7 shadow-lg w-full flex flex-col gap-4 h-fit">
                    <h1 class="text-2xl font-bold tracking-tight">Archivos multimedia:</h1>
                    @if (count($product -> media) < 1 )
                        <h1 class="text-lg font-semibold tracking-tigh text-center mt-2">No hay archivos adjuntados a este producto aún.</h1>
                    @endif
                    @foreach ( $product -> media as $media )

                        @if (pathinfo($media -> media_url, PATHINFO_EXTENSION) == 'mp4')
                            <video class="w-full max-h-[300px] border border-gray-300 bg-slate-900" 
                            controls>
                                <source src="{{ $media -> media_url }}" type="video/mp4">
                                Tu navegador no soporta video HTML5.
                            </video>
                        @else
                            <img src="{{ $media -> media_url }}" alt="Imagen" class="w-fit mx-auto max-h-[300px] border border-gray-300 bg-slate-900">
                        @endif
                    
                        <form action="{{ url('/product/media/destroy/' . $media -> media_id) }}" method="post"  onsubmit="return confirm('¿Estás seguro que quieres eliminar este archivo?');">
                            @csrf
                            @method('DELETE')
                            <button class="bg-red-500 border-2 border-red-500 px-2 py-0.5 rounded-md font-semibold text-white"> 
                                <i class="fa-solid fa-trash-can mr-2"></i> 
                                Eliminar
                            </button>
                        </form>

                    @endforeach
                </div>
            </div>

            <div class="bg-white rounded-md p-7 shadow-lg w-full flex flex-col justify-center items-center gap-4 h-fit">
                <form action="{{ url('/profile/product/'. $product-> product_id) }}" method="POST" enctype="multipart/form-data" class="w-full flex flex-col gap-4">
                    @csrf
                    @method('PUT')

                    @if ($errors->any())
                        <div class="w-full bg-red-400 border-2 border-red-600 text-red-800 py-2 px-4 rounded-md">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <x-auth-session-status class="mb-4" :status="session('status_profile')" />

                    <div class="flex flex-col gap-2">
                        <x-input-label for="product_name" value="Nombre del producto"/>
                        <x-text-input id="product_name" name="product_name"
                                      type="text"
                                      value="{{ $product->product_name }}"
                                      required autofocus disabled/>
                    </div>
                    <div class="flex flex-col gap-2">
                        <x-input-label for="product_description" value="Descripción del Producto"/>
                        <x-text-input id="product_description" name="product_description"
                                      type="text"
                                      value="{{ $product->product_description }}"
                                      required autofocus disabled/>
                    </div>
                    <div class="flex flex-col gap-2">
                        <x-input-label for="product_materials" value="Materiales del Producto"/>
                        <textarea id="product_materials" name="product_materials"
                                  class="border-gray-300 rounded-md shadow-sm disabled:bg-gray-50 disabled:cursor-not-allowed resize-none h-[100px]"
                                  required autofocus disabled>{{ $product->product_materials }}</textarea>
                    </div>
                    
                    <div class="flex flex-col gap-1 w-full">
                        <x-input-label for="product_image_url" value="Imagen principal del producto (JPG)"/>
                        <input id="product_image_url" name="product_image_url" 
                               accept=".jpg,.jpeg,.png"
                               type="file"
                               class="block w-full border border-gray-300 shadow-sm rounded-lg text-sm focus:z-10 focus:border-blue-500 focus:ring-blue-500 bg-gray-200 cursor-pointer
                                      disabled:opacity-50 disabled:pointer-events-none
                                      file:bg-gray-50 file:border-0
                                      file:mr-4
                                      file:py-2 file:px-4
                                      file:cursor-pointer
                                      disabled:cursor-not-allowed"
                               disabled>
                    </div>

                    <div class="flex flex-col gap-1 w-full">
                        <x-input-label for="school_image_url" value="Contenido multimedia (Fotos y videos)"/>
                        <input id="product_media" name="product_media[]" 
                               accept=".jpg,.jpeg,.png,.mp4,.avi"
                               type="file"
                               class="block w-full border border-gray-300 shadow-sm rounded-lg text-sm focus:z-10 focus:border-blue-500 focus:ring-blue-500 bg-gray-200 
                                      cursor-pointer
                                      disabled:opacity-50 disabled:pointer-events-none
                                      file:bg-gray-50 file:border-0
                                      file:mr-4
                                      file:py-2 file:px-4
                                      file:cursor-pointer
                                      disabled:cursor-not-allowed"
                               multiple disabled onchange="checkFileCount(this <?= ',' . count($product->media) ?>)">
                    </div>

                    <div id="schools-options" class="flex-col gap-2 w-full hidden">
                        <x-input-label for="schools" value="Colegios"/>
                        <div id="schools">
                            @foreach($schools as $school)
                                <label class="flex items-center space-x-2">
                                    <input type="checkbox" name="schools[]" value="{{ $school->school_id }}" 
                                           {{ in_array($school->school_id, $product->schools->pluck('school_id')->toArray()) ? 'checked' : '' }} 
                                           disabled>
                                    <span>{{ $school->school_name }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>

                    <div id="sizes-section" class="flex-col gap-2 hidden">
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
                                        @php 
                                        $productSize = $product->sizes->firstWhere('size_id', $size->size_id);
                                        @endphp
                                        
                                        <tr>
                                            <td>
                                                <input type="checkbox" name="sizes[]" value="{{ $size->size_id }}" 
                                                       {{ $productSize ? 'checked' : '' }} disabled>
                                            </td>
                                            <td>{{ $size->size_name }}</td>
                                            <td>
                                                <x-text-input id="size_price_{{ $size->size_id }}" 
                                                              name="size_prices[{{ $size->size_id }}]"
                                                              type="number"
                                                              value="{{ $productSize ? $productSize->pivot->product_size_price : '0' }}" />
                                            </td>
                                            <td>
                                                <x-text-input id="size_stock_{{ $size->size_id }}" 
                                                              name="size_stocks[{{ $size->size_id }}]"
                                                              type="number" 
                                                              value="{{ $productSize ? $productSize->pivot->product_size_stock : '0' }}" />
                                            </td>
                                        </tr>
                                    @endforeach                                    
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <button id="submit-button" class="bg-amber-500 font-semibold py-1.5 px-5 text-white rounded-md shadow-md mt-4 hidden">
                        <i class="fa-solid fa-upload mr-2"></i>
                        Actualizar Producto
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
            document.getElementById('schools-options').classList.remove('hidden');
            document.getElementById('sizes-section').classList.remove('hidden');
            document.getElementById('schools-options').classList.add('flex');
            document.getElementById('sizes-section').classList.add('flex');
            document.querySelectorAll('input').forEach(input => {
                input.removeAttribute('disabled');
            })
            document.querySelector('textarea').removeAttribute('disabled');
        } else {
            if (confirm('¿Quieres regresar y perder los cambios?')) {
                window.location.reload();
            }
        }
        editable = !editable;
    });
    
    function checkFileCount(input, archivos = 4) {
        // Obtener la lista de archivos seleccionados
        var files = input.files;
        
        // Verificar la cantidad de archivos seleccionados
        if (files.length > ( 4 - archivos) ) {
            alert("Solo puedes seleccionar un máximo de " + (4 - archivos) +" archivos");
            input.value = '';
        }
    }
</script>
@endsection
