
<button class="ms-2 btn like-button" data-comment-id="{{ $comment->id }}" data-reaction="likes"
    @if($userReaction && $userReaction->reaction === 'likes') disabled @endif>
    <i class="bi bi-hand-thumbs-up"></i>
    <span id="like-count-{{ $comment->id }}">{{ $comment->likes }}</span>
</button>

<button class="ms-2 btn dislike-button" data-comment-id="{{ $comment->id }}" data-reaction="dislikes"
    @if($userReaction && $userReaction->reaction === 'dislikes') disabled @endif>
    <i class="bi bi-hand-thumbs-down"></i>
    <span id="dislike-count-{{ $comment->id }}">{{ $comment->dislikes }}</span>
</button>
