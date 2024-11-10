
@props([
    'user' ,
    'link',
    'date',
    'commentsAmount',
    'title',
    'image',
    'likes',
    'dislikes'
])
<!-- resources/views/components/blog-card.blade.php -->
<div class="card mb-4">

    {{-- <a href="{{ $link }}"><img class="card-img-top" src="{{ $image }}" alt="..."></a> --}}
    <div class="card-header">
        <div class="d-flex justify-content-between">
            <div class="">
                <img src="{{asset('assets/icons8-usuario-masculino-en-círculo-48.png')}}" width="25px" height="25px" style="border-radius:50%" alt="profile image">
                <span> <strong class="ml-2">{{$user}}</strong></span>
            </div>
            <div>
             <a class="btn btn-secondary btn-sm" href="{{ $link }}">Ver más</a>

            </div>
        </div>

    </div>

    <div class="card-body">
        <div class="small text-muted">{{ $date }}  {{--{{$name}}--}}</div>
        <h4 class="card-title">{{ $title }}</h4> {{--evita el html --}}
        <div class="d-flex justify-content-end">
            <p><i class=" ms-2 bi bi-hand-thumbs-up"></i>{{  $likes  }}</p>
            <p><i class="ms-3 bi bi-hand-thumbs-down"></i> {{  $dislikes }}</p>
            <i class="ms-3 bi bi-chat-square"> {{$commentsAmount}}</i>
        </div>
    </div>
</div>
