@extends('layouts.application')

@section('subtitle', 'Login')

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
                        <h5 class="font-medium mb-2 mt-3">Login</h5>
                    </div>
                    <!-- Form -->
                    <div class="row">
                        <div class="col-12">
                            @includeIf('errors.errors', [$errors])
                            @include('includes.messages')
                            <form class="js-validation-login form-horizontal mt-2" method="POST" action="{{ url('login') }}">
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
                                            <a href="{{ route('password.request') }}" id="to-recover" class="text-dark float-right">
                                                <i class="fa fa-lock mr-5"></i> Esqueceu a senha?
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group text-center">
                                    <div class="col-xs-12 pb-2">
                                        <button class="btn btn-block btn-lg btn-info" type="submit">Entrar</button>
                                    </div>
                                </div>
                                <div class="form-group mb-0 mt-2">
                                    <div class="col-sm-12 text-center">
                                        Não tem uma conta ainda? <a class="text-info m-l-5" href="{{ url('register') }}">Registre-se</a>
                                    </div>
                                </div>
                                <div class="form-group mb-0 mt-4">
                                    <div class="col-sm-12 text-center">
                                        Não recebeu o email de ativação? <a class="text-info m-l-5 line" href="{{ url('resend') }}">Re-envie o e-mail</a>
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
{{--    <script src="{{ secure_asset('js/pages/login.js') }}"></script>--}}
    <script nonce="{{ Bepsvpt\SecureHeaders\SecureHeaders::nonce() }}">
        $('[data-toggle="tooltip"]').tooltip();
        $(".preloader").fadeOut();
    </script>
@endsection
