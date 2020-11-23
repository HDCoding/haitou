@extends('layouts.application')

@section('subtitle', 'Esqueceu a senha')

@section('layout-content')

    <!-- Content -->
    <div class="main-wrapper">
{{--        <div class="preloader">--}}
{{--            <div class="lds-ripple">--}}
{{--                <div class="lds-pos"></div>--}}
{{--                <div class="lds-pos"></div>--}}
{{--            </div>--}}
{{--        </div>--}}

        <div class="auth-wrapper d-flex no-block justify-content-center align-items-center" style="background:url({{ secure_asset('images/login-register.jpg') }}); background-repeat: no-repeat; background-size: 100% 100%;">
            <div class="auth-box">
                <div id="loginform">
                    <div class="logo">
                        <span class="db"><img src="{{ secure_asset('images/favicons/apple-icon-60x60.png') }}" alt="logo" /></span>
                        <h5 class="font-medium m-b-20 m-t-20">Redefinir sua senha</h5>
                    </div>
                    <!-- Form -->
                    <div class="row">
                        <div class="col-12">
                            @includeIf('errors.errors', [$errors])
                            @include('includes.messages')
                            <form class="js-validation-forget-password form-horizontal m-t-20" method="POST" action="{{ route('password.email') }}">
                                @csrf
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1"><i class="ti-user"></i></span>
                                    </div>
                                    <input type="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }} form-control-lg" autocomplete="off" id="email" maxlength="70" name="email" placeholder="E-mail" required value="{{ old('email') }}">
                                    @if($errors->has('email'))
                                        <span class="invalid-feedback">Este campo é obrigatório</span>
                                    @endif
                                </div>
                                <div class="form-group text-center">
                                    <div class="col-xs-12 p-b-20">
                                        <button class="btn btn-block btn-lg btn-info" type="submit">Resetar</button>
                                    </div>
                                </div>
                                <div class="form-group m-b-0 m-t-10">
                                    <div class="col-sm-12 text-center">
                                        Lembrou sua senha? <a href="{{ url('login') }}">Login</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- / Content -->

@endsection

@section('script')
{{--    <script src="{{ secure_asset('vendor/validate/validate.js') }}"></script>--}}
{{--    <script src="{{ secure_asset('js/pages/email.js') }}"></script>--}}
    <script nonce="{{ Bepsvpt\SecureHeaders\SecureHeaders::nonce() }}">
        $('[data-toggle="tooltip"]').tooltip();
        $(".preloader").fadeOut();
    </script>
@endsection
