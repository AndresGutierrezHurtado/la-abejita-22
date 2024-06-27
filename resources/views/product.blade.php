@extends('layouts.app')

@section('title', $product -> product_name)

@section('content')
<main class="flex flex-col gap-10 py-10 min-h-[90vh] bg-center bg-no-repeat bg-cover bg-[url(/public/images/banner.jpg)] relative">
    <div class="absolute inset-0 bg-gradient-to-b from-black to-black opacity-[20%]"></div>
    <div class="w-full flex justify-center px-5">
        <div class="flex flex-col gap-10 w-full max-w-[1200px] z-10">
            <section class="flex flex-col md:flex-row gap-5 bg-white w-full p-7 rounded-md shadow-lg">
                <div class="w-full md:w-1/2">
                    <div class="w-full border border-gray-200 divide-y">
                        <div id="imagen-space" class="w-full flex items-center justify-center">
                            <img src="{{ $product->product_image_url }}" alt="Foto {{ $product->product_name }}" class="max-h-[350px] max-w-full">
                        </div>

                        <div class="w-full max-h-[140px] overflow-x-scroll overflow-y-hidden flex items-center gap-5 p-2 py-5" id="thumbnails-container">
                            <img src="{{ $product->product_image_url }}" alt="Foto {{ $product->product_name }}" class="thumbnail max-h-[100px] w-auto border border-red-500 active cursor-pointer duration-300 hover:shadow-lg hover:scale-[1.03]">
                            
                            @foreach ($product->media as $media)
                                @if (pathinfo($media->media_url, PATHINFO_EXTENSION) == 'mp4')
                                    <video class="thumbnail max-h-[100px] w-auto border border-gray-600 cursor-pointer duration-300 hover:shadow-lg hover:scale-[1.03]">
                                        <source src="{{ $media->media_url }}" type="video/mp4">
                                        Tu navegador no soporta video HTML5.
                                    </video>
                                @else
                                    <img src="{{ $media->media_url }}" alt="Imagen" class="thumbnail max-h-[100px] w-auto border border-gray-600 cursor-pointer duration-300 hover:shadow-lg hover:scale-[1.03]">
                                @endif
                            @endforeach
                        </div>


                    </div>
                </div>
                <div class="w-full md:w-[1fr] flex flex-col justify-between gap-4">
                    <div>                        
                        <h1 class="text-4xl font-bold tracking-tight">{{ $product -> product_name }}</h1>
                        <p class="text-xl font-bold">{{number_format($product->sizes[0]->pivot->product_size_price)}} COP - {{number_format($product->sizes->last()->pivot->product_size_price)}} COP</p>
                        <p>{{ $product -> product_description }}</p>
                    </div>
                    <div>
                        <p class="w-full border border-gray-200 p-3 bg-gray-50"> <strong>Material:</strong> {{ $product -> product_materials }}</p>
                        <p><strong> Dirección: </strong> Tv. 69c #68b Sur, Bogotá </p>
                    </div>
                    <x-auth-session-status class="mb-4" :status="session('status')" />  
                    <form method="post" action="{{ url('/cart/add/') }}" class="flex flex-col justify-center space-y-4">    
                        @csrf
                        
                        <input type="hidden" name="product_id" value="{{ $product->product_id }}">
                        
                        <div class="flex justify-between items-center">
                            <select name="size_id" class="size-select rounded-md h-fit" data-product="{{$product->product_id}}">
                                @foreach ($product->sizes as $size)
                                    <option value="{{$size->size_id}}" data-price="{{$size->pivot->product_size_price}}">{{$size->size_name}}</option>
                                @endforeach
                            </select>
                            <p id="price{{$product->product_id}}" class="font-semibold" >{{number_format($product->sizes->first()->pivot->product_size_price ?? 0)}} COP</p>
                        </div>

                        <button class="w-full py-2 px-5 rounded-md shadow-lg bg-amber-500 text-lg font-semibold text-white">
                            <i class="fa-solid fa-cart-plus mr-2"></i>
                            Añadir al carrito
                        </button>
                    </form>
                </div>
            </section>
            
            <section class="bg-white w-full p-8 rounded-md shadow-lg space-y-4">
                <div class="flex flex-col md:flex-row gap-5">
                    <div class="w-full md:w-1/2">
                        <h1 class="text-3xl font-bold tracking-tight text-gray-800">Pasos para realizar compra: </h1>
                        <p class="text-lg">Para realizar tu compra de manera efectiva, sigue estos pasos:</p>
                        <ol class="my-2 text-gray-700 space-y-1">
                            <li>Seleccionar el producto deseado junto a su talla y cantidad.</li>
                            <li>Ir al proceso de pago.</li>
                            <li>Llenar tus datos personales y de entrega.</li>
                            <li>Seleccionar la opción de envío a domicilio o recoger en la tienda.</li>
                            <li>Realizar el pago mediante el sistema de PayU.</li>
                            <li>Confirmar la compra y esperar la entrega del producto.</li>
                        </ol>
                    </div>
                    <div class="w-full md:w-1/2">
                        <h1 class="text-2xl font-bold tracking-tight text-gray-800">Importante</h1>
                        <ol class="my-2 text-gray-800 space-y-2">
                            <li>Si tienes alguna duda comunícate con nostros al numero 3124852078</li>
                            <li>Compra 100% segura mediante la plataforma de PayU</li>
                            <li>Realizamos nuestros productos con la mayor calidad</li>
                        </ol>
                    </div>
                </div>
                <hr>
                <div class="space-y-5">
                    <div>
                        <h2 class="text-3xl font-bold tracking-tight text-gray-800">dirección</h2>
                        <p>Tv. 69c #68b Sur, Bogotá (Casa 327)</p>
                    </div>
                    <img src="{{ url('/images/maps.jpg') }}" alt="Dirección local" class="max-w-full">
                </div>
            </section>
        </div>
    </div>
</main>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Declarar variables globales
        const thumbnailsContainer = document.getElementById('thumbnails-container');
        const imageSpace = document.getElementById('imagen-space');

        thumbnailsContainer.addEventListener('click', (event) => {
            const target = event.target;

            if (target.tagName === 'IMG' || target.tagName === 'VIDEO') {
                // Remover la clase 'border-red-500' de los elementos previamente seleccionados
                const selectedElements = thumbnailsContainer.querySelectorAll('.active');
                selectedElements.forEach(element => {
                    element.classList.remove('border-red-500');
                    element.classList.remove('active');
                    element.classList.add('border-gray-600');
                });
                target.classList.remove('border-gray-600');
                target.classList.add('active');
                target.classList.add('border-red-500');

                // Limpiar el contenedor de imagen grande
                imageSpace.innerHTML = '';

                // Aplicar clases y ponerlo en el container
                const clonedElement = target.cloneNode(true);
                clonedElement.classList.remove('border', 'hover:scale-[1.03]');
                if (target.tagName === 'VIDEO') {
                    clonedElement.classList.add('max-h-[350px]', 'w-full', 'bg-gray-800');
                    clonedElement.controls = true;
                } else {
                    clonedElement.classList.add('max-h-[350px]', 'max-w-full');
                }
                imageSpace.appendChild(clonedElement);
            }
        });

    });

    // Capturar el cambio en el select 
    document.querySelectorAll('.size-select').forEach(select => {
        select.addEventListener('change', function() {
            const productId = this.dataset.product;
            const selectedSize = this.value;
            const selectedPrice = this.options[this.selectedIndex].dataset.price;
            document.querySelector(`#price${productId}`).textContent = ` ${parseInt(selectedPrice).toLocaleString("en-US")} COP`;
        });
    });
</script>
@endsection