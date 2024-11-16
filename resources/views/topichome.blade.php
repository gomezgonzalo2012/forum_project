@extends('layouts.app2')

{{-- @php
    $searchRoute = route('posts.search');
@endphp --}}



@section("content")
<header class="py-2 bg-light border-bottom mb-4">
    <div class="container">
        <div class="text-start my-2">
            @if (isset($topic))
                <h2 class="fw-bolder">{{$topic->description}}</h2>
            @else
                <h2 class="fw-bolder">Resultados de Busqueda</h2>
            @endif
        </div>
    </div>
</header>
    <!-- Page content-->

    <div class="container">
        <div class="row">

            {{-- <div class="text-center my-5">
                <h3 class="fw-bolder">{{$topic->description}}</h3>
            </div> --}}
            <div class="d-flex justify-content-end mb-3">
            @auth
                <a href="{{route('posts.createWithTopic',['topic_id'=>$topic->id])}}" class="btn btn-primary" >Crear discusión</a>
                @else
                <a href="{{route('login')}}" class="btn btn-primary"> Inicia sesión para crear una discusión.</a>
            @endauth
        </div>
            @php
            // Definir la ruta de búsqueda y otros parámetros según la lógica de la vista
                 $searchRoute = route('posts.search') 
            
            @endphp
        <div class="col-lg-12 d-flex justify-content-end mb-3">
        <x-search searchRoute="{{$searchRoute}}" topicId="{{$topic->id}}" />
        </div>

            <!-- Blog entries-->
            <div class="col-lg-8">
                @foreach ($posts as $p)
                {{-- @dd(count($p->comments->likes)) --}}

                {{-- <x-posts.post-card
                    link="{{route('posts.show',['post'=>$p->id])}}"
                    image="https://dummyimage.com/850x350/dee2e6/6c757d.jpg"
                    date="{{ $p->created_at->format('F j, Y') }}"
                    user="{{ $p->user ? $p->user->name : 'Usuario desconocido' }}"
                    title="{{ $p->title }}"
                    commentsAmount="{{count($p->comments)}}"
                    likes="{{count($p->comments->likes)}}"
                    dislikes="{{count($p->comments->dislikes)}}"
                /> --}}
                @component('components.posts.post-card', [
                    'link'=>route('posts.show',['post'=>$p->id]),
                    'image'=>"https://dummyimage.com/850x350/dee2e6/6c757d.jpg",
                    'date'=> $p->created_at->format('F j, Y') ,
                    'user'=>$p->user ? $p->user->name : 'Usuario desconocido' ,
                    'title'=> $p->title ,
                    'commentsAmount'=>count($p->comments),
                    'likes'=>$p->comments->sum('likes'),
                    'dislikes'=>$p->comments->sum('dislikes'),
                    ])
                @endcomponent
                @endforeach


                <!-- Nested row for non-featured blog posts-->

                <!-- Pagination-->
                <nav aria-label="Pagination">
                    {{$posts->links()}}
                </nav>
            </div>


            <!-- Side widgets-->
            <div class="col-lg-4">

                <!-- Categories widget-->

                <x-categories.categories-card

                    :categories="$categories"
                 />

                <!-- Side widget-->
                <div class="card mb-4">
                    <div class="card-header">Más Populares</div>
                    @foreach ($popularPosts as $pop )
                    <div class="ms-3">
                        <p><a href="{{route('posts.show',['post'=>$pop->id])}}" class="link-body-emphasis link-offset-2 link-underline-opacity-25 link-underline-opacity-75-hover">{{$pop->title}}</a></p>
                    </div>
                    @endforeach

                </div>
            </div>
        </div>
    </div>
     @include('components.back-button')
@endsection

