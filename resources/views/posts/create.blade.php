@extends('layouts.app2')
@section("css")
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
@endsection

@section('title')
@section('content')
    <!-- Wrapper container -->


    <div class="container py-3">
        <!-- Side widgets-->

        <div class="row justify-content-center">

            <div class="col-lg-7">
             @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

                <div class="card shadow-lg border-1 rounded-lg mt-5">
                    <div class="card-body">
                    <!-- Bootstrap 5 starter form -->
                    <form action="{{ isset($postEdit) ? route('posts.update', $postEdit->id) : route('posts.store') }}" method="POST">
                        @csrf
                        @if(isset($postEdit))
                            @method('PUT')
                        @endif
                        {{-- <form action="{{route('posts.store')}}" method="POST"> --}}

                            {{-- @csrf --}}

                            <!-- title input -->
                            <div class="mb-3">
                             <label class="form-label" for="title">Titulo</label>
                             <input class="form-control @error('title') is-invalid @enderror" id="title" type="text" name="title" placeholder=""
                                value="{{ old('title', $postEdit->title ?? '') }}"  required />
                             @error('title')
                                <div class="invalid-feedback">{{ $message }}
                                </div>
                             @enderror
                            <!---- user input -->
                                <input type="hidden" name="user_id" value="@if(Auth::check()){{ Auth::user()->id }}@endif">
                            </div>
                            @if(isset($topic))
                                <div class="mb-3">
                                   <label class="form-label" for="topic">Tema</label>
                                   <input class="form-control @error('topic') is-invalid @enderror" id="topic" type="text" name="topic" placeholder="" value="{{ $topic->description }}" readonly required />
                                    @error('topic')
                                    <div class="invalid-feedback">{{ $message }}
                                    </div>
                                     @enderror
                                     <!---- topic input -->
                                    <input type="hidden" name="topic_id" value="{{ $topic->id }}" />
                                  </div>
                            @else
                                <!-- creacion del topic-->
                                <div class="mb-3">
                                    <label class="form-label" for="new_topic">Crea un nuevo tema</label>
                                    <input class="form-control @error('new_topic') is-invalid @enderror" id="new_topic" type="text" name="new_topic"
                                    placeholder="" value="{{ old('new_topic', $postEdit->topic->description ?? '') }}" required/>
                                    @error('new_topic')
                                    <div class="invalid-feedback">{{ $message }}
                                    </div>
                                    @enderror
                                </div>

                            @endif

                            {{-- category input  --}}

                            <div class="mb-3">
                                <label class="form-label" for="category">Categoría</label>
                            <select name="category[]" multiple aria-label="Multiple select" id="category" class="form-control @error('category') is-invalid @enderror">
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}
                                    </option>
                                @endforeach
                            </select>

                                @error('category')
                                <div class="invalid-feedback">{{ $message }}
                                </div>
                                @enderror
                            </div>

                            <!-- content input -->
                            {{-- <div class="mb-3 ">
                              <label class="form-label" for="content">Contenido</label>
                              <textarea class="form-control" id="content" type="text" name="content" placeholder="" style="height: 10rem;" data-sb-validations="required"></textarea>
                              <div class="invalid-feedback" data-sb-feedback="content:required">Contenido is required.</div>
                            </div> --}}

                            <div class="mb-3 ">
                             <input id="content" type="hidden" name="content" value="{{ old('content', $postEdit->content ?? '') }}">
                            <trix-editor input="content" class="@error('content') is-invalid @enderror"></trix-editor>
                            @error('content')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            </div>
                            <!-- Form submit button -->
                            <div class="d-grid">
                              <button class="btn btn-primary btn-lg" id="submitButton" type="submit">
                                {{ isset($postEdit) ? 'Actualizar discusión' : 'Guardar discusión' }}
                              </button>
                            </div>

                        </form>

                    </div>

                </div>
            </div>

        </div>

    </div>

 @include('components.back-button')
  <!-- SB Forms JS -->
  <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>
{{-- @section("css")
    <link rel="stylesheet" type="text/css" href="https://unpkg.com/trix@2.0.8/dist/trix.css">
--}}
@endsection

@section("js")
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/i18n/defaults-*.min.js"></script>
@endsection
@endsection


