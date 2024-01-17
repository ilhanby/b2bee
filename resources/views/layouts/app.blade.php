<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') | {{config('app.name','B2Bee')}}</title>

    <link rel="shortcut icon" href="{{asset('images/favicon/favicon.ico')}}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{asset('images/favicon/favicon.png')}}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{asset('images/favicon/favicon.png')}}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('images/favicon/favicon.png')}}">
    <link rel="manifest" href="{{asset('favicon/site.webmanifest')}}">

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/bootstrap.css')}}">
    <link rel="stylesheet" href="{{asset('vendors/iconly/bold.css')}}">
    <link rel="stylesheet" href="{{asset('vendors/toastify/toastify.css')}}">
    <link rel="stylesheet" href="{{asset('vendors/perfect-scrollbar/perfect-scrollbar.css')}}">
    <link rel="stylesheet" href="{{asset('vendors/bootstrap-icons/bootstrap-icons.css')}}">
    <link rel="stylesheet" href="{{asset('vendors/fontawesome/all.min.css')}}">
    <link rel="stylesheet" href="{{asset('vendors/sweetalert2/sweetalert2.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/app.css')}}?v={{config('panel.ASSETS_VERSION')}}">
@yield('css')
</head>

<body>
<div id="app">

    @include('partials.sidebar')

    <div id="main" class='layout-navbar'>

        @include('partials.topbar')

        <div id="main-content">

            @yield('content')

        </div>

        @include('partials.footer')

    </div>
</div>
<script src="{{asset('vendors/jquery/jquery.min.js')}}"></script>
<script src="{{asset('vendors/perfect-scrollbar/perfect-scrollbar.min.js')}}"></script>
<script src="{{asset('js/bootstrap.bundle.min.js')}}"></script>

<script src="{{asset('vendors/toastify/toastify.js')}}"></script>
<script src="{{asset('vendors/fontawesome/all.min.js')}}"></script>
<script src="{{asset('vendors/sweetalert2/sweetalert2.all.min.js')}}"></script>
<script src="{{asset('js/main.js')}}?v={{config('panel.ASSETS_VERSION')}}"></script>

@yield('js')
@if(session()->has('success'))
    <script>
        Toastify({
            text: "{{session()->get('success')}}",
            duration: 3000,
            close: true,
            gravity: "bottom",
            position: "right",
            backgroundColor: "#4fbe87",
        }).showToast();
    </script>
@endif
@if(session()->has('error'))
    <script>
        Toastify({
            text: "{{session()->get('error')}}",
            duration: 3000,
            close: true,
            gravity: "bottom",
            position: "right",
            backgroundColor: "#b92b5f",
        }).showToast();
    </script>
@endif

@foreach($errors->all() as $error)
    <script>
        Toastify({
            text: "{{$error}}",
            duration: 3000,
            close: true,
            gravity: "bottom",
            position: "right",
            backgroundColor: "#b92b5f",
        }).showToast();
    </script>
@endforeach

</body>

</html>
