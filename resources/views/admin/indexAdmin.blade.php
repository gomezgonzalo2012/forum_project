@extends('layouts.app2')
@section('title','Moderación de Discuciones')
@section("content")
<header class="py-2 bg-light border-bottom mb-4">
    <div class="container">
        <div class="text-center my-2">
            <h2 class="fw-bolder">Moderación de discuciones</h2>
        </div>
    </div>
</header>


    <div class="container">

        <div class="row justify-content-center">

            {{-- <div class="text-center my-5">
                <h3 class="fw-bolder">{{$topic->description}}</h3>
            </div> --}}
            <div class="d-flex justify-content-end mb-3">

            </div>

            <div class="col-lg-8">
                <div class="alert alert-success " role="alert">
                    Las discusiones están ordenadas según la votación de los usuarios.
                    Las discusiones con mayor número de dislikes estarán más arriba y son las que requerirán de tu moderación.
                  </div>
                @foreach ($posts as $p)

                    @component('components.posts.post-card', [
                        'link'=>route('admin.show',['post'=>$p->id]),
                        'image'=>"https://dummyimage.com/850x350/dee2e6/6c757d.jpg",
                        'date'=> $p->created_at->format('F j, Y') ,
                        'user'=>$p->user ? $p->user->name : 'Usuario desconocido' ,
                        'title'=> $p->title ,
                        'commentsAmount'=>count($p->comments),
                        'likes'=>$p->comments->sum('likes'),
                        'dislikes'=>$p->comments->sum('dislikes'),
                        ])
                    @endcomponent

                @endforeach

                <!-- Pagination-->
                <nav aria-label="Pagination">
                    {{$posts->links()}}
                </nav>
            </div>
        </div>
    </div>
     @include('components.back-button')
@endsection

