@foreach($childcomments as $child)
    <div class="mb-3 ms-4 @if($child->dislikes > 30)
        alert alert-danger
    @elseif($child->dislikes > 15)
        alert alert-warning
    @endif">
        <div class="">
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

              {{-- Checkbox para seleccionar comentarios a desactivar --}}
              @if ( $child->comment_state === 'activo')
                <div class="d-flex justify-content-end mt-2">
                    <label>
                        <input type="checkbox" name="comments_to_deactivate[]" value="{{ $child->id }}"
                            {{ $child->comment_state === 'desactivo' ? 'checked' : '' }}>
                        desactivar
                    </label>
                </div>
                @else
                <div class="d-flex justify-content-end mt-2">
                    <label>
                        <input type="checkbox" name="comments_to_activate[]" value="{{ $child->id }}"
                            {{ $child->comment_state === 'activo' ? 'checked' : '' }}>
                        activar
                    </label>
                </div>
              @endif

            <p class="card-text mt-2">{{ $child->content }}</p>

            {{-- Likes and Dislikes --}}
            <div class="d-flex justify-content-start align-items-center mt-3">
                <div class="ms-2 btn like-button">
                    <i class="bi bi-hand-thumbs-up"></i>
                    <span id="like-count-{{ $child->id }}">{{ $child->likes }}</span>
                </div>
                <div class="ms-2 btn dislike-button">
                    <i class="bi bi-hand-thumbs-down"></i>
                    <span id="dislike-count-{{ $child->id }}">{{ $child->dislikes }}</span>
                </div>
            </div>
        </div>

        {{-- Displaying Child Comments Recursively --}}
        @if($child->children->isNotEmpty())
            <div class="mt-3 ms-2">
                @include('components.admin.comment_boxAdmin', ['childcomments' => $child->children])
            </div>
        @endif
    </div>
    {{-- Botón de Guardar Cambios --}}
@endforeach


