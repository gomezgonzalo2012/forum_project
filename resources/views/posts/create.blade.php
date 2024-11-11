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
                <div class="card shadow-lg border-1 rounded-lg mt-5">
                    <div class="card-body">
                    <!-- Bootstrap 5 starter form -->

                        <form action="{{route('posts.store')}}" method="POST">

                            @csrf

                            <!-- title input -->
                            <div class="mb-3">
                              <label class="form-label" for="title">Titulo</label>
                              <input class="form-control" id="title" type="text" name="title" placeholder="" data-sb-validations="required" />
                              <div class="invalid-feedback" data-sb-feedback="title:required">Titulo is required.</div>
                            <!---- user input -->
                                <input type="hidden" name="user_id" value="@if(Auth::check()){{ Auth::user()->id }}@endif">
                            </div>
                            @if(isset($topic))
                                <div class="mb-3">
                                    <label class="form-label" for="topic">Tema</label>
                                    <input class="form-control" id="topic" type="text" name="topic" placeholder="" value="{{$topic->description}}" readonly data-sb-validations="required" />
                                    <div class="invalid-feedback" data-sb-feedback="topic:required">Tema is required.</div>
                                     <!---- topic input -->
                                    <input type="hidden" name="topic_id" value="{{ $topic->id }}" />
                                  </div>
                            @else
                                <!-- creacion del topic-->
                                <div class="mb-3">
                                    <label class="form-label" for="topic">Crea un nuevo tema</label>
                                    <input class="form-control" id="topic" type="text" name="new_topic" placeholder="" data-sb-validations="required" />
                                    <div class="invalid-feedback" data-sb-feedback="topic:required">Tema is required.</div>
                                  </div>

                            @endif

                            {{-- category input  --}}

                            <div class="mb-3">
                                <label class="form-label" for="category">Categoría</label>
                                <select name="category[]" multiple aria-label="Multiple select" id="category" class="form-control">
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback" data-sb-feedback="category:required">Categoria is required.</div>
                            </div>
                            <!-- content input -->
                            {{-- <div class="mb-3 ">
                              <label class="form-label" for="content">Contenido</label>
                              <textarea class="form-control" id="content" type="text" name="content" placeholder="" style="height: 10rem;" data-sb-validations="required"></textarea>
                              <div class="invalid-feedback" data-sb-feedback="content:required">Contenido is required.</div>
                            </div> --}}

                            <div class="mb-3 ">
                            <input id="content" type="hidden" name="content">
                                <trix-editor input="content" ></trix-editor>
                            </div>
                            <!-- Form submit button -->
                            <div class="d-grid">
                              <button class="btn btn-primary btn-lg" id="submitButton" type="submit">Submit</button>
                            </div>

                        </form>

                    </div>

                </div>
            </div>

        </div>

    </div>


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


