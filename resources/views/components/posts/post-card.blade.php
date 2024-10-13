
<!-- resources/views/components/blog-card.blade.php -->
<div class="card mb-4">
    {{-- <a href="{{ $link }}"><img class="card-img-top" src="{{ $image }}" alt="..."></a> --}}
    <div class="card-header">
        <div class="d-flex justify-content-between">
            <div class="">
                <img src="{{asset('assets/icons8-usuario-masculino-en-círculo-48.png')}}" width="25px" height="25px" style="border-radius:50%" alt="profile image">
                 <strong class="ml-2">{{$user}}</strong>
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
        <i class="bi bi-chat-square"> {{$commentsAmount}}</i>

        </div>
        {{-- <p class="card-body">{!! $content !!}</p> --}}
        {{-- <a class="btn btn-secondary btn-sm" href="{{ $link }}">See {{$comments}} comments→</a> --}}
    </div>
</div>
