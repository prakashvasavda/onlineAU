<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="format-detection" content="telephone=no"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Candidates Registration</title>
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('front/images/favicon.ico') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bellefair&family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('front/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('front/css/animate.min.css') }}">
    <link rel="stylesheet" href="{{ asset('front/css/fontawesome-all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('front/css/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('front/css/stellarnav.min.css') }}">
    <link rel="stylesheet" href="{{ asset('front/css/nice-select.css') }}">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <link rel="stylesheet" href="{{ asset('front/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('front/css/responsive.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('front/css/search.css') }}">
</head>
<body>

    @include('user.header')
    <div class="single-form-section">
        @yield('content')
    </div>

    @include('user.footer')

    <script src="{{ asset('front/js/modernizr-3.5.0.min.js') }}"></script>
    <script src="{{ asset('front/js/jquery.min.js') }}"></script>
    <script src="{{ asset('front/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('front/js/fontawesome-all.min.js') }}"></script>
    <script src="{{ asset('front/js/stellarnav.min.js') }}"></script>
    <script src="{{ asset('front/js/wow.min.js') }}"></script>
    <script src="{{ asset('front/js/slick.min.js') }}"></script>
    <script src="{{ asset('front/js/nice-select.min.js') }}"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDD64PSVTdGQ34zRRpNa2lKkPS-A-mbTSA&libraries=places"></script>
    <script src="{{ asset('front/js/main.js') }}"></script>
    @yield('script')
</body>
</html>
