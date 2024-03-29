<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('frontend/css/bootstrap-4.3.1-dist/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>@yield('title')</title>
</head>

<body>




    <!-- Script JS -->
    <script src="{{ asset('frontend/css/src/assets/libs/popper/dist/umd/popper.min.js') }}"></script>
    <script src="{{ asset('frontend/css/src/assets/libs/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('frontend/css/src/assets/libs/bootstrap/dist/js/bootstrap.min.js') }}"></script>




    <script src="{{ asset('frontend/css/date/jquery.datetimepicker.full.min.js') }}"></script>
    <script src="{{ asset('frontend/css/date/jquery.datetimepicker.min.js') }}"></script>

    <script src="{{ asset('frontend/css/src/dist/js/app-style-switcher.js') }}"></script>
    <script src="{{ asset('frontend/css/src/dist/js/feather.min.js') }}"></script>
    <script src="{{ asset('frontend/css/src/assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js') }}">
    </script>
    <script src="{{ asset('frontend/css/src/dist/js/sidebarmenu.js') }}"></script>
    <script src="{{ asset('frontend/css/src/dist/js/custom.min.js') }}"></script>
    <script src="{{ asset('frontend/css/src/assets/extra-libs/c3/d3.min.js') }}"></script>
    <script src="{{ asset('frontend/css/src/assets/extra-libs/c3/c3.min.js') }}"></script>
    <script src="{{ asset('frontend/css/chart/dist/Chart.bundle.min.js') }}"></script>
    <script src="{{ asset('frontend/css/chart/dist/Chart.min.js') }}"></script>

    <script src="{{ asset('frontend/css/src/assets/extra-libs/jvector/jquery-jvectormap-2.0.2.min.js') }}"></script>
    <script src="{{ asset('frontend/css/src/assets/extra-libs/jvector/jquery-jvectormap-world-mill-en.js') }}"></script>

    <script src="{{ asset('frontend/css/sweetalert2/dist/sweetalert2.all.min.js') }}"></script>
    <script src="{{ asset('frontend/dist/yearpicker.js') }}"></script>
    {{-- datables --}}
    <script type="text/javascript" src="{{ asset('frontend/css/dataTables.min.js') }}"></script>
    {{-- datables --}}
    {{-- tag inputan --}}

    <!-- Amsify Plugin -->
    <script type="text/javascript" src="{{ asset('frontend/tag/jquery.amsify.suggestags.js') }}"></script>
    <script type="text/javascript" src="{{ asset('frontend/css/js/numeral.min.js') }}"></script>
    {{-- new --}}
    @yield('container')
    {{-- <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
    <link href="https://code.jquery.com/ui/1.11.3/themes/smoothness/jquery-ui.css" /> --}}
    <link rel="stylesheet" href="{{ asset('frontend/css/jquery-ui.min.css') }}">
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"
        integrity="sha256-xLD7nhI62fcsEZK2/v8LsBcb4lG7dgULkuXoXB/j91c=" crossorigin="anonymous"></script>
</body>

</html>
