@extends('layouts.application')

@section('styles')
    <!-- Icon fonts -->
    <link rel="stylesheet" href="{{ asset('fonts/fontawesome.css') }}">
    <link rel="stylesheet" href="{{ asset('fonts/ionicons.css') }}">
    <link rel="stylesheet" href="{{ asset('fonts/linearicons.css') }}">
    <link rel="stylesheet" href="{{ asset('fonts/open-iconic.css') }}">
    <link rel="stylesheet" href="{{ asset('fonts/pe-icon-7-stroke.css') }}">

    <!-- Libs -->
    <link rel="stylesheet" href="{{ asset('vendor/perfect-scrollbar/perfect-scrollbar.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/toastr/toastr.css') }}">
@endsection

@section('layout-content')
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
@endsection

@section('scripts')
    <script src="{{ asset('js/sidenav.js') }}"></script>
    <script src="{{ asset('js/material-ripple.js') }}"></script>
    <script src="{{ asset('js/layout-helpers.js') }}"></script>
    <script src="{{ asset('js/dropdown-hover.js') }}"></script>

{{--    <!-- Theme settings -->--}}
{{--    <!-- This file MUST be included after core stylesheets and layout-helpers.js in the <head> section -->--}}
{{--    <script src="assets/vendor/js/theme-settings.js"></script>--}}
{{--    <script>--}}
{{--        window.themeSettings = new ThemeSettings({--}}
{{--            cssPath: 'assets/vendor/css/rtl/',--}}
{{--            themesPath: 'assets/vendor/css/rtl/'--}}
{{--        });--}}
{{--     </script>--}}

    <!-- Core scripts -->
    <script src="{{ asset('js/pace.js') }}"></script>

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

@endsection
