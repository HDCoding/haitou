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
                <div class="card-body p-sm-5">

                    <div class="media align-items-center">
                        <img src="{{ auth()->user()->getAvatar() }}" alt="Avatar" class="d-block ui-w-60 rounded-circle">
                        <div class="media-body ml-3">
                            <div class="text-light small font-weight-semibold line-height-1 mb-1">LOGADO COMO</div>
                            <div class="text-large font-weight-bolder line-height-1">{{ auth()->user()->username }}</div>
                        </div>
                    </div>

                    <hr class="my-4">

                @includeIf('errors.errors', [$errors])
                @include('includes.messages')
                <!-- Form -->
                    {!! Form::open(['url' => 'unlockscreen', 'class' => 'js-validation-lockscreen form-horizontal']) !!}
                    <p class="text-muted small">Por favor, digite sua senha para prosseguir.</p>
                    <div class="input-group">
                        <input class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" type="password" name="password" required placeholder="Digite sua senha" id="password" minlength="6" maxlength="16" autocomplete="off">
                        @if ($errors->has('password'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-success icon-btn">
                                <i class="ion ion-md-arrow-forward"></i>
                            </button>
                        </div>
                    </div>
                {!! Form::close() !!}
                <!-- / Form -->

                </div>
                <div class="card-footer text-center text-muted small px-sm-5">
                    Não é você? <a href="{{ url('login') }}">Faça o login com uma conta diferente</a>
                </div>
            </div>

        </div>
    </div>

    <!-- / Content -->

@endsection

@section('scripts')
    <script src="{{ asset('vendor/validate/validate.js') }}"></script>
    <script src="{{ asset('js/pages/lockscreen.js') }}"></script>
@endsection
