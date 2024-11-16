@extends('layouts.app2')

@section("content")
<div class="container mt-4">
    @if (session('status'))
    <div class="alert alert-info alert-dismissible fade show col-lg-4" role="alert">
        {{ session('status') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger col-lg-4" role="alert">{{ session('error') }}</div>
    @endif

    <form class="row g-3" method="POST" action="{{route('admin.storeCategory')}}">
        @csrf
        <div class="col-auto">
          <input type="text" class="form-control" id="inputPassword2" name="name" placeholder="Categoria nueva">
        </div>
        <div class="col-auto">
          <button type="submit" class="btn btn-primary mb-3"> Crear</button>
        </div>
      </form>
    <div class="row">
        @foreach ($categories as $cat)
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <h5 class="card-title">{{ $cat->name }}</h5>
                        <a href="#" class="btn btn-danger"><i class="bi bi-trash3"></i></a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
