@foreach($childcomments as $child)
<div class="mb-4 ms-4">
    <div class=" m-2">
        <!-- Imagen de usuario -->
        <div >{{ $child->content }}</div>

        <div class="d-flex justify-content-between">
            <div class="d-flex justify-content-end">
                <!-- Enlace para mostrar el área de comentario -->
                <a type="button" class="" data-bs-toggle="collapse" href="#collapseComment{{ $child->id }}" role="button" aria-expanded="false" aria-controls="collapseComment{{ $child->id }}">
                <i class="bi bi-reply-fill"></i>
                </a><small>reply</small>
            </div>

            <div class="d-flex justify-content-center ">
                <div>
                <img src="{{asset('assets/icons8-usuario-masculino-en-círculo-48.png')}}" width="25px" height="25px" style="border-radius:50%" alt="profile image">

                </div>
                <div class="ms-1 d-flex align-items-end">
                    <small>by {{ $child->user->name }}</small>
                </div>
            </div>
        </div>

            <div class="ms-3 flex-grow-1">
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

    </div>
</div>

    <div class="comment">
        {{-- <p>{{ $comment->body }} - by {{ $comment->user->name }}</p> --}}

        <!-- Recursivamente mostramos las respuestas -->
        @if($child->children->isNotEmpty())
            <div class="replies ml-4">
                @include('components.comments.comment-box2', ['childcomments' => $child->children])
            </div>
        @endif
    </div>
@endforeach
