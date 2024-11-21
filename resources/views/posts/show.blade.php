@extends('layouts.app2')

@section("content")
<!-- Page content-->
<div class="container mt-5">
    <div class="row justify-content-center">
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
                    @if(Auth::check() && Auth::user()->id == $singlePost->user_id)
                    <a href="{{ route('posts.edit', $singlePost->id) }}" class="text-muted position-absolute small"
                        style="bottom: 0; right: 0; padding: 5px; margin: 10px;">Editar</a>
                    @endif
                </section>
            </article>

            <!-- Comments section-->
            <section class="mb-5">
                <div class="card bg-light">
                    <div class="card-body">

                     @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
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
                            <a href="{{ route('login') }}" class="btn btn-primary mb-2">Inicia sesión para comentar</a>
                        @endauth

                        @if (isset($comments))
                            @if ($comments->isEmpty())
                                <p>No hay comentarios</p>
                            @else
                                @foreach ($comments as $comment)
                                    <div class="card mb-4">
                                        <div class="card-body">
                                            <div class="ms-2 flex-grow-1">
                                                <div class="d-flex align-items-center">
                                                    <img src="{{ asset('assets/icons8-usuario-masculino-en-círculo-48.png') }}" alt="User avatar" class="rounded-circle me-2" width="40" height="40">
                                                    <div>
                                                        <h5 class="card-title mb-1">{{ $comment->user->name }}</h5>
                                                        <h6 class="card-subtitle text-muted">{{ $comment->created_at->diffForHumans() }}</h6>
                                                    </div>
                                                    @if($comment->user->isModerator())
                                                    <small><span class="badge bg-secondary">Moderador</span></small>
                                                    @endif
                                                </div>
                                            </div>
                                            @php
                                                $userReaction = $comment->userReaction(Auth::id());

                                            @endphp
                                            {{-- Manejo de contenido suspendido --}}
                                             @if ($comment->comment_state == "desactivo")
                                                <p class="card-text mt-2 alert alert-info "style="width: 28rem;">Este comentario fue suspendido por un moderador. </p>
                                            @else
                                                <p class="card-text mt-2 ms-5" id="comment-content-{{ $comment->id }}">{{ $comment->content }}</p>
                                            @endif
                                            <hr>
                                            <div class="d-flex justify-content-start align-items-center mt-3">
                                                {{-- componente like y dislike --}}
                                                @include('components.reaction.reactionButton',['comment'=>$comment])

                                                <div>
                                                    <button type="button" class="btn fw-bold btn-sm" data-bs-toggle="collapse" href="#collapseComment{{ $comment->id }}" aria-expanded="false" aria-controls="collapseComment{{ $comment->id }}">Responder</button>
                                                    <i class="bi bi-reply-all"></i>
                                                </div>

                                            </div>

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
                                            <div class="replies  px-2 ">
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
    </div>
</div>
 @include('components.back-button')

@endsection
