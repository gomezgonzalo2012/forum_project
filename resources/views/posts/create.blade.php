@extends('layouts.app2')

@section('title')
@section('content')
    <!-- Wrapper container -->
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-lg-7">
                <div class="card shadow-lg border-1 rounded-lg mt-5">
                    <div class="card-body">
                    <!-- Bootstrap 5 starter form -->

                        <form action="{{route('posts.store')}}" method="POST">

                            @csrf

                            <!-- Name input -->
                            <div class="mb-3">
                              <label class="form-label" for="title">Titulo</label>
                              <input class="form-control" id="title" type="text" name="title" placeholder="" data-sb-validations="required" />
                              <div class="invalid-feedback" data-sb-feedback="title:required">Titulo is required.</div>
                            </div>

                            {{-- <!-- Email address input -->
                            <div class="mb-3">
                              <label class="form-label" for="emailAddress"> Categorias</label>
                              <input class="form-control" id="emailAddress" type="text" placeholder="seleccione categorias" data-sb-validations="required, email" />
                              <div class="invalid-feedback" data-sb-feedback="emailAddress:required">Email Address is required.</div>
                              <div class="invalid-feedback" data-sb-feedback="emailAddress:email">Email Address Email is not valid.</div>
                            </div> --}}

                            <!-- Message input -->
                            <div class="mb-3">
                              <label class="form-label" for="content">Contenido</label>
                              <textarea class="form-control" id="content" type="text" name="content" placeholder="" style="height: 10rem;" data-sb-validations="required"></textarea>
                              <div class="invalid-feedback" data-sb-feedback="content:required">Contenido is required.</div>
                            </div>

                            <!-- Form submissions success message -->
                            <div class="d-none" id="submitSuccessMessage">
                              <div class="text-center mb-3">Form submission successful!</div>
                            </div>

                            <!-- Form submissions error message -->
                            <div class="d-none" id="submitErrorMessage">
                              <div class="text-center text-danger mb-3">Error sending message!</div>
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
@endsection
