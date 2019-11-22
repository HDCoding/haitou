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
@endsection

@section('layout-content')

    @yield('content')

@endsection

@section('scripts')


    <script src="assets/vendor/js/material-ripple.js"></script>
    <script src="assets/vendor/js/layout-helpers.js"></script>

    <!-- Theme settings -->
    <!-- This file MUST be included after core stylesheets and layout-helpers.js in the <head> section -->
    <script src="assets/vendor/js/theme-settings.js"></script>
    <script>
        window.themeSettings = new ThemeSettings({
            cssPath: 'assets/vendor/css/rtl/',
            themesPath: 'assets/vendor/css/rtl/'
        });
    </script>

    <!-- Core scripts -->
    <script src="assets/vendor/js/pace.js"></script>

    <!-- Libs -->
    <script src="{{ asset('vendor/perfect-scrollbar/perfect-scrollbar.js') }}"></script>

    <!-- Demo -->
    <script src="assets/js/demo.js"></script>

@endsection
