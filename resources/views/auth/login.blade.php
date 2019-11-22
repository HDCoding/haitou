@extends('layouts.auth')

@section('title', 'Login')

@section('styles')
    <!-- Page -->
    <link href="{{ asset('css/pages/authentication.css') }}" rel="stylesheet">
@endsection

@section('content')

    <!-- Content -->

    <div class="authentication-wrapper authentication-2 ui-bg-cover ui-bg-overlay-container px-4" style="background-image: url('{{ asset('images/login-register.jpg') }}');">
        <div class="ui-bg-overlay bg-dark opacity-25"></div>

        <div class="authentication-inner py-5">

            <div class="card">
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

                    <h5 class="text-center text-muted font-weight-normal mb-4">Faça login na sua conta</h5>
                    @includeIf('errors.errors', [$errors])
                    @include('includes.messages')
                    <!-- Form -->
                    <form class="js-validation-login form-horizontal" method="POST" action="{{ url('login') }}">
                        @csrf
                        <div class="form-group">
                            <label for="email" class="form-label">E-mail</label>
                            <input type="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" autocomplete="off" id="email" maxlength="70" name="email" placeholder="E-mail" required value="{{ old('email') }}">
                            @if($errors->has('email'))
                                <span class="invalid-feedback">Este campo é obrigatório</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="password" class="form-label d-flex justify-content-between align-items-end">
                                Senha
                                <a href="javascript:void(0)" class="d-block small">Esqueceu a senha?</a>
                            </label>
                            <input type="password" class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" autocomplete="off" id="password" minlength="6" maxlength="16" name="password" placeholder="Senha" required>
                            @if($errors->has('password'))
                                <span class="invalid-feedback">Este campo é obrigatório</span>
                            @endif
                        </div>
                        <div class="d-flex justify-content-between align-items-center m-0">
                            <label class="custom-control custom-checkbox m-0">
                                <input type="checkbox" class="custom-control-input" name="remember" {{ old('remember') ? 'checked' : '' }}>
                                <span class="custom-control-label">Lembrar-me</span>
                            </label>
                            <button type="submit" class="btn btn-primary">Entrar</button>
                        </div>
                    </form>
                    <!-- / Form -->

                </div>
                <div class="card-footer py-3 px-4 px-sm-5">
                    <div class="text-center text-muted">
                        Não tem uma conta ainda? <a href="{{ url('register') }}">Registre-se</a>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- / Content -->

@endsection

@section('scripts')
    <script src="{{ asset('vendor/validate/validate.js') }}"></script>
    <script src="{{ asset('js/pages/login.js') }}"></script>
@endsection
