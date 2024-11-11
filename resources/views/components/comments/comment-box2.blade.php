@foreach($childcomments as $child)
    <div class=" mb-3 ms-3">

            <div class="d-flex align-items-start">
                <div class="d-flex align-items-center">
                    <img src="{{ asset('assets/icons8-usuario-masculino-en-círculo-48.png') }}" alt="User avatar" class="rounded-circle me-2" width="40" height="40">
                    <div>
                        <h5 class="card-title mb-1">{{ $child->user->name }}</h5>
                        <h6 class="card-subtitle text-muted">{{ $child->created_at->diffForHumans() }}</h6>
                    </div>
                </div>
                @if($child->user->isModerator())
                    <small><span class="badge bg-secondary">Moderador</span></small>
                @endif
            </div>
            {{-- manejo de contenido suspendido --}}
            @if ($child->comment_state == "desactivo")
            <p class="card-text mt-2 alert alert-info "style="width: 28rem;">Este comentario fue suspendido por un moderador. </p>
            @else
            <p class="card-text mt-2 ms-5">{{ $child->content }}</p>
            @endif
        @php
            $userReaction = $child->userReaction(Auth::id());

        @endphp

    <div class="d-flex justify-content-start align-items-center mt-3">
        <button class="ms-2 btn like-button" data-comment-id="{{ $child->id }}" data-reaction="likes"
            @if($userReaction && $userReaction->reaction === 'likes') disabled @endif>
            <i class="bi bi-hand-thumbs-up"></i>
            <span id="like-count-{{ $child->id }}">{{ $child->likes }}</span>
        </button>

        <button class="ms-2 btn dislike-button" data-comment-id="{{ $child->id }}" data-reaction="dislikes"
            @if($userReaction && $userReaction->reaction === 'dislikes') disabled @endif>
            <i class="bi bi-hand-thumbs-down"></i>
            <span id="dislike-count-{{ $child->id }}">{{ $child->dislikes }}</span>
        </button>
        <div>
            @if($child->comment_level<4)
            <button type="button" class="btn fw-bold btn-sm" data-bs-toggle="collapse" href="#collapseComment{{ $child->id }}" aria-expanded="false" aria-controls="collapseComment{{ $comment->id }}">Responder</button>
            <i class="bi bi-reply-all"></i>
            @endif
        </div>
    </div>

        {{-- Collapsible Form for Replying to a Comment --}}
        <div class="collapse py-2" id="collapseComment{{ $child->id }}">
            <form method="POST" action="{{ route('comments.storeChild') }}">
                @csrf
                <textarea class="form-control mb-2" name="content" rows="2" placeholder="Escribe tu respuesta aquí..."></textarea>
                <input type="hidden" name="user_id" value="@if(Auth::check()){{ Auth::user()->id }}@endif">
                <input type="hidden" name="father_comment_id" value="{{ $child->id }}">
                <input type="hidden" name="post_id" value="{{ $child->post_id }}">

                <div class="d-flex justify-content-end">
                    <button class="btn btn-primary" type="submit">Comment</button>
                </div>
            </form>
        </div>
        {{-- Displaying Child Comments Recursively --}}
        @if($child->children->isNotEmpty())
            <div class="mt-3 ms-1">
                @include('components.comments.comment-box2', ['childcomments' => $child->children])
            </div>
        @endif
    </div>
@endforeach


