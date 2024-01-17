<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{config('app.name','B2Bee')}}</title>

    <link rel="shortcut icon" href="{{asset('images/favicon/favicon.png')}}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{asset('images/favicon/favicon.png')}}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{asset('images/favicon/favicon.png')}}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('images/favicon/favicon.png')}}">
    <link rel="manifest" href="{{asset('favicon/site.webmanifest')}}">

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/bootstrap.css')}}">
    <link rel="stylesheet" href="{{asset('vendors/bootstrap-icons/bootstrap-icons.css')}}">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <link rel="stylesheet" href="{{asset('css/pages/auth.css')}}">
    @yield('css')
</head>

<body>
<div id="auth">

    <div class="row h-100">
        <div class="col-lg-6 col-12">
            <div id="auth-left">
                <div class="auth-logo">
                    <img src="{{asset('images/logo/logo.png')}}" alt="Logo">
                </div>
                <div class="text-center">
                    <div class="input-group mb-3">
                        <label class="input-group-text" for="language">{{__('admin.language')}}</label>
                        <select class="form-select" id="language">
                            @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                                <option {{LaravelLocalization::getCurrentLocale() == $localeCode ? 'selected' : ''}}
                                        data-url="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}"
                                        value="{{$localeCode}}">
                                    {{$properties['native']}}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                @yield('content')
            </div>
        </div>
        <div class="col-lg-6 d-none d-lg-block">
            <div id="auth-right"></div>
        </div>
    </div>

</div>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        document.getElementById('language').addEventListener('change', function (e) {
            window.location.href = e.target.selectedOptions[0].dataset.url;
        });
    });
</script>
@yield('js')
</body>

</html>
