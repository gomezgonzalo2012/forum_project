<div class="card mb-2">

    <div class="card-header"> <i class="bi bi-fire"></i> Dicusiones más activas</div>
    @foreach ($popularPosts as $pop )
            <div class="card mb-1 border-0 border-bottom">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            {{-- <h5 class="card-title mb-1"> --}}
                                <p><a href="{{route('posts.show',['post'=>$pop->id])}}" class="text-dark fw-semibold text-decoration-none">{{$pop->title}}</a></p>
                            {{-- </h5> --}}
                        </div>
                        <div class="text-end">
                            <!-- contador de respuestas y fecha de actividad -->
                            <div class="text-muted small"> Ultima actividad {{$pop->comments->first() ? $pop->comments->first()->created_at->locale('es_ES')->diffForHumans() : 'Sin actividad'}}</div>
                            <div class="text-muted small"><i class="bi bi-reply-all"></i> {{count($pop->comments)}}</div>
                        </div>
                    </div>
                </div>
            </div>
    @endforeach

</div>
