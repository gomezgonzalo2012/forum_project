<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">


   <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Custom fonts for this template-->
    <link href="{{asset('assets/css/all.min.css')}}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{asset('assets/css/sb-admin-2.min.css')}}" rel="stylesheet">
 <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gradient-primary">

    <div class="container">

        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                
                     <div class="col-lg-5 d-none d-lg-block bg-register-image">
                        <div class="d-flex justify-content-center align-items-center h-100">
                         <figure>
                        <img src="{{asset('assets/images/signin-image.jpg')}}" alt="sing up image">
                        </figure>
                     </div> 
                     
                    </div>
                    <div class="col-lg-7">
                        <div class="p-5">
                             {{ $slot }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
<!--
    <!-- Bootstrap core JavaScript-->
    <script src="{{asset('assets/js/jquery.min.js')}}"></script>
    <script src="{{asset('assets/js/bootstrap.bundle.min.js')}}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{asset('assets/js/jquery.easing.min.js')}}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{asset('assets/css/sb-admin-2.min.css')}}"></script>
-->
</body>

</html>
