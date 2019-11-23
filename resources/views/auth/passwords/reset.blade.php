@extends('layouts.auth')

@section('title', 'Resetar a senha')

@section('css')
    <!-- Page -->
    <link href="{{ asset('css/pages/authentication.css') }}" rel="stylesheet">
@endsection

@section('content')

    <!-- Content -->

    <div class="authentication-wrapper authentication-2 ui-bg-cover ui-bg-overlay-container px-4" style="background-image: url('{{ asset('images/login-register.jpg') }}');">
        <div class="ui-bg-overlay bg-dark opacity-25"></div>

        <div class="authentication-inner py-5">

            <div class="card">
                <div class="p-4 px-sm-5 pt-sm-5">
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
                    @includeIf('errors.errors', [$errors])
                    @include('includes.messages')
                    <!-- Form -->
                    {!! Form::open(['url' => route('password.update'), 'class' => 'js-validation-reset form-horizontal']) !!}
                    {!! Form::hidden('token', $token) !!}
                    <div class="form-group">
                        <label class="form-label" for="email">Confirme seu e-mail</label>
                        <input id="email" type="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" name="email" value="{{ $email ?? old('email') }}" required autofocus maxlength="70" autocomplete="off">
                        @if($errors->has('email'))
                            <span class="invalid-feedback">Este campo é obrigatório</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="password" class="form-label">Senha</label>
                        <input type="password" class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" autocomplete="off" id="password" minlength="6" maxlength="16" name="password" placeholder="Senha" required>
                        <span class="small {{ $errors->has('password') ? 'invalid-feedback' : '' }}">Mínimo: 6 e Máximo: 16</span>
                        @if($errors->has('password'))
                            <span class="invalid-feedback">Este campo é obrigatório</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="password_confirmation" class="form-label">Repita Senha</label>
                        <input type="password" class="form-control {{ $errors->has('password_confirmation') ? 'is-invalid' : '' }}" autocomplete="off" id="password_confirmation" minlength="6" maxlength="16" name="password_confirmation" placeholder="Repita senha" required>
                        @if($errors->has('password_confirmation'))
                            <span class="invalid-feedback">Este campo é obrigatório</span>
                        @endif
                    </div>
                    <button type="submit" class="btn btn-primary btn-block mt-4">Trocar senha</button>
                    {!! Form::close() !!}
                    <!-- / Form -->
                </div>
            </div>

        </div>
    </div>

    <!-- / Content -->

@endsection

@section('scripts')
    <script src="{{ asset('vendor/validate/validate.js') }}"></script>
    <script src="{{ asset('js/pages/pages_reset_password.js') }}"></script>
@endsection
