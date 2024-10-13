@extends('layouts.app2')

@section("content")
<header class="py-5 bg-light border-bottom mb-4">
    <div class="container">
        <div class="text-center my-5">
            @if(Auth::check())
            <h1 class="fw-bolder">Hi! {{ Auth::user()->name }}, Welcome to The Forum Project!</h1>
            @else
            <h1 class="fw-bolder">Welcome to The Forum Project!</h1>
            @endif
            <p class="lead mb-0">This forum was created by the amazing programming team Gonzalo & Lourdes</p>
        </div>
    </div>
</header>
    <!-- Page content-->

    <div class="container">
        <div class="row">
            <div class="d-flex justify-content-end mb-3">
            @auth
                <a href="{{route('posts.create')}}" class="btn btn-primary">Crear discusión</a>
                @else
                <a href="{{route('login')}}" class="btn btn-primary"> Inicia sesión y crear una discusión</a>
            @endauth
        </div>

            <!-- Blog entries-->
            <div class="col-lg-8">

                @php
                    // $postList = $posts[0];
                    // $categories = $posts[1];
                @endphp
                @foreach ($post as $p)
                <x-posts.post-card
                    link="{{route('posts.show',['post'=>$p->id])}}"
                    image="https://dummyimage.com/850x350/dee2e6/6c757d.jpg"
                    date="{{ $p->created_at->format('F j, Y') }}"
                    user="{{ $p->user ? $p->user->name : 'Usuario desconocido' }}"
                    title="{{ $p->title }}"
                    {{-- content="{!! $p->content !!}" --}}
                    commentsAmount="{{count($p->comments)}}"
                />
                @endforeach


                <!-- Nested row for non-featured blog posts-->

                <!-- Pagination-->
                <nav aria-label="Pagination">
                    {{$post->links()}}
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
@endsection

