@extends('layouts.auth')

@section('title', 'Registro por Convite')

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

                    <h5 class="text-center text-muted font-weight-normal mb-4">Crie a sua conta</h5>
                    @includeIf('errors.errors', [$errors])
                    @include('includes.messages')
                    <!-- Form -->
                    {!! Form::open(['url' => 'invitations', 'class' => 'js-validation-invitation form-horizontal']) !!}
                        {!! Form::hidden('code', $code) !!}
                        <div class="form-group">
                            <label for="username" class="form-label">Nick</label>
                            <input type="text" class="form-control {{ $errors->has('username') ? 'is-invalid' : '' }}" autocomplete="off" id="username" minlength="2" maxlength="25" name="username" placeholder="Nick" required value="{{ old('username') }}">
                            <span class="small {{ $errors->has('username') ? 'invalid-feedback' : '' }}">Alfanumérico e sem espaços ex: NickName123</span>
                            @if($errors->has('username'))
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
                        <button type="submit" class="btn btn-primary btn-block mt-4">Cadastrar-me</button>
                        <div class="text-light small mt-4">
                            <label class="custom-control custom-checkbox m-0">
                                <input type="checkbox" class="custom-control-input" name="terms" id="terms">
                                <span class="custom-control-label">Aceito os <a href="{{ url('terms') }}" target="_blank">Termos de serviço</a> e a <a href="{{ url('privacy') }}" target="_blank">Política de Privacidade</a></span>
                            </label>
                        </div>
                    {!! Form::close() !!}
                    <!-- / Form -->

                </div>
                <div class="card-footer py-3 px-4 px-sm-5">
                    <div class="text-center text-muted">
                        Já possui uma conta? <a href="{{ url('login') }}">Login</a>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- / Content -->

@endsection

@section('scripts')
    <script src="{{ asset('vendor/validate/validate.js') }}"></script>
    <script src="{{ asset('js/pages/invitation.js') }}"></script>
@endsection
