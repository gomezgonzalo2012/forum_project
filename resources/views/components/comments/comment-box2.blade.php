@foreach($childcomments as $child)
    <div class="mb-3 ms-3" id="comment-{{ $child->id }}">
        <div class="d-flex align-items-start">
            <div class="d-flex align-items-center">
                <img src="{{ asset('assets/icons8-usuario-masculino-en-círculo-48.png') }}" alt="User avatar" class="rounded-circle me-2" width="40" height="40">
                <div>
                    <h5 class="card-title mb-1">{{ $child->user->name }}</h5>
                    <h6 class="card-subtitle text-muted">{{ $child->created_at->locale('es_ES')->diffForHumans() }} - @if(($child->updated_at > $child->created_at))
                        Editado el {{$child->updated_at->format('M j, Y')}}
                        @endif
                    </h6>


                </div>

            </div>
            @if($child->user->isModerator())

                <small><span class="badge bg-secondary">Moderador</span></small>

            @endif
        </div>

        {{-- manejo de contenido suspendido --}}
            @if ($child->comment_state == "desactivo")
                <p class="card-text mt-2 alert alert-info "style="width: 28rem;">Este comentario fue suspendido por un moderador.</p>

            @else
                    <p class="card-text mt-2 ms-5" id="comment-content-{{ $child->id }}">{{ $child->content }}</p>

                <div class="d-flex justify-content-start align-items-center mt-3">
                {{-- likes y dislikes --}}
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
            {{-- formulario edicion y cometario --}}
            <x-comments.childcomment-form :child="$child"/>
        @endif
        {{-- Mostrar los comentarios hijos --}}
        @if($child->children->isNotEmpty())
            <div class="mt-3 ms-1">
                @include('components.comments.comment-box2', ['childcomments' => $child->children])
            </div>
        @endif
    </div>

@endforeach
