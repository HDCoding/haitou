@extends('layouts.application')

@section('subtitle', 'Login')

@section('layout-content')

    <!-- Content -->
    <div class="main-wrapper">

        <div class="preloader">
            <div class="lds-ripple">
                <div class="lds-pos"></div>
                <div class="lds-pos"></div>
            </div>
        </div>

        <div class="auth-wrapper d-flex no-block justify-content-center align-items-center" style="background:url({{ asset('images/login-register.jpg') }}) no-repeat center center;">
            <div class="auth-box">
                <div id="loginform">
                    <div class="logo">
                        <span class="db"><img src="{{ asset('images/favicons/apple-icon-60x60.png') }}" alt="logo" /></span>
                        <h5 class="font-medium m-b-20 m-t-20">Login</h5>
                    </div>
                    <!-- Form -->
                    <div class="row">
                        <div class="col-12">
                            @includeIf('errors.errors', [$errors])
                            @include('includes.messages')
                            <form class="js-validation-login form-horizontal m-t-20" method="POST" action="{{ url('login') }}">
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
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon2"><i class="ti-pencil"></i></span>
                                    </div>
                                    <input type="password" class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }} form-control-lg" autocomplete="off" id="password" minlength="6" maxlength="16" name="password" placeholder="Senha" required>
                                    @if($errors->has('password'))
                                        <span class="invalid-feedback">Este campo é obrigatório</span>
                                    @endif
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" name="remember" {{ old('remember') ? 'checked' : '' }} id="remember">
                                            <label class="custom-control-label" for="remember">Lembrar-me</label>
                                            <a href="{{ route('password.request') }}" id="to-recover" class="text-dark float-right"><i class="fa fa-lock m-r-5"></i> Esqueceu a senha?</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group text-center">
                                    <div class="col-xs-12 p-b-20">
                                        <button class="btn btn-block btn-lg btn-info" type="submit">Entrar</button>
                                    </div>
                                </div>
                                <div class="form-group m-b-0 m-t-10">
                                    <div class="col-sm-12 text-center">
                                        Não tem uma conta ainda? <a class="text-info m-l-5" href="{{ url('register') }}">Registre-se</a>
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
    <script src="{{ asset('vendor/validate/validate.js') }}"></script>
    <script src="{{ asset('js/pages/login.js') }}"></script>
    <script>
        $('[data-toggle="tooltip"]').tooltip();
        $(".preloader").fadeOut();
    </script>
@endsection
