@extends('layouts.app')

@section('title', $school -> school_name)

@section('content')
<main>
    <section class="w-full flex justify-center bg-slate-800 py-16">
        <div class="w-full max-w-[1200px] flex flex-col items-center justify-center gap-4">
            <div class="size-[200px] rounded-full overflow-hidden flex items-center justify-center">
                <img src="{{$school -> school_image_url}}" alt="max-w-full max-h-full">
            </div>
            <h1 class="text-center text-5xl font-bold text-slate-50 tracking-tight">{{$school -> school_name}}</h1>
            <p class="text-lg font-semibold text-slate-100/75">{{$school -> school_address}}</p>
        </div>
    </section>
    <section class="w-full flex justify-center">
        <div class="w-full max-w-[1200px] flex flex-col gap-5 py-10">
            <span class="w-full flex justify-center">
                <button class="py-1 px-5 border-2 border-slate-950 text-slate-950 font-semibold text-xl rounded-full">
                    Guía de uso
                </button>
            </span>
            <div class="grid grid-cols-[repeat(auto-fill,_minmax(230px,_1fr))] gap-10">

            @foreach ($products as $product)
                <article class="bg-white p-5 rounded-md shadow-md">
                    <div class="w-full">
                        <img src="{{$product->product_image_url}}" alt="">
                    </div>
                    <div class="flex flex-col gap-2">
                        <h3 class="text-xl font-bold tracking-tight capitalize">{{$product->product_name}}</h3>
                        <p class="text-black/75 mb-2">{{$product->product_description}}</p>
                        <div class="flex justify-between items-center">
                            <select class="size-select rounded-md h-fit" data-product="{{$product->product_id}}">
                                @foreach ($product->sizes as $size)
                                    <option value="{{$size->size_id}}" data-price="{{$size->pivot->price}}">{{$size->size_name}}</option>
                                @endforeach
                            </select>
                            <p id="price{{$product->product_id}}" class="font-semibold" >{{number_format($product->sizes->first()->pivot->price ?? 0)}} COP</p>
                        </div>
                        <button><i class="fa-solid fa-cart-shopping"></i></button>
                    </div>
                </article>
            @endforeach
            </div>
        </div>
    </section>
</main>

<!-- JavaScript para manejar el cambio de precio -->
<script>
    // Capturar el cambio en el select
    document.querySelectorAll('.size-select').forEach(select => {
        select.addEventListener('change', function() {
            const productId = this.dataset.product;
            const selectedSize = this.value;
            const selectedPrice = this.options[this.selectedIndex].dataset.price;
            document.querySelector(`#price${productId}`).textContent = ` $${selectedPrice}`;
        });
    });
</script>
@endsection