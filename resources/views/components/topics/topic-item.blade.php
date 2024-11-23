{{-- <div class="accordion" id="accordionExample"> --}}
    @props(['description', 'link', 'postCount','lastDate'])

    <div class="card mb-3 border-0 border-bottom">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <h5 class="card-title mb-1">
                        <i class="bi bi-bookmarks"></i>
                        <a href="{{ $link }}" class="text-dark text-decoration-none">{{ $description }}</a>
                        <!-- Contador de respuestas y fecha de actividad -->
                    </h5>
                    <div class="text-muted small">{{ $postCount  }} discusiones</div>
                    <div class="text-muted small">Ultima actividad {{$lastDate}} </div>
                    <!-- Descripción del tema -->
                </div>
                <div class="text-end">
                    <a  class="btn btn-outline-secondary btn-sm" href="{{ $link }}">ver más</a>

                </div>
            </div>
        </div>
    </div>


  {{-- </div> --}}
