@extends('layouts.app2')

@section("content")
<header class="py-5 bg-light border-bottom mb-4">
    <div class="container">
        <div class="text-center my-5">
            @if(Auth::check())
            <h1 class="fw-bolder">Hola! {{ Auth::user()->name }}, bienvenido a The Forum Project!</h1>
            @else
            <h1 class="fw-bolder">bienvenido a The Forum Project!</h1>
            @endif
            <p class="lead mb-0">Este foro fue creado por el increible equipo de programadores Gonzalo & Lourdes</p>
        </div>
    </div>
</header>


    <!-- Page content-->

    <div class="container">
        <div class="row">

        <div class="col-lg-8">

            <div class=" justify-content-end mb-3">
                @php
                    $param = 'nombre del tema'
                @endphp
                {{-- form busqueda por tema --}}
                <x-search searchRoute="{{ route('topics.search') }}" topicId="{{ null }} " searchParam="{{$param}}"/>
            </div>


                <!-- Blog entries-->
                <div class="accordion" id="accordionExample">
                    {{-- <div class="row"> --}}
                            @foreach ($topics as $topic)
                                <x-topics.topic-item
                                description="{{$topic->description}}"
                                link="{{route('topics.index',['id'=>$topic->id])}}"
                                postCount="{{count($topic->posts)}}"
                                lastDate="{{ $topic->posts->first() ? $topic->posts->first()->created_at->locale('es_ES')->diffForHumans() : 'Sin actividad' }}">

                                </x-topics.topic-item>

                            @endforeach
                    {{-- </div> --}}
                </div>

            <nav aria-label="Pagination">
                {{$topics->links()}}
            </nav>
            </div>

            <!-- Side widgets-->
            <div class="col-lg-4">

                @component('components.posts.most-active-posts')
                @endcomponent

            </div>

        </div>
    </div>
     @include('components.back-button')
@endsection

