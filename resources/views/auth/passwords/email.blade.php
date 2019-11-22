@extends('layouts.auth')

@section('title', 'Esqueceu a senha')

@section('css')
    <!-- Page -->
    <link href="{{ secure_asset('css/pages/authentication.css') }}" rel="stylesheet">
@endsection

@section('content')

    <!-- Content -->

    <div class="authentication-wrapper authentication-2 ui-bg-cover ui-bg-overlay-container px-4" style="background-image: url('{{ asset('images/login-register.jpg') }}');">
        <div class="authentication-inner py-5">
            @includeIf('errors.errors', [$errors])
            @include('includes.messages')
            <!-- Form -->
            {!! Form::open(['url' => route('password.email'), 'class' => 'js-validation-forget-password card']) !!}
            <div class="p-4 p-sm-5">
                <!-- Logo -->
                <div class="d-flex justify-content-center align-items-center pb-2 mb-4">
                    <div class="ui-w-60">
                        <div class="w-100 position-relative">
                            <img src="{{ asset('images/favicons/apple-icon-60x60.png') }}" alt="Logo">
                        </div>
                    </div>
                </div>
                <!-- / Logo -->

                <h5 class="text-center text-muted font-weight-normal mb-4">Redefinir sua senha</h5>

                <hr class="mt-0 mb-4">

                <p>Digite seu endereço de e-mail e nós lhe enviaremos um link para redefinir sua senha.</p>

                <div class="form-group">
                    <label for="email" class="form-label">E-mail</label>
                    <input id="email" type="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" name="email" value="{{ old('email') }}" required maxlength="70" autocomplete="off">
                    @if($errors->has('email'))
                        <span class="invalid-feedback">Este campo é obrigatório</span>
                    @endif
                </div>

                <button type="submit" class="btn btn-primary btn-block">Resetar</button>

                <div class="card-footer py-3 px-4 px-sm-5">
                    <div class="text-center text-muted">
                        Lembrou sua senha? <a href="{{ url('login') }}">Login</a>
                    </div>
                </div>
            </div>
            {!! Form::close() !!}
            <!-- / Form -->

        </div>
    </div>

    <!-- / Content -->

@endsection

@section('scripts')
    <script src="{{ secure_asset('vendor/validate/validate.js') }}"></script>
    <script src="{{ secure_asset('js/pages/email.js') }}"></script>
@endsection
