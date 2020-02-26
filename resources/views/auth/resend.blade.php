@extends('layouts.application')

@section('subtitle', 'Re-enviar e-mail')

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
                        <h5 class="font-medium mb-2 mt-4">Não recebeu o email?</h5>
                        <p>Solicite um novo e-mail de ativação</p>
                    </div>
                    <!-- Form -->
                    <div class="row">
                        <div class="col-12">
                            @includeIf('errors.errors', [$errors])
                            @include('includes.messages')
                            <form class="form-horizontal m-t-20" method="POST" action="{{ route('resend.email') }}">
                                @csrf
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1"><i class="ti-user"></i></span>
                                    </div>
                                    <label for="email"></label>
                                    <input type="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }} form-control-lg" autocomplete="off" id="email" maxlength="70" name="email" placeholder="E-mail" required value="{{ old('email') }}">
                                    @if($errors->has('email'))
                                        <span class="invalid-feedback">Este campo é obrigatório</span>
                                    @endif
                                </div>
                                <div class="form-group text-center">
                                    <div class="col-xs-12 p-b-20">
                                        <button class="btn btn-block btn-lg btn-info" type="submit">Re-enviar</button>
                                    </div>
                                </div>
                                <div class="form-group m-b-0 m-t-10">
                                    <div class="col-sm-12 text-center">
                                        Voltar para <a href="{{ url('login') }}">Login</a>
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
    {{--    <script src="{{ asset('vendor/validate/validate.js') }}"></script>--}}
    {{--    <script src="{{ asset('js/pages/email.js') }}"></script>--}}
    <script nonce="{{ Bepsvpt\SecureHeaders\SecureHeaders::nonce() }}">
        $('[data-toggle="tooltip"]').tooltip();
        $(".preloader").fadeOut();
    </script>
@endsection
