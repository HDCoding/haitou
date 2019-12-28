@extends('layouts.application')

@section('subtitle', 'Registro')

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
                <div>
                    <div class="logo">
                        <span class="db"><img src="{{ asset('images/favicons/apple-icon-60x60.png') }}" alt="logo" /></span>
                        <h5 class="font-medium m-t-20 m-b-20">Crie a sua conta</h5>
                    </div>
                    <!-- Form -->
                    <div class="row">
                        <div class="col-12">
                            @includeIf('errors.errors', [$errors])
                            @include('includes.messages')
                            @if(setting('signup_on') == true)
                            <form class="js-validation-register form-horizontal m-t-20" method="POST" action="{{ url('register') }}">
                                @csrf
                                <div class="form-group row ">
                                    <div class="col-12">
                                        <label for="username" class="form-label">Nick</label>
                                        <input type="text" class="form-control {{ $errors->has('username') ? 'is-invalid' : '' }} form-control-lg" autocomplete="off" id="username" minlength="2" maxlength="25" name="username" placeholder="Nick" required value="{{ old('username') }}">
                                        <span class="{{ $errors->has('username') ? 'invalid-feedback' : '' }}">Alfanumérico e sem espaços ex: NickName123</span>
                                        @if($errors->has('username'))
                                            <span class="invalid-feedback">Este campo é obrigatório</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-12">
                                        <label for="email" class="form-label">E-mail</label>
                                        <input type="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }} form-control-lg" autocomplete="off" id="email" maxlength="70" name="email" placeholder="E-mail" required value="{{ old('email') }}">
                                        @if($errors->has('email'))
                                            <span class="invalid-feedback">Este campo é obrigatório</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-12">
                                        <label for="password" class="form-label">Senha</label>
                                        <input type="password" class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }} form-control-lg" autocomplete="off" id="password" minlength="6" maxlength="16" name="password" placeholder="Senha" required>
                                        <span class="{{ $errors->has('password') ? 'invalid-feedback' : '' }}">Mínimo: 6 e Máximo: 16</span>
                                        @if($errors->has('password'))
                                            <span class="invalid-feedback">Este campo é obrigatório</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-12 ">
                                        <label for="password_confirmation" class="form-label">Repita Senha</label>
                                        <input type="password" class="form-control {{ $errors->has('password_confirmation') ? 'is-invalid' : '' }} form-control-lg" autocomplete="off" id="password_confirmation" minlength="6" maxlength="16" name="password_confirmation" placeholder="Repita senha" required>
                                        @if($errors->has('password_confirmation'))
                                            <span class="invalid-feedback">Este campo é obrigatório</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" name="terms" id="terms">
                                            <label class="custom-control-label" for="terms">
                                                Aceito os <a href="{{ url('terms') }}" target="_blank">Termos de serviço</a>
                                                e a <a href="{{ url('privacy') }}" target="_blank">Política de Privacidade</a>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group text-center">
                                    <div class="col-xs-12 p-b-20">
                                        <button class="btn btn-block btn-lg btn-info" type="submit">Cadastrar-me</button>
                                    </div>
                                </div>
                                <div class="form-group m-b-0 m-t-10">
                                    <div class="col-sm-12 text-center">
                                        Já possui uma conta? <a class="text-info m-l-5" href="{{ url('login') }}">Login</a>
                                    </div>
                                </div>
                            </form>
                            @else
                                <div class="text-center">
                                    <h3 class="text-danger push-10">Temporariamente fechado para novos registros.</h3>
                                    <p>Caso conheça alguém que seja membro do site, solicite um convite.<br>
                                        Os convites são gratuitos, caso você tenha pago, você foi scammado</p>
                                </div>
                            @endif
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
    <script src="{{ asset('js/pages/register.js') }}"></script>
    <script>
        $('[data-toggle="tooltip"]').tooltip();
        $(".preloader").fadeOut();
    </script>
@endsection
