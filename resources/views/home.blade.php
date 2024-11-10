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
            <div class="col-lg-8">
                <!-- Blog entries-->
                <div class="accordion" id="accordionExample">
                    {{-- <div class="row"> --}}
                            @foreach ($topics as $topic)
                                <x-topics.topic-item
                                description="{{$topic->description}}"
                                link="{{route('topics.index',['id'=>$topic->id])}}"
                                postCount="{{count($topic->posts)}}">
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

                <!-- Categories widget-->

                {{-- <x-categories.categories-card

                    :categories="$categories"
                 /> --}}

                <!-- Side widget-->
                <div class="card mb-4">
                    <div class="card-header"> Post más Populares</div>
                    @foreach ($popularPosts as $pop )
                            <div class="card mb-3 border-0 border-bottom">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-start">
                                        <div>
                                            {{-- <h5 class="card-title mb-1"> --}}
                                                <i class="bi bi-fire"></i>
                                                <p><a href="{{route('posts.show',['post'=>$pop->id])}}" class="text-dark text-decoration-none">{{$pop->title}}</a></p>
                                            {{-- </h5> --}}
                                        </div>
                                        <div class="text-end">
                                            <!-- Contador de respuestas y fecha de actividad -->
                                            <div class="text-muted small">replies</div>
                                            <div class="text-muted small"> fecha Actividad</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    @endforeach

                </div>
            </div>

        </div>
    </div>

@endsection

