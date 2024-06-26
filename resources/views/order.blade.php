@extends('layouts.app')

@section('title', 'Compra')

@section('content')
<main class="flex flex-col gap-10 py-10 min-h-[90vh] bg-center bg-no-repeat bg-cover bg-[url(/public/images/banner.jpg)] relative">
    <div class="absolute inset-0 bg-gradient-to-b from-black to-black opacity-[20%]"></div>
    <section class="w-full flex justify-center">
        <div class="flex flex-col gap-5 w-full max-w-[800px] z-10 bg-white rounded-md p-7 shadow-lg">
            <div class="flex flex-col gap-1 justify-center items-center">
                <div class="size-[120px]">
                    <img src="{{ url('/images/logo.png') }}" alt="Foto la abejita22" 
                    class="object-cover h-full w-full">
                </div>
                <h1 class="text-2xl font-bold tracking-tight text-slate-800">Uniformes la abejita 22</h1>
                <a href="{{ url('/profile/user') }}">
                    <button class="py-1 px-4 border-2 border-black rounded-full font-semibold mt-1 hover:bg-gray-100">
                        <i class="fa-solid fa-arrow-left mr-2"></i>
                        Volver
                    </button>
                </a>
            </div>

            <hr>

            <div class="flex items-center gap-10">
                <div class="w-full md:w-1/2 space-y-4">
                    <h1 class="text-3xl font-bold tracking-tight">Detalles de la compra:</h1>
                    <div>
                        <p>
                            <strong>Nombre: </strong>
                            {{ $order -> paymentDetails -> payment_buyer_full_name }} 
                        </p>
                        <p>
                            <strong>Email: </strong>
                            {{ $order -> paymentDetails -> payment_buyer_email }} 
                        </p>
                        <p>
                            <strong>Teléfono: </strong>
                            {{ $order -> paymentDetails -> payment_buyer_phone }} 
                        </p>
                    </div>
                </div>
                <div class="w-full md:w-1/2 space-y-4">
                    <h1 class="text-2xl font-bold tracking-tight">Información adicional:</h1>
                    <div>
                        <p>
                            <strong>Precio total: </strong>
                            {{ number_format($order -> paymentDetails -> payment_amount) }} COP
                        </p>
                        <p>
                            <strong>Dirección de entrega: </strong>
                            {{ ($order -> paymentDetails -> payment_delivery_option == 'recoger') ? 'Recoge en la tienda' : $order -> paymentDetails -> payment_shipping_address }} 
                        </p>
                        <p>
                            <strong>Estado de la entrega: </strong>
                            {{ $order -> order_state }} 
                        </p>
                    </div>
                </div>
            </div>
            <a href="{{ url('/receipt/'. $order -> order_id) }}" class="w-full">
                <button class="bg-amber-500 py-1.5 px-4 rounded-md font-semibold w-full">
                    <i class="fas fa-download mr-2" aria-hidden="true"></i>
                    Descarga factura
                </button>
            </a>

            <hr>

            <h1 class="text-3xl font-bold tracking-tight">Productos</h1>
            @foreach ( $order -> soldProducts as $product )
                <article class="flex gap-5 justify-between items-center p-5 w-full border rounded-md mx-auto">
                    <div class="size-[160px] flex items-center justify-center flex-none">
                        <img src="{{ $product -> product -> product_image_url }}" alt="" class="max-w-full max-h-full">
                    </div>
                    <div class="w-full min-w-[1fr] flex flex-col justify-between h-full ">
                        <div>
                            <h1 class="text-lg font-bold">{{ $product -> product -> product_name }}</h1>
                            <p>Talla: {{ $product -> size -> size_name }}</p>
                        </div>
                        <div>
                            <p>Precio: {{ number_format($product -> size -> pivot -> product_size_price) }} COP</p>
                            <p>cantidad: {{ $product -> product_quantity }} </p>
                        </div>
                    </div>
                    <div class="h-full min-w-[140px] flex-none flex items-center justify-center">
                        <p class="text-lg font-bold"> {{ number_format($product -> size -> pivot -> product_size_price * $product -> product_quantity) }} COP </p>
                    </div>
                </article>
            @endforeach

        </div>
    </section>
</main>
@endsection
