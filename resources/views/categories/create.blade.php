@extends('layouts.app2')
@section('title', 'Categorías')
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

    {{-- Formulario para crear o editar una categoría --}}
    <form class="row g-3 ms-5" method="POST" action="{{ isset($category) ? route('admin.updateCategory', $category->id) : route('admin.storeCategory') }}">
        @csrf
        @if (isset($category))
            @method('PUT')
        @endif
        <div class="col-auto">
            <input
                type="text"
                class="form-control"
                name="name"
                placeholder="Nombre de la categoría"
                value="{{ isset($category) ? $category->name : '' }}" required>
        </div>
        <div class="col-auto">
            <button type="submit" class="btn btn-primary mb-3">
                {{ isset($category) ? 'Actualizar' : 'Crear' }}
            </button>
        </div>
    </form>
    <div class="alert alert-success w-50" role="alert">
        Solo puedes actualizar las categorias sin discusiones.
      </div>
    {{-- Listado de categorías --}}
    <div class="row">
        @foreach ($listCategories as $cat)
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card h-100">
                    <div class="card-body d-flex justify-content-between">
                        <h5 class="card-title">{{ $cat->name }}</h5>
                        <div>
                            @if ($cat->posts_count > 0)
                                <p>{{ $cat->posts_count }} discusiones</p>
                            @else

                                <div class="d-flex justify-content-end">
                                    {{-- Botón para editar la categoría --}}
                                    <a href="{{ route('admin.editCategory', $cat->id) }}" class="btn btn-success btn-sm"><i class="bi bi-pencil-square"></i></a>
                                </div>

                            @endif
                        </div>
                    </div>

                </div>
            </div>
        @endforeach
    </div>
</div>
@include('components.back-button')
@endsection
