@extends('layouts.app')

@section('title', 'Inicio')

@section('content')
<main class="flex flex-col items-center justify-center py-10 min-h-[90vh] bg-center bg-no-repeat bg-cover bg-[url(/public/images/banner.jpg)] relative  px-5">
    <div class="absolute inset-0 bg-gradient-to-b from-black to-black opacity-[20%]"></div>

    <div class="flex flex-col md:flex-row gap-10 w-full max-w-[1200px] z-10">
        <div class="bg-white rounded-md p-5 shadow-lg w-full md:w-[1fr] flex flex-col gap-4">
            <h1 class="text-3xl font-bold tracking-tight">Productos:</h1>
            
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <div class="space-y-4 divide-y divide-gray-300">
                @if (count($cart) < 1)
                    <h2 class="text-xl font-bold">No hay productos aún.</h2>
                @else
                    @foreach ( $cart as $item )
                        <article class="flex gap-5 p-5">
                            <a href="{{ url('/producto/'. $item['product_id']) }}">
                                <div class="size-[140px] flex justify-center items-center flex-none">
                                    <img src="{{ $item['product'] -> product_image_url }}" alt="Foto {{ $item['product'] -> product_name }}" class="max-h-full max-w-full">
                                </div>
                            </a>
                            <div class="w-full flex flex-col gap-4 justify-between">
                                <h1 class="text-2xl font-bold tracking-tight">{{ $item['product'] -> product_name }}</h1>
                                <form action="{{ url('/cart/update') }}" method="post" class="flex gap-2 items-center justify-between">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="product_id" value="{{ $item['product_id'] }}">

                                    <div>
                                        <x-input-label for="size_id" value="Talla"/>
                                        <select id="size_id" name="size_id" class="size-select rounded-md h-fit" data-product="{{$item['product']->product_id}}"
                                        onchange="this.form.submit()">
                                            @foreach ( $item['product'] -> sizes as $size)
                                                <option value="{{$size->size_id}}" data-price="{{$size->pivot->product_size_price}}" {{ $size -> size_id == $item['size_id'] ? 'selected' : '' }} >{{$size->size_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div>
                                        <x-input-label for="product_quantity" value="Cantidad"/>
                                        <x-text-input id="product_quantity" name="product_quantity" type="number" 
                                        value="{{ $item['product_quantity'] }}"
                                        class="w-[80px]"
                                        onchange="this.form.submit()"/>
                                    </div>
                                    <p class="font-bold text-lg">
                                        {{ number_format($item['product']->sizes->firstWhere('size_id', $item['size_id'])->pivot->product_size_price * $item['product_quantity']) }} COP
                                    </p>
                                </form>
                            </div>

                            <form action="{{ url( '/cart/delete/' . $item['product_id'] ) }}" method="post"  onsubmit="return confirm('¿Estás seguro que quieres eliminar este producto?');"
                            class="flex items-center">
                                @csrf
                                @method('DELETE')
                                <button  class="bg-red-500 border-2 border-red-500 px-2 py-0.5 rounded-md font-semibold text-white flex items-center"> 
                                    <i class="fa-solid fa-trash-can mr-2"></i> 
                                    Eliminar
                                </button>
                            </form>
                        </article>
                    @endforeach

                    <form action="{{ url( '/cart/clear/' ) }}" method="get"  onsubmit="return confirm('¿Estás seguro que quieres eliminar TODOS los productos?');"
                    class="flex items-center">
                        <button  class="bg-red-500 border-2 border-red-500 w-full  text-white font-bold text-lg py-0.5 px-5 rounded-md mt-5"> 
                            <i class="fa-solid fa-trash-can mr-2"></i> 
                            Vaciar carrito
                        </button>
                    </form>

                @endif
            </div>
        </div>
        <div class="bg-white rounded-md p-5 shadow-lg w-full md:w-[600px] flex flex-col gap-4 h-fit">
            <h1 class="text-3xl font-bold tracking-tight">Resumen:</h1>
            @php
                $total = 0;
                foreach ( $cart as $item ) {
                    $precio_item = $item['product']->sizes->firstWhere('size_id', $item['size_id'])->pivot->product_size_price * $item['product_quantity'];
                    $total += $precio_item;
                }
            @endphp
            <div class="flex justify-between text-lg">
                <strong>Precio total:</strong> <p> {{ number_format($total) }} COP</p>
            </div>
            
            <a href="{{ url('/pay') }}" class="mx-auto">
                <button  class="w-fit py-1 px-10 bg-amber-500 rounded-md font-semibold text-lg mx-auto shadow-sm duration-300">Continuar</button>
            </a>
        </div>
    </div>
</main>
@endsection
