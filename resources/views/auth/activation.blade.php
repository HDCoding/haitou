@extends('layouts.application')

@section('subtitle', 'Ativação')

@section('layout-content')

    <!-- Content -->
    <div class="main-wrapper">
{{--        <div class="preloader">--}}
{{--            <div class="lds-ripple">--}}
{{--                <div class="lds-pos"></div>--}}
{{--                <div class="lds-pos"></div>--}}
{{--            </div>--}}
{{--        </div>--}}

        <div class="auth-wrapper d-flex no-block justify-content-center align-items-center" style="background:url({{ asset('images/login-register.jpg') }}) no-repeat center center;">
            <div class="auth-box">
                <div id="loginform">
                    <div class="logo">
                        <span class="db"><img src="{{ asset('images/favicons/apple-icon-60x60.png') }}" alt="logo" /></span>
                        <h5 class="font-medium m-t-20 m-b-20">Ativação</h5>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            @includeIf('errors.errors', [$errors])
                            <p class="text-center text-big m-b-4">@include('includes.messages')</p>
                            <a class="btn btn-primary btn-block m-t-25" href="{{ url('login') }}">Prosseguir</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- / Content -->

@endsection
