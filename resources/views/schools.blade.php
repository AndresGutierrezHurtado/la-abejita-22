@extends('layouts.app')

@section('title', 'Colegios')

@section('content')
<main>
    <section class="w-full flex justify-center bg-slate-800">
        <div class="w-full max-w-[1200px] flex flex-col gap-5 py-10">
            <h1 class="text-center text-5xl font-bold text-slate-50 tracking-tight py-10">Colegios</h1>
        </div>
    </section>
    <section class="w-full flex justify-center">
        <div class="w-full max-w-[1200px] flex flex-col gap-5 py-10">            
            <div class="grid grid-cols-[repeat(auto-fill,_minmax(230px,_1fr))] gap-10">
                @foreach ( $schools as $school )

                    <article class="w-full min-[200px] max-w-[250px] border border-zinc-300 bg-white rounded-xl mx-auto">
                        <a href="/colegios/{{$school -> school_id}}" class="flex justify-center items-center p-2">
                            <img src="{{$school -> school_image_url}}" alt="logo-agm" class=" max-h-[190px]">
                        </a>
                        <hr class="border-zinc-300">
                        <div class="p-3 text-xl font-bold text-center">
                            <h1>{{$school -> school_name}}</h1>
                        </div>
                    </article>

                @endforeach
            </div>
        </div>
    </section>
</main>
@endsection