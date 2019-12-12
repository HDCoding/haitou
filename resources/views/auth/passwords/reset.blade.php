@extends('layouts.application')

@section('subtitle', 'Resetar a senha')

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
                            {!! Form::open(['url' => route('password.update'), 'class' => 'js-validation-reset form-horizontal']) !!}
                            {!! Form::hidden('token', $token) !!}
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1"><i class="ti-user"></i></span>
                                    </div>
                                    <input id="email" type="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }} form-control-lg" name="email" value="{{ $email ?: old('email') }}" required autofocus maxlength="70" autocomplete="off">
                                    @if($errors->has('email'))
                                        <span class="invalid-feedback">Este campo é obrigatório</span>
                                    @endif
                                </div>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon2"><i class="ti-pencil"></i></span>
                                    </div>
                                    <input type="password" class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }} form-control-lg" autocomplete="off" id="password" minlength="6" maxlength="16" name="password" placeholder="Senha" required>
                                    <span class="small {{ $errors->has('password') ? 'invalid-feedback' : '' }}">Mínimo: 6 e Máximo: 16</span>
                                    @if($errors->has('password'))
                                        <span class="invalid-feedback">Este campo é obrigatório</span>
                                    @endif
                                </div>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon2"><i class="ti-pencil"></i></span>
                                    </div>
                                    <input type="password" class="form-control {{ $errors->has('password_confirmation') ? 'is-invalid' : '' }} form-control-lg" autocomplete="off" id="password_confirmation" minlength="6" maxlength="16" name="password_confirmation" placeholder="Repita senha" required>
                                    @if($errors->has('password_confirmation'))
                                        <span class="invalid-feedback">Este campo é obrigatório</span>
                                    @endif
                                </div>
                                <div class="form-group text-center">
                                    <div class="col-xs-12 p-b-20">
                                        <button class="btn btn-block btn-lg btn-info" type="submit">Trocar senha</button>
                                    </div>
                                </div>
                            {!! Form::close() !!}
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
    <script src="{{ asset('js/pages/pages_reset_password.js') }}"></script>
    <script>
        $('[data-toggle="tooltip"]').tooltip();
        $(".preloader").fadeOut();
    </script>
@endsection
