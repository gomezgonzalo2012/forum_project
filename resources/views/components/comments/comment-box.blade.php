@props(['comment', 'renderedComments' => []])

@php
    // // Si este comentario ya fue renderizado, no lo mostramos
    if (in_array($comment->id, $renderedComments)) {
        return;
    }

   // Agregamos el ID del comentario al array de comentarios ya renderizados
    $renderedComments[] = $comment->id;
    // @dump( $renderedComments);

    foreach ($renderedComments as $id) {
        print($id);
    }
@endphp
{{-- <div class="d-flex justify-content-between">
    <div class="">
         <strong class="ml-2">{{$user}}</strong>
    </div>
    <div>
     <a class="btn btn-secondary btn-sm" href="{{ $link }}">Ver más</a>
    </div>
</div> --}}
<!-- Componente de comentario -->
<div class="mb-4">
    <div class="mb-2">
        <!-- Imagen de usuario -->
        <div class="d-flex justify-content-start">
            <div>
            <img src="{{asset('assets/icons8-usuario-masculino-en-círculo-48.png')}}" width="25px" height="25px" style="border-radius:50%" alt="profile image">

            </div>

            <div class="ms-1">{{ $comment->user->name }}</div>


        </div>
        <!-- Contenido del comentario -->
        <div class="ms-3 flex-grow-1">
            <div>{{ $comment->content }}</div>
            <div class="d-flex justify-content-end">
                <!-- Enlace para mostrar el área de comentario -->
                <a type="button" class="" data-bs-toggle="collapse" href="#collapseComment{{ $comment->id }}" role="button" aria-expanded="false" aria-controls="collapseComment{{ $comment->id }}">
                <i class="bi bi-reply-fill"></i>
                </a> reply
            </div>

            <div class="collapse py-2" id="collapseComment{{ $comment->id }}">
                <form method="POST" action="{{ route('comments.storeChild') }}">
                    @csrf
                    <textarea class="form-control mb-2" name="content" rows="2" placeholder="Escribe tu respuesta aquí..."></textarea>
                    <input type="hidden" name="user_id" value="@if(Auth::check()){{ Auth::user()->id }}@endif">
                    <input type="hidden" name="father_comment_id" value="{{ $comment->id }}">
                    <input type="hidden" name="post_id" value="{{ $comment->post_id }}">

                    <div class="d-flex justify-content-end">
                        <button class="btn btn-primary" type="submit">
                            Comment
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Verificación de comentarios hijos -->
    @if($comment->children->isNotEmpty())
        <div class="ms-4"> <!-- Desplazamiento hacia la derecha para los subcomentarios -->
            <!-- Recorrido de los subcomentarios -->
            @foreach($comment->children as $childComment)
                <!-- Verificación para evitar mostrar comentarios duplicados -->
                @if($childComment->parent->id == $comment->id)
                @if(!in_array($childComment->id, $renderedComments))
                    {{-- @dd($renderedComments[0]); --}}

                    <div class=" mt-2">

                        <!-- Incluimos nuevamente el componente de comentario, pasando los comentarios ya renderizados -->
                        @include("components.comments.comment-box", ['comment' => $childComment, 'renderedComments' => $renderedComments])
                        {{-- @component('components.comments.comment-box', ['comment' => $childComment, 'renderedComments' => $renderedComments])
                        @endcomponent --}}
                    </div>
                @endif
                @endif

            @endforeach
        </div>
    @endif
</div>
