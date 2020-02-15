@extends('layouts.dashboard')

@section('title', trans('dashboard.settings'))

@section('content')

    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-5 align-self-center">
                <h4 class="page-title">Staff Painel</h4>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('staff') }}">@lang('dashboard.title')</a></li>
                            <li class="breadcrumb-item active" aria-current="page">@lang('dashboard.settings')</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">@lang('dashboard.settings')</h4>
                        <h6 class="card-subtitle">Use default tab with class <code>nav-tabs &amp; tabcontent-border </code></h6>
                        @includeIf('errors.errors', [$errors])
                        @include('includes.messages')
                        <div class="row">
                            @include('staff.settings.nav')
                            <div class="col-lg-8 col-xl-9">
                                <div class="row">
                                    <div class="col-md-4">
                                        <p>Index</p>
                                        <img src="{{ asset('images/index-site.png') }}" class="img-thumbnail" width="300" alt="Index" onclick="chooseIndex()"/>
                                        {!! Form::open(['route' => 'setting.image.index', 'files' => true, 'class' => 'form-horizontal', 'id' => 'form-index']) !!}
                                        <input type="file" id="indexInput" name="index" class="form-control" accept="image/png" style="display: none"/>
                                        {!! Form::close() !!}
                                    </div>
                                    <div class="col-md-4">
                                        <p>Login-Register-Lockscreen</p>
                                        <img src="{{ asset('images/login-register.jpg') }}" class="img-thumbnail" width="300" alt="LRL" onclick="chooseLogin()"/>
                                        {!! Form::open(['route' => 'setting.image.login', 'files' => true, 'class' => 'form-horizontal', 'id' => 'form-login']) !!}
                                        <input type="file" id="loginInput" name="login" class="form-control" accept="image/jpeg" style="display: none"/>
                                        {!! Form::close() !!}
                                    </div>
                                    <div class="col-md-4">
                                        <p>Favicon</p>
                                        <img src="{{ asset('images/favicons/favicon-96x96.png') }}" class="img-thumbnail" width="100" alt="Favicon" onclick="chooseFavicon()"/>
                                        {!! Form::open(['route' => 'setting.image.favicon', 'files' => true, 'class' => 'form-horizontal', 'id' => 'form-favicon']) !!}
                                        <input type="file" id="faviconInput" name="favicon" class="form-control" accept="image/png" style="display: none"/>
                                        {!! Form::close() !!}
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script nonce="{{ Bepsvpt\SecureHeaders\SecureHeaders::nonce() }}">
        function chooseIndex() {
            $("#indexInput").click();
        }
        function chooseLogin() {
            $("#loginInput").click();
        }
        function chooseFavicon() {
            $("#faviconInput").click();
        }
        $(document).ready(function () {
            $('#indexInput').on('change', function () {
                $('#form-index').submit();
            });
            $('#loginInput').on('change', function () {
                $('#form-login').submit();
            });
            $('#faviconInput').on('change', function () {
                $('#form-favicon').submit();
            });
        });
    </script>
@endsection
