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
                    @php
                        $singlePost = $postShow[0];
                        $comments = $postShow[1];
                    @endphp
                    <!-- Post title-->
                    <h3 class="fw-bolder">{{ $singlePost->title }}</h3>
                    <!-- Post content-->
                    <div class="text-muted fst-italic mb-2">
                        Posted on {{ $singlePost->created_at->diffForHumans() }} by {{ $singlePost->user->name }}
                    </div>
                    <!-- Post categories-->
                    @foreach ($singlePost->categories as $category)
                        <a class="badge bg-secondary text-decoration-none link-light" href="#!">{{ $category->name }}</a>
                    @endforeach
                </header>

                <!-- Post content-->
                <section class="mb-5 card card-body">
                    <p class="fs-5 mb-4">{!! $singlePost->content !!}</p>
                </section>
            </article>

            <!-- Comments section-->
            <section class="mb-5">
                <div class="card bg-light">
                    <div class="card-body">
                        @if (isset($comments))
                            @if ($comments->isEmpty())
                                <p>No hay comentarios</p>
                            @else
                            <form action="{{ route('admin.updateStatus') }}" method="POST">
                                @csrf
                                @foreach ($comments as $comment)
                                    {{-- @dd($comment->dislikes) --}}
                                    <div class="card mb-4 @if($comment->dislikes > 50)
                                                alert alert-danger
                                            @elseif($comment->dislikes > 25)
                                                alert alert-warning
                                            @endif ">
                                        <div class="card-body">
                                            <div class="ms-2 flex-grow-1">
                                                <div class="d-flex align-items-center">
                                                    <img src="{{ asset('assets/icons8-usuario-masculino-en-círculo-48.png') }}" alt="User avatar" class="rounded-circle me-2" width="40" height="40">
                                                    <div>
                                                        <h5 class="card-title mb-1">{{ $comment->user->name }}</h5>
                                                        <h6 class="card-subtitle text-muted">{{ $comment->created_at->diffForHumans() }}</h6>
                                                    </div>
                                                </div>
                                                @if($comment->user->isModerator())
                                                    <small><span class="badge bg-secondary">Moderador</span></small>
                                                @endif
                                            </div>

                                            <p class="card-text mt-2">{{ $comment->content }}</p>
                                            <hr> <!--Moderador no puede dar likes-->
                                            <div class="d-flex justify-content-start align-items-center mt-3">
                                                <div class="ms-2 btn like-button" >
                                                    <i class="bi bi-hand-thumbs-up"></i>
                                                    <span id="like-count-{{ $comment->id }}">{{ $comment->likes }}</span>
                                                </div>
                                                <div class="ms-2 btn dislike-button">
                                                    <i class="bi bi-hand-thumbs-down"></i>
                                                    <span id="dislike-count-{{ $comment->id }}">{{ $comment->dislikes }}</span>
                                                </div>

                                            </div>


                                        </div>
                                        @if ($comment->children->isNotEmpty())
                                            <div class="replies px-2 ">
                                                @include('components.admin.comment_boxAdmin', ['childcomments' => $comment->children])
                                            </div>
                                        @endif
                                    </div>
                                @endforeach
                                {{-- Botón de Guardar Cambios --}}
                                <button type="submit" class="btn btn-primary mt-3">Guardar Cambios</button>
                            </form>
                            @endif
                        @else
                            <p>There is a problem searching for comments</p>
                        @endif
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>

@endsection
