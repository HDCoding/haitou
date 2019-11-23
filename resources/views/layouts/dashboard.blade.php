<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <title>Site :: @yield('subtitle')</title>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">
    <link rel="icon" type="image/x-icon" href="{{ asset('images/favicons/favicon.ico') }}">

    <link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i,900" rel="stylesheet">

    <!-- Icon fonts -->
    <link rel="stylesheet" href="{{ asset('fonts/fontawesome.css') }}">
    <link rel="stylesheet" href="{{ asset('fonts/ionicons.css') }}">
    <link rel="stylesheet" href="{{ asset('fonts/linearicons.css') }}">
    <link rel="stylesheet" href="{{ asset('fonts/open-iconic.css') }}">
    <link rel="stylesheet" href="{{ asset('fonts/pe-icon-7-stroke.css') }}">

    <!-- Core stylesheets -->
    <link rel="stylesheet" href="{{ asset('vendor/bootstrap/css/bootstrap.css') }}" class="theme-settings-bootstrap-css">
    <link rel="stylesheet" href="{{ asset('css/appwork.css') }}" class="theme-settings-appwork-css">
    <link rel="stylesheet" href="{{ asset('css/theme-corporate.css') }}" class="theme-settings-theme-css">
    <link rel="stylesheet" href="{{ asset('css/colors.css') }}" class="theme-settings-colors-css">
    <link rel="stylesheet" href="{{ asset('css/uikit.css') }}">
    <link rel="stylesheet" href="{{ asset('css/demo.css') }}">

    <!-- Libs -->
    <link rel="stylesheet" href="{{ asset('vendor/perfect-scrollbar/perfect-scrollbar.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/toastr/toastr.css') }}">



    @yield('css')

</head>

<body>
<div class="page-loader">
    <div class="bg-primary"></div>
</div>

<!-- Layout wrapper -->
<div class="layout-wrapper layout-2">

    <div class="layout-inner">

        <!-- Layout sidenav -->
        @include('includes.dashboard-sidenav')
        <!-- / Layout sidenav -->

        <!-- Layout container -->
        <div class="layout-container">
            <!-- Layout navbar -->
            @include('includes.dashboard-navbar')
            <!-- / Layout navbar -->

            <!-- Layout content -->
            <div class="layout-content">

                <!-- Content -->
                <div class="container-fluid flex-grow-1 container-p-y">
                    @yield('content')
                </div>
                <!-- / Content -->

                <!-- Layout footer -->
                @include('includes.dashboard-footer')
                <!-- / Layout footer -->
            </div>
            <!-- Layout content -->

        </div>
        <!-- / Layout container -->

    </div>

    <!-- Overlay -->
    <div class="layout-overlay layout-sidenav-toggle"></div>
</div>
<!-- / Layout wrapper -->

<!-- Core scripts -->
<script src="{{ asset('vendor/jquery/jquery-3.4.1.min.js') }}"></script>
<script src="{{ asset('js/pace.js') }}"></script>
<script src="{{ asset('vendor/popper/popper.js') }}"></script>
<script src="{{ asset('vendor/bootstrap/js/bootstrap.js') }}"></script>

<script src="{{ asset('js/sidenav.js') }}"></script>

<script src="{{ asset('js/material-ripple.js') }}"></script>
<script src="{{ asset('js/layout-helpers.js') }}"></script>
<script src="{{ asset('js/dropdown-hover.js') }}"></script>

<!-- Libs -->
<script src="{{ asset('vendor/perfect-scrollbar/perfect-scrollbar.js') }}"></script>

<!-- Demo -->
<script src="{{ asset('js/demo.js') }}"></script>

<!-- Toastr -->
<script src="{{ asset('vendor/toastr/toastr.js') }}"></script>
<script nonce="{{ Bepsvpt\SecureHeaders\SecureHeaders::nonce() }}">
    {!! toastr()->message() !!}
</script>

<!-- Tooltip -->
<script nonce="{{ Bepsvpt\SecureHeaders\SecureHeaders::nonce() }}">
    $('[data-toggle="tooltip"]').tooltip();
</script>

@yield('script')

</body>
</html>
