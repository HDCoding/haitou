@extends('layouts.application')

@section('subtitle', 'Tela de Bloqueio')

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
                        <span class="db">
                            <img src="{{ auth()->user()->avatar() }}" class="rounded-circle mb-3" width="100" alt="thumbnail">
                        </span>
                        <h5 class="font-medium m-b-20">Tela de Bloqueio</h5>
                    </div>
                    <!-- Form -->
                    <div class="row">
                        <div class="col-12">
                            @includeIf('errors.errors', [$errors])
                            @include('includes.messages')
                            <form class="js-validation-lockscreen form-horizontal m-t-20" method="POST" action="{{ url('unlockscreen') }}">
                                @csrf
                                <div class="form-group row">
                                    <div class="col-12">
                                        <input class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }} form-control-lg" type="password" name="password" required placeholder="Digite sua senha" id="password" minlength="6" maxlength="16" autocomplete="off">
                                        @if ($errors->has('password'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('password') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group text-center">
                                    <div class="col-xs-12 p-b-20">
                                        <button class="btn btn-block btn-lg btn-info" type="submit">Login</button>
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
{{--    <script src="{{ asset('js/pages/lockscreen.js') }}"></script>--}}
    <script>
        $('[data-toggle="tooltip"]').tooltip();
        $(".preloader").fadeOut();
    </script>
@endsection
