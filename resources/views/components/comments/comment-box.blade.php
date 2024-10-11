@props(['comment', 'renderedComments' => []])

@php
    // // Si este comentario ya fue renderizado, no lo mostramos
    // if (in_array($comment->id, $renderedComments)) {
    //     return;
    // }

    // Agregamos el ID del comentario al array de comentarios ya renderizados
    // $renderedComments[] = $comment->id;
    // @dump( $renderedComments);

    foreach ($renderedComments as $id) {
        print($id);
    }
@endphp

<!-- Componente de comentario -->
<div class="mb-4">
    <div class="d-flex mb-2">
        <!-- Imagen de usuario -->
        <div class="flex-shrink-0">
            <img class="rounded-circle" src="https://dummyimage.com/50x50/ced4da/6c757d.jpg" alt="User Avatar" />
        </div>
        <!-- Contenido del comentario -->
        <div class="ms-3 flex-grow-1">
            <div class="fw-bold">{{ $comment->user->name }}</div>
            <div>{{ $comment->content }}</div>
            <div class="d-flex justify-content-end">
                <!-- Enlace para mostrar el área de comentario -->
                <a type="button" class="form-control btn btn-link" data-bs-toggle="collapse" href="#collapseComment{{ $comment->id }}" role="button" aria-expanded="false" aria-controls="collapseComment{{ $comment->id }}">
                    Responder
                </a>
            </div>

            <!-- Área de respuesta oculta por defecto -->
            <div class="collapse py-3" id="collapseComment{{ $comment->id }}">
                <form method="POST" action="{{ route('comments.storeChild') }}">
                    @csrf
                    <textarea class="form-control mb-2" name="content" rows="2" placeholder="Escribe tu respuesta aquí..."></textarea>
                    <!-- Campos ocultos para identificar el usuario y la relación con el comentario superior -->
                    <input type="hidden" name="user_id" value="@if(Auth::check()){{ Auth::user()->id }}@endif">
                    <input type="hidden" name="father_comment_id" value="{{ $comment->id }}">
                    <input type="hidden" name="post_id" value="{{ $comment->post_id }}">

                    <div class="d-flex justify-content-end"> <!-- Flexbox para alinear el botón a la derecha -->
                        <button class="btn btn-primary" type="submit">
                            Comentar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Verificación de comentarios hijos -->
    @if($comment->children->isNotEmpty())
        <div class="ms-5"> <!-- Desplazamiento hacia la derecha para los subcomentarios -->
            <!-- Recorrido de los subcomentarios -->
            @foreach($comment->children as $childComment)
                <!-- Verificación para evitar mostrar comentarios duplicados -->
                @if($childComment->parent->id == $comment->id)
                @if(!in_array($childComment->id, $renderedComments))
                    {{-- @dd($renderedComments[0]); --}}

                    <div class="d-flex mt-2">
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
