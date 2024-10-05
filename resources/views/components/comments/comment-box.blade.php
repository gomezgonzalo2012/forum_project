@props(['comment'])
<!-- Parent comment-->
<div class="flex-shrink-0"><img class="rounded-circle" src="https://dummyimage.com/50x50/ced4da/6c757d.jpg" alt="..." /></div>
<div class="ms-3">
    <div class="font-bold">{{ $comment->user->name }}</div>
    <div>{{ $comment->content }}</div>
    <!-- Child comment 1-->

    @if($comment->children->isNotEmpty())

            @foreach($comment->children as $childComment)
            <div class="d-flex mt-4">
                @component('components.comments.comment-box', ['comment' => $childComment])
                @endcomponent
            </div>
             @endforeach
    @endif
        {{-- <div class="flex-shrink-0"><img class="rounded-circle" src="https://dummyimage.com/50x50/ced4da/6c757d.jpg" alt="..." /></div>
        <div class="ms-3">
            <div class="fw-bold">Commenter Name</div>
            And under those conditions, you cannot establish a capital-market evaluation of that enterprise. You can't get investors.
        </div> --}}
        {{-- icon favoritos --}}

        <div>
            <a href="#" data-action="favorite" title="Favorite this discussion" class="favorite-button-toggle favorite-button-toggle--v2 " aria-label="Favorite this discussion">
                <span class="label label-default">
                <span class="favorite-icon favorite-icon--refresh-v2 icon-heart-empty"></span>
            </span>
            <span class="label label-favorited"><span class="favorite-icon favorite-icon--refresh-v2 icon-heart"></span></span>
            <span class="label label-count-refresh label-count-refresh--v2">2</span>
        </a>
    </div>
