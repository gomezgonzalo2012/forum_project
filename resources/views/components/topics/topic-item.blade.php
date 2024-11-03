{{-- <div class="accordion" id="accordionExample"> --}}
    @props(['description', 'link', 'postCount'])

    {{-- <div class="accordion-item">
        <h2 class="accordion-header">
            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{$topic_id}}" aria-expanded="true" aria-controls="collapse{{$topic_id}}">
                <div class="d-flex align-items-center">
                    <img src="{{ $imgUrl }}" alt="{{ $description }}" class="me-3" style="width: 60px; height: 60px; object-fit: cover;"> <!-- Imagen del topic -->
                    <div class="flex-grow-1"> <!-- Esto permite que el título ocupe el espacio disponible -->
                        <h5 class="mb-1">{{ $description }}</h5> <!-- Título del topic -->
                        <small class="text-muted">Posts: {{ $postCount }}</small> <!-- Cantidad de posts -->
                    </div>
                </div>
            </button>
        </h2>
        <div id="collapse{{$topic_id}}" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
            <div class="accordion-body">
                {{$slot}} <!-- Aquí va el contenido de los posts -->
            </div>
        </div>
    </div> --}}

    <div class="card mb-3 border-0 border-bottom">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <!-- Icono de tema y título -->
                    <h5 class="card-title mb-1">
                        <i class="bi bi-pin"></i> <!-- Icono de pin -->
                        <a href="{{ $link }}" class="text-dark text-decoration-none">{{ $description }}</a>
                    </h5>
                    <div class="text-muted small">{{-- $category --}} Category</div>
                    <!-- Descripción del tema -->
                    <a href="{{ $link }}">ver más</a></p>
                </div>
                <div class="text-end">
                    <!-- Contador de respuestas y fecha de actividad -->
                    <div class="text-muted small">{{ $postCount  }} posts</div>
                    <div class="text-muted small">{{--$activityDate--}} Actividad</div>
                </div>
            </div>
        </div>
    </div>



  {{-- </div> --}}
