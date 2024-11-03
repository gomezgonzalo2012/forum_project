@foreach($childcomments as $child)

  <div class="card mb-3">
    <div class="card-body">
      <div class="d-flex  align-items-start">
        <div class="d-flex align-items-center">
          <img src="{{asset('assets/icons8-usuario-masculino-en-círculo-48.png')}}" alt="User avatar" class="rounded-circle me-2" width="40" height="40">
          <div>
            <h5 class="card-title mb-1">{{ $child->user->name }}</h5>
            <h6 class="card-subtitle text-muted">{{ $child->created_at->diffForHumans()}} </h6>
          </div>
        </div>
        @if($child->user->isModerator())
          <small><span class="badge bg-secondary ">Moderador</span></small>
        @endif
      </div>
      <p class="card-text mt-2">{{ $child->content }}</p>
      <div class="d-flex justify-content-start align-items-center mt-3">
        <button class="ms-2">
            <i class="bi bi-hand-thumbs-up">0</i>
        </button >
        <button class="ms-2">
            <i class="bi bi-hand-thumbs-down">1</i>
        </button>
        <div>
          <button type="button" class="btn fw-bold btn-sm"
           data-bs-toggle="collapse" href="#collapseComment{{ $child->id }}"
         aria-expanded="false" aria-controls="collapseComment{{ $child->id }}">Responder</button>
        <i class="bi bi-reply-all"></i>

          <!-- Otros botones como Me gusta, No me gusta -->
        </div>
      </div>
      <div class="collapse py-2" id="collapseComment{{ $child->id }}">
        <form method="POST" action="{{ route('comments.storeChild') }}">
            @csrf
            <textarea class="form-control mb-2" name="content" rows="2" placeholder="Escribe tu respuesta aquí..."></textarea>
            <input type="hidden" name="user_id" value="@if(Auth::check()){{ Auth::user()->id }}@endif">
            <input type="hidden" name="father_comment_id" value="{{ $child->id }}">
            <input type="hidden" name="post_id" value="{{ $child->post_id }}">

            <div class="d-flex justify-content-end">
                <button class="btn btn-primary" type="submit">
                    Comment
                </button>
            </div>
        </form>
    </div>
      <div class="comment">
        {{-- <p>{{ $comment->body }} - by {{ $comment->user->name }}</p> --}}

        <!-- Recursivamente mostramos las respuestas -->
        @if($child->children->isNotEmpty())
            <div class="mt-3">
                @include('components.comments.comment-box2', ['childcomments' => $child->children])
            </div>
        @endif
        </div>
    </div>
  </div>
@endforeach


