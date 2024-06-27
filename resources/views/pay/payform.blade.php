@extends('layouts.secondary')

@section('title', 'Procesa tu compra')

@section('content')
<main class="w-full min-h-screen flex items-center justify-center bg-center bg-no-repeat bg-cover bg-[url(/public/images/banner.jpg)] relative">
    <div class="absolute inset-0 bg-gradient-to-b from-black to-black opacity-[20%]"></div>
    <div class="flex flex-col md:flex-row gap-10 w-full max-w-[1200px] z-10 py-10">
        <div class="w-full max-w-[400px] mx-auto z-50 space-y-10">
            <div class="p-5 md:p-10 bg-white shadow-lg rounded-md space-y-4 text-md">
                <h1 class="text-2xl font-bold tracking-tight">Información de la compra: </h1>
                <ol>
                    @foreach ( $cart as $item )
                        <li class="flex justify-between">
                            <p>{{ $item['product_quantity'] }} - {{ $item['product'] -> product_name }} (Talla {{ $item['size_name'] }})</p>
                            <p>{{ number_format($item['size_price'] * $item['product_quantity']) }} COP</p>
                        </li>
                    @endforeach
                </ol>
                @php
                    $total = 0;
                    foreach ( $cart as $item ) {
                        $total += $item['size_price'] * $item['product_quantity'] ;
                    }
                @endphp
                <p class="text-lg font-semibold">Total: {{ number_format($total) }} COP</p>
            </div>
            
            <div class="p-5 md:p-10 bg-white shadow-lg rounded-md space-y-4 text-md flex items-center gap-4">
                <div class="size-[100px] flex-none flex items-center justify-center">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/c/cd/PayU.svg/1200px-PayU.svg.png" alt="" class="max-h-full max-w-full">
                </div>
                <p>El pago se realizará utilizando los servicios de PayU, realizando el débito desde su cuenta corriente o de ahorros.</p>
            </div>
        </div>
        <div class=" w-full p-5 md:p-10 bg-white shadow-lg rounded-md mx-auto z-50">
            @php
                $merchantId = env('PAYU_MERCHANT_ID');
                $apiKey = env('PAYU_API_KEY');
                $referenceCode =  Auth::user() -> user_id . '_' . date('YmdHis') ;
                $amount = $total;
                $currency = "COP";
                
                $signatureString = "$apiKey~$merchantId~$referenceCode~$amount~$currency";
            @endphp
            <h1 class="text-2xl font-bold tracking-tight">Formulario de pago: </h1>
            <form id="paymentForm" method="post" action="{{ env('PAYU_REQUEST_URI') }}" class="space-y-4">
                <input name="merchantId"      type="hidden"  value="{{ env('PAYU_MERCHANT_ID') }}">
                <input name="accountId"       type="hidden"  value="{{ env('PAYU_ACCOUNT_ID') }}">
                <input name="description"     type="hidden"  value="{{ 'Compra de ' . count($cart) . ' productos.' }}">
                <input name="referenceCode"   type="hidden"  value="{{ $referenceCode }}">
                <input name="amount"          type="hidden"  value="{{ $total }}">
                <input name="tax"             type="hidden"  value="0">
                <input name="taxReturnBase"   type="hidden"  value="0">
                <input name="currency"        type="hidden"  value="{{ $currency }}" >
                <input name="signature"       type="hidden"  value="{{ md5($signatureString) }}">
                <input name="test"            type="hidden"  value="{{ env('PAYU_TEST_MODE') }}" >
                <input name="ing"             type="hidden"  value="es" >
                <input name="responseUrl"     type="hidden"  value="{{ url('/pay/callback') }}">
                

                <div class="space-y-1">
                    <x-input-label for="buyerFullName" value="Nombre completo" class="after:content-['*'] after:ml-0.5 after:text-red-500"/>
                    <x-text-input name="buyerFullName" id="buyerFullName" type="text" required />
                </div>

                <div class="space-y-1">
                    <x-input-label for="buyerEmail" value="Correo electrónico" class="after:content-['*'] after:ml-0.5 after:text-red-500"/>
                    <x-text-input name="buyerEmail" id="buyerEmail" type="email" required />
                </div>

                <div class="space-y-1">
                    <x-input-label for="payerPhone" value="Número telefónico" class="after:content-['*'] after:ml-0.5 after:text-red-500"/>
                    <x-text-input name="payerPhone" id="payerPhone" type="number" required />
                </div>

                <div class="space-y-1">
                    <x-input-label for="payerPhone" value="Número y tipo de documento"  class="after:content-['*'] after:ml-0.5 after:text-red-500"/>
                    <div class="flex flex-col md:flex-row gap-4">
                        <select name="payerDocumentType" id=""
                        class="border-gray-300 rounded-md shadow-sm disabled:bg-gray-50 disabled:cursor-not-allowed w-fit max-w-full" 
                        required>
                            <option value="CC">Cédula de Ciudadanía</option>
                            <option value="CE">Cédula de Extranjería</option>
                            <option value="TI">Tarjeta de Identidad</option>
                            <option value="PPN">Pasaporte</option>
                            <option value="NIT">Número de Identificación Tributaria</option>
                            <option value="SSN">Social Security Number</option>
                            <option value="EIN">Employer Identification Number</option>
                        </select>
                        <x-text-input name="payerDocument" id="payerDocument" type="number" required />
                    </div>
                </div>

                <div>
                    <input type="checkbox" id="deliveryOption" name="deliveryOption" value="storePickup" onchange="toggleAddressFields()">
                    <label for="deliveryOption">Recoger en tienda</label>
                </div>

                <div class="flex flex-col md:flex-row gap-4" id="addressFields">
                    <div class="w-full md:w-1/2 space-y-1">
                        <x-input-label for="shippingAddress" value="Dirección"/>
                        <x-text-input name="shippingAddress" id="shippingAddress" type="text" />
                    </div>
                    <div class="w-full md:w-1/2 space-y-1">
                        <x-input-label for="zipCode" value="Código postal"/>
                        <x-text-input name="zipCode" id="zipCode" type="text" />
                        <input name="shippingCity"       type="hidden"  value="Bogotá" >
                        <input name="shippingCountry"    type="hidden"  value="CO"  >
                    </div>
                </div>

                <div>
                    <button type="Submit" type="submit" 
                    class="bg-amber-500 py-1.5 px-4 rounded-md font-semibold w-full mt-4">
                        <i class="fa-regular fa-credit-card mr-2"></i>
                        Pagar 
                    </button>
                </div>
            </form>
        </div>
    </div>
</main>

<script>
    function toggleAddressFields() {
        var checkbox = document.getElementById('deliveryOption');
        var addressFields = document.getElementById('addressFields');
        if (checkbox.checked) {
            addressFields.classList.add('hidden');
        } else {
            addressFields.classList.remove('hidden');
        }
    }


    document.getElementById('paymentForm').addEventListener('submit', function(event) {
        event.preventDefault();

        var formData = new FormData(this);

        fetch('/pay/store-session-data', {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                this.submit();
            } else {
                alert('Error al guardar los datos.');
            }
        })
        .catch(error => console.error('Error:', error));
    });
</script>

@endsection