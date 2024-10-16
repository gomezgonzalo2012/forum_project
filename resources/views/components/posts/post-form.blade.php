@props([
    'action' => '#',
    'userId' => null,
    'fatherCommentId',
    'postId',
])

<form method="POST" action="{{ $action }}">
    @csrf

    <textarea class="form-control mb-2" name="content" rows="2" placeholder="Escribe tu respuesta aquí..."></textarea>

    <input type="hidden" name="user_id" value="{{ $userId }}">
    <input type="hidden" name="father_comment_id" value="{{ $fatherCommentId }}">
    <input type="hidden" name="post_id" value="{{ $postId }}">

    <div class="d-flex justify-content-end">
        <button class="btn btn-primary" type="submit">
            Comment
        </button>
    </div>
</form>
