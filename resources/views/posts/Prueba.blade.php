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

                <!-- Preview image figure-->
                {{-- <figure class="mb-4"><img class="img-fluid rounded" src="https://dummyimage.com/900x400/ced4da/6c757d.jpg" alt="..." /></figure> --}}

                <!-- Post content-->
                <section class="mb-5 card card-body">
                    <p class="fs-5 mb-4">{!! $singlePost->content !!}</p>
                </section>
            </article>

            <!-- Comments section-->
            <section class="mb-5">
                <div class="card bg-light">
                    <div class="card-body">
                        <!-- Comment form-->
                        @auth
                            <form class="mb-4" action="{{ route('comments.store') }}" method="POST">
                                @csrf
                                <textarea class="form-control" data-bs-toggle="collapse" href="#collapseExample" role="button" placeholder="leave a comment" aria-expanded="false" aria-controls="collapseExample" rows="3" name="content"></textarea>
                                <input type="hidden" name="user_id" value="{{ Auth::check() ? Auth::user()->id : '' }}">
                                <input type="hidden" name="post_id" value="{{ $singlePost->id }}">

                                <div class="collapse py-3" id="collapseExample">
                                    <div class="d-flex justify-content-end">
                                        <button class="btn btn-success" type="submit">Comentar</button>
                                    </div>
                                </div>
                            </form>
                        @else
                            <a href="{{ route('login') }}" class="btn btn-primary">Inicia sesión para comentar.</a>
                        @endauth

                        @if (isset($comments))
                            @if (empty($comments))
                                <p>No comments</p>
                            @else
                                @foreach ($comments as $comment)
                                    <div class="mb-4">
                                        <div class="ms-2 flex-grow-1">
                                            <div class="mb-4">{{ $comment->content }}</div>
                                            <div class="d-flex justify-content-between">
                                                <div class="d-flex justify-content-start">
                                                    <a type="button" class="" data-bs-toggle="collapse" href="#collapseComment{{ $comment->id }}" role="button" aria-expanded="false" aria-controls="collapseComment{{ $comment->id }}">
                                                        <i class="bi bi-reply-fill"></i>
                                                    </a> reply
                                                </div>
                                                <div class="d-flex justify-content-center">
                                                    <div>
                                                        <img src="{{ asset('assets/icons8-usuario-masculino-en-círculo-48.png') }}" width="25px" height="25px" style="border-radius:50%" alt="profile image">
                                                    </div>
                                                    <div class="ms-1 d-flex align-items-center">
                                                        <small>by {{ $comment->user->name }}</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <hr>

                                            <div class="collapse py-2" id="collapseComment{{ $comment->id }}">
                                                <form method="POST" action="{{ route('comments.storeChild') }}">
                                                    @csrf
                                                    <textarea class="form-control mb-2" name="content" rows="2" placeholder="Escribe tu respuesta aquí..."></textarea>
                                                    <input type="hidden" name="user_id" value="{{ Auth::check() ? Auth::user()->id : '' }}">
                                                    <input type="hidden" name="father_comment_id" value="{{ $comment->id }}">
                                                    <input type="hidden" name="post_id" value="{{ $comment->post_id }}">

                                                    <div class="d-flex justify-content-end">
                                                        <button class="btn btn-primary" type="submit">Comment</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        @if ($comment->children->isNotEmpty())
                                            <div class="replies ml-4">
                                                @include('components.comments.comment-box2', ['childcomments' => $comment->children])
                                            </div>
                                        @endif
                                    </div>
                                @endforeach
                            @endif
                        @else
                            <p>There is a problem searching for comments</p>
                        @endif
                    </div>
                </div>
            </section>
        </div>

        <!-- Side widgets-->
        <div class="col-lg-4">
            <!-- Categories widget-->
            <x-categories.categories-card :categories="$categories" />
        </div>
    </div>
</div>

@endsection
