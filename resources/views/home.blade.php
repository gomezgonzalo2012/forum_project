@extends('layouts.app2')

@section("content")
<header class="py-5 bg-light border-bottom mb-4">
    <div class="container">
        <div class="text-center my-5">
            <h1 class="fw-bolder">@if(Auth::check()){{ Auth::user()->name }}@endif, Welcome to The Forum Project!</h1>
            <p class="lead mb-0">This forum was created by the amazing programming team Gonzalo & Lourdes</p>
        </div>
    </div>
</header>
    <!-- Page content-->
    <br>
    <div class="container">
        <div class="row">
            <!-- Blog entries-->
            <div class="col-lg-8">
                @php
                    $postList = $posts[0];
                    $categories = $posts[1];
                @endphp
                @foreach ($postList as $post)
                <x-posts.post-card
                    link="{{route('posts.show',['post'=>$post->id])}}"
                    image="https://dummyimage.com/850x350/dee2e6/6c757d.jpg"
                    {{-- date={{$item->created_at}}
                    title={{$item->title}}
                    content={{$item->content}} --}}
                    date="{{ $post->created_at->format('F j, Y') }}"
                    title="{{ $post->title }}"
                    content="{{ $post->content }}"
                    comments="{{count($post->comments)}}"
                />
                @endforeach


                <!-- Nested row for non-featured blog posts-->

                <!-- Pagination-->
                <nav aria-label="Pagination">
                    <hr class="my-0" />
                    <ul class="pagination justify-content-center my-4">
                        <li class="page-item disabled"><a class="page-link" href="#" tabindex="-1" aria-disabled="true">Newer</a></li>
                        <li class="page-item active" aria-current="page"><a class="page-link" href="#!">1</a></li>
                        <li class="page-item"><a class="page-link" href="#!">2</a></li>
                        <li class="page-item"><a class="page-link" href="#!">3</a></li>
                        <li class="page-item disabled"><a class="page-link" href="#!">...</a></li>
                        <li class="page-item"><a class="page-link" href="#!">15</a></li>
                        <li class="page-item"><a class="page-link" href="#!">Older</a></li>
                    </ul>
                </nav>
            </div>
            <!-- Side widgets-->
            <div class="col-lg-4">
                <!-- Search widget-->
                <div class="card mb-4">
                    <div class="card-header">Search</div>
                    <div class="card-body">
                        <div class="input-group">
                            <input class="form-control" type="text" placeholder="Enter search term..." aria-label="Enter search term..." aria-describedby="button-search" />
                            <button class="btn btn-primary" id="button-search" type="button">Go!</button>
                        </div>
                    </div>
                </div>
                <!-- Categories widget-->

                <x-categories.categories-card

                    :categories="$categories"
                 />

                <!-- Side widget-->
                <div class="card mb-4">
                    <div class="card-header">Side Widget</div>
                    <div class="card-body">You can put anything you want inside of these side widgets. They are easy to use, and feature the Bootstrap 5 card component!</div>
                </div>
            </div>
        </div>
    </div>
@endsection
