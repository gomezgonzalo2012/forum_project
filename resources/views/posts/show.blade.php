@extends('layouts.app2')

@section("content")
<!-- Page content-->
<div class="container mt-5">
    <div class="row">
        <div class="col-lg-8">
            <!-- Post content-->
            <article>
                <!-- Post header-->
                <header class="mb-4">
                    <!-- Post title-->
                    <h3 class="fw-bolder mb-1">{{$post->title}}</h3>

                    <!-- Post content-->
                    <div class="text-muted fst-italic mb-2">Posted on  {{ $post->created_at->format('F j, Y') }} by {{--$post->user->name--}}</div>
                    <!-- Post categories-->
                    @foreach ($post->categories as $category)
                    <a class="badge bg-secondary text-decoration-none link-light" href="#!">{{$category->name}}</a>
                    @endforeach

                </header>
                <!-- Preview image figure-->
                {{-- <figure class="mb-4"><img class="img-fluid rounded" src="https://dummyimage.com/900x400/ced4da/6c757d.jpg" alt="..." /></figure> --}}
                <!-- Post content-->
                <section class="mb-5  card card-body">
                    <p class="fs-5 mb-4"> {{$post->content}}</p>

                </section>
            </article>
            <!-- Comments section-->
            <section class="mb-5">
                <div class="card bg-light">
                    <div class="card-body">
                        <!-- Comment form-->

                        <form class="mb-4" action="{{route("comments.store")}}" method="POST">
                            @csrf
                            <!-- Textarea que dispara el collapse al hacer clic -->
                            <textarea class="form-control" data-bs-toggle="collapse" href="#collapseExample" role="button" placeholder="leave a comment" aria-expanded="false" aria-controls="collapseExample" rows="3" name ="content"></textarea>
                            <input type="hidden" name="user_id" value="@if(Auth::check()){{ Auth::user()->id }}@endif">
                            <input type="hidden" name="post_id" value="{{$post->id}}">

                            <!-- Contenedor que muestra el botón de comentar al hacer clic -->
                            <div class="collapse py-3" id="collapseExample">
                                <div class="d-flex justify-content-end"> <!-- Flexbox para alinear el botón a la derecha -->
                                    <button class="btn btn-primary" type="submit"> <!-- Cambia type="button" a type="submit" -->
                                        Comentar
                                    </button>
                                </div>
                            </div>
                        </form>

                        <!-- Itera sobre los comentarios principales del post -->
                        @foreach ($post->comments as $comment)
                        <!-- Pasa el array 'renderedComments' vacío inicialmente a cada comentario principal -->
                            @component('components.comments.comment-box', ['comment' => $comment, 'renderedComments' => []])
                            @endcomponent
                        @endforeach

                    </div>
                </div>
            </section>
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
            <div class="card mb-4">
                <div class="card-header">Categories</div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-6">
                            <ul class="list-unstyled mb-0">
                                <li><a href="#!">Web Design</a></li>
                                <li><a href="#!">HTML</a></li>
                                <li><a href="#!">Freebies</a></li>
                            </ul>
                        </div>
                        <div class="col-sm-6">
                            <ul class="list-unstyled mb-0">
                                <li><a href="#!">JavaScript</a></li>
                                <li><a href="#!">CSS</a></li>
                                <li><a href="#!">Tutorials</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Side widget-->
            <div class="card mb-4">
                <div class="card-header">Side Widget</div>
                <div class="card-body">You can put anything you want inside of these side widgets. They are easy to use, and feature the Bootstrap 5 card component!</div>
            </div>
        </div>
    </div>
</div>
@endsection
