<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta name="robots" content="noindex">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>@yield('page_title')</title>
    <!-- bootstrap -->
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}" />
    <link rel="stylesheet" href="{{asset('css/common.css')}}" />
    <link rel="stylesheet" href="{{asset('css/style.css')}}" />
    <!-- iCheck -->
    <link rel="stylesheet" href="{{asset('css/icheck/all.css')}}" />
    @yield('head')
</head>

<body class="bg-light">
    <div class="container">
        @yield('content')
    </div>
    <!-- javascript libraries -->
    <script type="text/javascript" src="{{asset('js/jquery-3.2.1.slim.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/jquery.validate.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/icheck.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/bootstrap.min.js')}}"></script>
    @stack('javascript')
</body>
</html>