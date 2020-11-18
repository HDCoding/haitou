<!DOCTYPE html>
<html dir="ltr" lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{ secure_asset('images/favicons/favicon-16x16.png') }}">
    <title>{{ setting('site_title') }} :: @yield('title')</title>
    <!-- Icon fonts -->
    <link href="{{ secure_asset('fonts/fontawesome.css') }}" rel="stylesheet">
    <link href="{{ secure_asset('fonts/ionicons.css') }}" rel="stylesheet">
    <link href="{{ secure_asset('fonts/linearicons.css') }}" rel="stylesheet">
    <link href="{{ secure_asset('fonts/open-iconic.css') }}" rel="stylesheet">
    <link href="{{ secure_asset('fonts/pe-icon-7-stroke.css') }}" rel="stylesheet">
    <!-- Icon fonts -->
    <link href="{{ secure_asset('vendor/toastr/build/toastr.min.css') }}" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="{{ secure_asset('css/style.min.css') }}" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    @yield('css')
</head>

<body>
<!-- ============================================================== -->
<!-- Preloader - style you can find in spinners.css -->
<!-- ============================================================== -->
<div class="preloader">
    <div class="lds-ripple">
        <div class="lds-pos"></div>
        <div class="lds-pos"></div>
    </div>
</div>
<!-- ============================================================== -->
<!-- Main wrapper - style you can find in pages.scss -->
<!-- ============================================================== -->
<div id="main-wrapper">
    @include('includes.dashboard-navbar')

    @include('includes.dashboard-left')
    <!-- ============================================================== -->
    <!-- Page wrapper  -->
    <!-- ============================================================== -->
    <div class="page-wrapper">

        @yield('content')

        @include('includes.dashboard-footer')

    </div>

</div>

@include('includes.dashboard-right')

<!-- All Jquery -->
<script src="{{ secure_asset('vendor/jquery/dist/jquery.min.js') }}"></script>
<!-- Bootstrap tether Core JavaScript -->
<script src="{{ secure_asset('vendor/popper.js/dist/umd/popper.min.js') }}"></script>
<script src="{{ secure_asset('vendor/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<!-- apps -->
<script src="{{ secure_asset('js/app.min.js') }}"></script>
<script src="{{ secure_asset('js/app.init.light-sidebar.js') }}"></script>
<script src="{{ secure_asset('js/app-style-switcher.js') }}"></script>
<!-- slimscrollbar scrollbar JavaScript -->
<script src="{{ secure_asset('vendor/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js') }}"></script>
<script src="{{ secure_asset('vendor/sparkline/sparkline.js') }}"></script>
<!--Wave Effects -->
<script src="{{ secure_asset('js/waves.js') }}"></script>
<!--Menu sidebar -->
<script src="{{ secure_asset('js/sidebarmenu.js') }}"></script>
<!--Custom JavaScript -->
<script src="{{ secure_asset('js/custom.min.js') }}"></script>
@yield('scripts')
<!-- Toastr -->
<script src="{{ secure_asset('vendor/toastr/build/toastr.min.js') }}"></script>
<script nonce="{{ Bepsvpt\SecureHeaders\SecureHeaders::nonce() }}">
    {!! toastr()->message() !!}
</script>

<!-- Tooltip -->
<script nonce="{{ Bepsvpt\SecureHeaders\SecureHeaders::nonce() }}">
    $('[data-toggle="tooltip"]').tooltip();
</script>

</body>
</html>
