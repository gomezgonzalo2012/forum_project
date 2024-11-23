@extends('layouts.app2')
@section('title',"Categoria - $category->name")
@section('content')
<header class="py-2 bg-light border-bottom mb-4">
    <div class="container">
        <div class="text-center my-2">
           <h3>{{strtoupper($category->name)}}</h3>
        </div>
    </div>
</header>
    <!-- Page content-->

    <div class="container">
        <div class="row justify-content-center">

            <!-- Blog entries-->
            <div class="col-lg-8">
                @if(@isset($posts))
                    @foreach ($posts as $p)

                    @component('components.posts.post-card', [
                        'link'=>route('posts.show',['post'=>$p->id]),
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
                    @else
                     <h5>Aun no tienes publicaciones</h5>

                @endif
            </div>

        </div>
    </div>
     @include('components.back-button')
@endsection
