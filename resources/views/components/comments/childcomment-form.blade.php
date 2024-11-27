

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
<script>
    let bandera = null; // Inicializamos la variable bandera

    function setAction(action, commentId) {
        document.querySelectorAll('.collapse').forEach(element => element.classList.remove('show'));

        if (action === 'editar') {
            document.getElementById('edit-form-' + commentId).classList.add('show');
            document.getElementById('comment-content-' + commentId).style.display = 'none'; // Ocultamos el comentario original
            bandera = 'editar'; // Establecemos la bandera como "editar"
        } else if (action === 'responder') {
            // Activamos el formulario de respuesta
            document.getElementById('reply-form-' + commentId).classList.add('show');
            bandera = 'responder'; // Establecemos la bandera como "responder"
        }
    }

</script>

