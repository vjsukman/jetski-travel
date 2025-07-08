<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>TripSummit</title>

    <link rel="icon" type="image/png" href="{{ asset('uploads/favicon.png') }}">

    <!-- All CSS -->
    <link rel="stylesheet" href="{{ asset('dist-front/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dist-front/css/bootstrap-datepicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dist-front/css/animate.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dist-front/css/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset('dist-front/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dist-front/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dist-front/css/select2-bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dist-front/css/all.css') }}">
    <link rel="stylesheet" href="{{ asset('dist-front/css/meanmenu.css') }}">
    <link rel="stylesheet" href="{{ asset('dist-front/css/spacing.css') }}">
    <link rel="stylesheet" href="{{ asset('dist-front/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/css/iziToast.min.css') }}">

    <!-- All Javascripts -->
    <script src="{{ asset('dist-front/js/jquery-3.6.1.min.js') }}"></script>
    <script src="{{ asset('dist-front/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('dist-front/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('dist-front/js/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('dist-front/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('dist-front/js/wow.min.js') }}"></script>
    <script src="{{ asset('dist-front/js/select2.full.js') }}"></script>
    <script src="{{ asset('dist-front/js/jquery.waypoints.min.js') }}"></script>
    <script src="{{ asset('dist-front/js/moment.min.js') }}"></script>
    <script src="{{ asset('dist-front/js/counterup.min.js') }}"></script>
    <script src="{{ asset('dist-front/js/multi-countdown.js') }}"></script>
    <script src="{{ asset('dist-front/js/jquery.meanmenu.js') }}"></script>
    <script src="{{ asset('dist/js/iziToast.min.js') }}"></script>

    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>

<body>
    @include('front.layout.navbar')
    @yield('content')
    @include('front.layout.footer')

    <script src={{ asset('dist-front/js/scripts.js') }}></script>
    <script src={{ asset('dist-front/js/custom.js') }}></script>

    @if ($errors->any())
        <ul>
            @foreach ($errors->all() as $error)
                <script>
                    iziToast.show({
                        message: '{{ $error }}',
                        position: 'topRight',
                        color: 'red',
                    });
                </script>
            @endforeach
        </ul>
    @endif
    @if (session('error'))
        <script>
            iziToast.show({
                message: '{{ session('error') }}',
                position: 'topRight',
                color: 'red',
            });
        </script>
    @endif
    @if (session('success'))
        <script>
            iziToast.show({
                message: '{{ session('success') }}',
                position: 'topRight',
                color: 'green',
            });
        </script>
    @endif
</body>

</html>
