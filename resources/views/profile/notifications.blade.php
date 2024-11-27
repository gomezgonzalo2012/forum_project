@extends('layouts.app2')

@section('content')
<div class="container d-flex justify-content-center my-5">
    <div class="col-lg-8">
        <!-- Título estilizado -->
        <div class="text-center my-4">
            <h2 class="text-secondary border-bottom border-secondary pb-2">Notificaciones</h2>
        </div>
        <!-- Lista de notificaciones -->
        <div class="list-group">
            @foreach ($notifications as $notif)
            <div class="card mb-2 p-3 d-flex flex-row align-items-start">
                <img src="https://via.placeholder.com/40" alt="User" class="rounded-circle me-3" style="width: 40px; height: 40px;">
                <div class="flex-grow-1">
                    <p class="mb-1">
                        {{ $notif->data['message'] }} <strong>{{ $notif->data['content'] }}</strong>
                    </p>
                    <small class="text-muted">{{ $notif->created_at->format('M j, Y, h:i A') }}</small>

                </div>
                <div class="ms-auto">
                    <a class="btn btn-outline-secondary btn-sm" href="{{ route('posts.show', ['post' => $notif->data['post_id']]) }}">Ir</a>
                </div>
            </div>
            @endforeach

        </div>
    </div>

</div>
@endsection
