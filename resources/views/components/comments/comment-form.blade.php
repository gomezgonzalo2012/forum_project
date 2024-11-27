{{-- <form class="mb-4" action="{{ route('comments.store') }}" method="POST">
    @csrf
    <textarea class="form-control" data-bs-toggle="collapse" href="#collapseExample" role="button" placeholder="leave a comment" aria-expanded="false" aria-controls="collapseExample" rows="3" name="content"></textarea>
    <input type="hidden" name="user_id" value="{{ Auth::check() ? Auth::user()->id : '' }}">
    <input type="hidden" name="post_id" value="{{ $singlePost->id }}">

    <div class="collapse py-3" id="collapseExample">
        <div class="d-flex justify-content-end">
            <button class="btn btn-success" type="submit">Comentar</button>
        </div>
    </div>
</form> --}}
<form class="mb-4" action="{{$route}}" method="POST">
    @csrf
    <textarea class="form-control" data-bs-toggle="collapse" href="#collapseExampleComment" role="button" placeholder="Escribe tu comentario aquí" aria-expanded="false" aria-controls="collapseExampleComment" rows="3" name="content"></textarea>
    <input type="hidden" name="user_id" value="{{ Auth::check() ? Auth::user()->id : '' }}">
    <input type="hidden" name="father_comment_id" value="{{ $fatherComment->id ?? '' }}"> {{-- null para comentario padre--}}
    <input type="hidden" name="post_id" value="{{ $post->id }}">

    <div class="collapse py-3" id="collapseExampleComment">
        <div class="d-flex justify-content-end">
            <button class="btn btn-success" type="submit">Comentar</button>
        </div>
    </div>
</form>
