
<!-- resources/views/components/blog-card.blade.php -->
<div class="card mb-4">
    {{-- <a href="{{ $link }}"><img class="card-img-top" src="{{ $image }}" alt="..."></a> --}}
    <div class="card-body">
        <div class="small text-muted">{{ $date }}</div>
        <h2 class="card-title">{{ $title }}</h2>
        <p class="card-text">{{ $content }}</p>
        <a class="btn btn-primary" href="{{ $link }}">See {{$comments}} comments→</a>
    </div>
</div>
