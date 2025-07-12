@extends('layouts.app')

@section('title', 'Perfil')

@section('content')
<section class="w-full px-5">
    <div class="w-full max-w-[1300px] mx-auto py-10 space-y-10">
        {{-- Encabezado de perfil --}}
        <div class="flex flex-col md:flex-row items-center gap-6">
            <div class="avatar">
                <div class="size-32 rounded-full">
                    <img src="{{ $user['user_image'] }}" alt="Imagen de perfil de {{ $user['user_name'] }}" />
                </div>
            </div>

            <div>
                <h2 class="text-3xl font-bold leading-[100%]">
                    {{ $user['user_name'] }} {{ $user['user_lastname'] }}
                </h2>
                <p class="text-base-content text-lg capitalize">{{ $user['role']['role_name'] }}</p>
                <div class="tooltip flex">
                    <a href="mailto:{{ $user['user_email'] }}" target="_blank" class="text-base-content/70 hover:underline tooltip-toggle">{{ $user['user_email'] }}</a>
                    <div class="tooltip-content tooltip-shown:opacity-100 tooltip-shown:visible" role="tooltip">
                        <div class="tooltip-body flex items-center gap-2">
                            <span class="icon-[tabler--mail] size-4 shrink-0"></span>
                            Enviar correo
                        </div>
                    </div>
                </div>
                <div class="tooltip flex">
                    <a href="https://wa.me/{{ $user['user_phone'] }}" target="_blank" class="text-base-content/70 hover:underline tooltip-toggle">{{ $user['user_phone'] }}</a>
                    <div class="tooltip-content tooltip-shown:opacity-100 tooltip-shown:visible" role="tooltip">
                        <div class="tooltip-body flex items-center gap-2">
                            <span class="icon-[tabler--phone] size-4 shrink-0"></span>
                            Contactar via whatsapp
                        </div>
                    </div>
                </div>
                <p class="text-base-content/70">{{ $user['user_address'] ?? 'Sin dirección' }}</p>
            </div>
        </div>

        <nav class="tabs tabs-bordered overflow-x-auto text-nowrap no-scrollbar" aria-label="Tabs" role="tablist" aria-orientation="horizontal">
            <button type="button" class="tab active-tab:tab-active active" id="tabs-icons-item-1" data-tab="#tabs-icons-1" aria-controls="tabs-icons-1" role="tab" aria-selected="true">
                <span class="icon-[tabler--shopping-bag] size-5 shrink-0 me-2"></span>
                Mis compras
            </button>
            <button type="button" class="tab active-tab:tab-active" id="tabs-icons-item-2" data-tab="#tabs-icons-2" aria-controls="tabs-icons-2" role="tab" aria-selected="false">
                <span class="icon-[tabler--heart] size-5 shrink-0 me-2"></span>
                Favoritos
            </button>
            <button type="button" class="tab active-tab:tab-active" id="tabs-icons-item-3" data-tab="#tabs-icons-3" aria-controls="tabs-icons-3" role="tab" aria-selected="false">
                <span class="icon-[tabler--edit] size-5 shrink-0 me-2"></span>
                Editar perfil
            </button>
            <button type="button" class="tab active-tab:tab-active" id="tabs-icons-item-4" data-tab="#tabs-icons-4" aria-controls="tabs-icons-4" role="tab" aria-selected="false">
                <span class="icon-[tabler--settings] size-5 shrink-0 me-2"></span>
                Configuración
            </button>
            @if ($user['role']['role_name'] == 'administrador')
                <button type="button" class="tab active-tab:tab-active" id="tabs-icons-item-5" data-tab="#tabs-icons-5" aria-controls="tabs-icons-5" role="tab" aria-selected="false">
                    <span class="icon-[tabler--shield-lock] size-5 shrink-0 me-2"></span>
                    Administrar usuarios
                </button>
                <button type="button" class="tab active-tab:tab-active" id="tabs-icons-item-6" data-tab="#tabs-icons-6" aria-controls="tabs-icons-6" role="tab" aria-selected="false">
                    <span class="icon-[tabler--shield-lock] size-5 shrink-0 me-2"></span>
                    Administrar colegios
                </button>
                <button type="button" class="tab active-tab:tab-active" id="tabs-icons-item-7" data-tab="#tabs-icons-7" aria-controls="tabs-icons-7" role="tab" aria-selected="false">
                    <span class="icon-[tabler--shield-lock] size-5 shrink-0 me-2"></span>
                    Administrar productos
                </button>
            @endif
        </nav>

        <div class="mt-3">
            <div id="tabs-icons-1" role="tabpanel" aria-labelledby="tabs-icons-item-1">
                <!-- PURCHASES -->
                <p class="text-base-content/80">Acá verás el historial de tus compras dentro de la plataforma.</p>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    <div class="card bg-base-100 shadow-xl">
                        <div class="card-body">
                            <h3 class="card-title">Compra 1</h3>
                            <p class="text-sm text-base-content/70">Fecha: 12/07/2025</p>
                            <p class="text-sm text-base-content/70">Total: $100.000</p>
                        </div>
                    </div>
                </div>
            </div>
            <div id="tabs-icons-2" class="hidden" role="tabpanel" aria-labelledby="tabs-icons-item-2">
                <!-- FAVORITES -->
                <p class="text-base-content/80">Aún no tienes productos guardados como favoritos.</p>
            </div>
            <div id="tabs-icons-3" class="hidden" role="tabpanel" aria-labelledby="tabs-icons-item-3">
                <!-- EDIT PROFILE -->
                <h3 class="text-xl font-semibold mb-4">Editar perfil</h3>
                <form method="PUT" action="/users/{{ $user['user_id'] }}" class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    @csrf
                    @method('PUT')

                    <input type="hidden" name="user_">

                    <div>
                        <label class="block text-sm font-medium">Nombre</label>
                        <input type="text" name="user_name" value="{{ old('user_name', $user['user_name']) }}" class="input input-bordered w-full" required>
                    </div>

                    <div>
                        <label class="block text-sm font-medium">Apellido</label>
                        <input type="text" name="user_lastname" value="{{ old('user_lastname', $user['user_lastname']) }}" class="input input-bordered w-full" required>
                    </div>

                    <div>
                        <label class="block text-sm font-medium">Teléfono</label>
                        <input type="text" name="user_phone" value="{{ old('user_phone', $user['user_phone']) }}" class="input input-bordered w-full">
                    </div>

                    <div>
                        <label class="block text-sm font-medium">Dirección</label>
                        <input type="text" name="user_address" value="{{ old('user_address', $user['user_address']) }}" class="input input-bordered w-full">
                    </div>

                    <div
                        class="col-span-full"
                        data-file-upload='{
                            "url": "/upload",
                            "extensions": {
                            "csv": {
                                "icon": "<svg xmlns=\"http://www.w3.org/2000/svg\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\"><path d=\"M4 22h14a2 2 0 0 0 2-2V7l-5-5H6a2 2 0 0 0-2 2v4\"/><path d=\"M14 2v4a2 2 0 0 0 2 2h4\"/><path d=\"m5 12-3 3 3 3\"/><path d=\"m9 18 3-3-3-3\"/></svg>",
                                "class": "shrink-0 size-5"
                            }
                            }
                        }'>

                        <div class="bg-base-200/60 rounded-box flex flex-col justify-center border-2 border-base-content/20 border-dashed">
                            <div class="text-center cursor-pointer p-12" data-file-upload-trigger="">
                                <p class="text-base-content/50 mb-3 text-sm">Selecciona una imagen de perfil con un tamaño máximo de 2MB.</p>
                                <button type="button" class="btn btn-soft btn-sm btn-primary text-nowrap"> <span class="icon-[tabler--file-upload] size-4.5 shrink-0"></span> Arrastra y suelta para subir </button>
                                <p class="text-base-content/50 my-2 text-xs">o</p>
                                <p class="link link-animated link-primary font-medium text-sm">Explorar</p>
                            </div>
                            <div class="mx-12 mb-8 space-y-2 empty:m-0" data-file-upload-previews=""></div>
                        </div>
                    </div>

                    <div class="col-span-full">
                        <button type="submit" class="btn btn-primary rounded-lg">Guardar cambios</button>
                    </div>
                </form>
            </div>
            <div id="tabs-icons-4" class="hidden" role="tabpanel" aria-labelledby="tabs-icons-item-4">
                <!-- SETTINGS -->
                <p class="text-base-content/60">Aquí podrías agregar configuraciones como cambiar tema, cambiar contraseña, eliminar cuenta, etc.</p>
                <form action="/logout" method="post">
                    @csrf
                    <button type="submit" class="btn btn-error rounded-lg">Cerrar sesión</button>
                </form>
            </div>
        </div>
</section>
@endsection