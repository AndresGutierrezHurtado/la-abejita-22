@extends('layouts.app')

@section('title', 'Panel de control de usuarios')

@section('content')
<style>
    td, th {
        padding: 5px;
    }
    a {
        cursor: pointer;
    }
</style>
<main class="min-h-[90vh] bg-center bg-no-repeat bg-cover bg-[url(/public/images/banner.jpg)] relative py-10">
    <div class="absolute inset-0 bg-gradient-to-b from-black to-black opacity-[20%]"></div>

    <section class="w-full flex justify-center items-center">
        <div class="flex flex-col w-full max-w-[1200px] z-10">
            <div class="bg-white rounded-md p-5 shadow-lg w-full flex flex-col gap-5">

                <!-- Seleccionar el dashboard -->
                <select onchange="window.location = this.value"
                class="bg-gray-100 rounded-md border border-gray-300 ">
                    <option value="/dashboard/users" selected>Usuarios</option>
                    <option value="/dashboard/schools">Colegios</option>
                    <option value="/dashboard/products">Productos</option>
                </select>

                <!-- Título dashboard y búsqueda -->
                <span class="flex justify-between items-center">

                    <h1 class="text-2xl font-bold tracking-tight">Tabla de usuarios</h1>

                    <form action="{{ url('/dashboard/users/') }}" method="get" class="flex gap-0">
                        <input type="text" name="search" value="{{ request() -> get('search') }}" placeholder="Buscar..." class="rounded-l-md py-1 px-2 border-gray-300 w-[300px]">
                        <button type="submit" class="bg-gray-700 rounded-r-md font-semibold text-white py-1 px-2">Buscar</button>                        
                        @if(request()->has('search') || request()->has('order'))
                            <a href="{{ url('/dashboard/users/') }}" class="bg-gray-300 rounded-md font-semibold text-black py-1 px-2 ml-2">Limpiar</a>
                        @endif
                    </form>

                </span>
                
                <!-- tabla con la información del dashboard -->
                <div class="w-full">
                    <table class="w-full text-center border border-gray-300 divide-y divide-gray-300">
                        <thead class="bg-gray-200 uppercase font-bold">
                            <tr>
                                <th><a href="{{ url('/dashboard/users') . '?' . http_build_query(array_merge(request()->except('order'), ['order' => 'user_id'])) }}">ID</a></th>
                                <th><a href="{{ url('/dashboard/users') . '?' . http_build_query(array_merge(request()->except('order'), ['order' => 'user_first_name'])) }}">Nombres</a></th>
                                <th><a href="{{ url('/dashboard/users') . '?' . http_build_query(array_merge(request()->except('order'), ['order' => 'user_username'])) }}">Usuario</a></th>
                                <th><a href="{{ url('/dashboard/users') . '?' . http_build_query(array_merge(request()->except('order'), ['order' => 'user_email'])) }}">Correo</a></th>
                                <th><a href="{{ url('/dashboard/users') . '?' . http_build_query(array_merge(request()->except('order'), ['order' => 'role_id'])) }}">Rol</a></th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-300">
                            @foreach ( $users as $user )
                                <tr class="odd:bg-white even:bg-gray-50">
                                    <td>{{ $user -> user_id }}</td>
                                    <td>{{ $user -> user_first_name . ' ' . $user -> user_last_name }}</td>
                                    <td>{{ $user -> user_username }}</td>
                                    <td>{{ $user -> user_email }}</td>
                                    <td class="capitalize">{{ $user -> role -> role_name }}</td>
                                    <td class="space-x-2 flex justify-center">
                                        <a href="{{ url('/profile/user/'. $user -> user_id ) }}" class="bg-amber-500 border-2 border-amber-500 px-2 py-0.5 rounded-md font-semibold text-white"> <i class="fa-solid fa-pen mr-2"></i> Editar</a>
                                        <form action="{{ url('/profile/user/destroy/' . $user -> user_id) }}" method="post"  onsubmit="return confirm('¿Estás seguro que quieres eliminar a este usuario?');">
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
                    
                <!-- Paginación de la tabla -->
                <div class="flex justify-between items-center">
                    {{ $users -> links() }}
                </div>
            </div>
        </div>
    </section>
</main>
<script>
    function toggleSortList() {
        document.getElementById('list-sort').classList.toggle('opacity-0');
        document.getElementById('list-sort').classList.toggle('opacity-100');
    }
</script>
@endsection