@foreach($childcomments as $child)
    <div class="mb-3 ms-3" id="comment-{{ $child->id }}">
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

        {{-- Manejo de contenido suspendido --}}
        @if ($child->comment_state == "desactivo")
            <p class="card-text mt-2 alert alert-info "style="width: 28rem;">Este comentario fue suspendido por un moderador. </p>
        @else
            <p class="card-text mt-2 ms-5" id="comment-content-{{ $child->id }}">{{ $child->content }}</p>
        @endif

        <div class="d-flex justify-content-start align-items-center mt-3">
            @include('components.reaction.reactionButton',['comment'=>$child])

            {{-- Botón para activar el modo de edición --}}
            @if($child->user_id === Auth::id()) {{-- Solo el autor puede editar --}}
                <button type="button" class="btn fw-bold btn-sm ms-2" onclick="setAction('editar', {{ $child->id }})">Editar</button>
            @endif

            {{-- Botón para responder --}}
            @if($child->comment_level < 4) {{-- Limite de respuesta --}}
            <div>
                <button type="button" class="btn fw-bold btn-sm" data-bs-toggle="collapse" href="#collapseComment{{ $child->id }}" onclick="setAction('responder', {{ $child->id }})" aria-expanded="false" aria-controls="collapseComment{{ $child->id }}">Responder</button>
                <i class="bi bi-reply-all"></i>
            </div>

            @endif
        </div>

        {{-- Formulario de edición del comentario --}}
        @if(Auth::check())
        <div id="edit-form-{{ $child->id }}" class="collapse py-2">
            <form method="POST" action="{{ route('comments.update', $child->id) }}">
                @csrf
                @method('PUT')
                <textarea class="form-control mb-2" name="content" rows="2">{{ $child->content }}</textarea>
                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                <input type="hidden" name="father_comment_id" value="{{ $child->id }}">
                <input type="hidden" name="post_id" value="{{ $child->post_id }}">

                <div class="d-flex justify-content-end">
                    <button class="btn btn-primary" type="submit">Guardar cambios</button>
                </div>
            </form>
        </div>
        @endif
        {{-- Formulario de respuesta --}}
        <div id="reply-form-{{ $child->id }}" class="collapse py-2">
            <form method="POST" action="{{ route('comments.storeChild') }}">
                @csrf
                <textarea class="form-control mb-2" name="content" rows="2" placeholder="Escribe tu respuesta aquí..."></textarea>
                @if(Auth::check())<input type="hidden" name="user_id" value="{{ Auth::user()->id }}">@endif
                <input type="hidden" name="father_comment_id" value="{{ $child->id }}">
                <input type="hidden" name="post_id" value="{{ $child->post_id }}">

                <div class="d-flex justify-content-end">
                    <button class="btn btn-primary" type="submit">Responder</button>
                </div>
            </form>
        </div>

        {{-- Mostrar los comentarios hijos --}}
        @if($child->children->isNotEmpty())
            <div class="mt-3 ms-1">
                @include('components.comments.comment-box2', ['childcomments' => $child->children])
            </div>
        @endif
    </div>
    <script>
        let bandera = null; // Inicializamos la variable bandera

        // Esta función gestionará el modo de edición y respuesta
        function setAction(action, commentId) {
            // Limpiamos cualquier otro formulario abierto
            document.querySelectorAll('.collapse').forEach(element => element.classList.remove('show'));

            if (action === 'editar') {
                // Activamos el formulario de edición
                document.getElementById('edit-form-' + commentId).classList.add('show');
                document.getElementById('comment-content-' + commentId).style.display = 'none'; // Ocultamos el comentario original
                bandera = 'editar'; // Establecemos la bandera como "editar"
            } else if (action === 'responder') {
                // Activamos el formulario de respuesta
                document.getElementById('reply-form-' + commentId).classList.add('show');
                bandera = 'responder'; // Establecemos la bandera como "responder"
            }
        }

        // Aquí podemos realizar alguna validación si es necesario para asegurarnos que no se activan ambos formularios al mismo tiempo.
    </script>

@endforeach
