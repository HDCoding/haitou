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
                        <div class="row">
                            @include('staff.settings.nav')
                            <div class="col-lg-8 col-xl-9">
                                @includeIf('errors.errors', [$errors])
                                {!! Form::open(['url' => 'staff/settings/mail', 'class' => 'form-horizontal']) !!}
                                <div class="form-group">
                                    {!! Form::label('mail_driver', 'Mail driver: *') !!}
                                    {!! Form::text('mail_driver', setting('mail_driver'), ['class' => 'form-control']) !!}
                                </div>
                                <div class="form-group">
                                    {!! Form::label('mail_host', 'Mail host: *') !!}
                                    {!! Form::text('mail_host', setting('mail_host'), ['class' => 'form-control']) !!}
                                </div>
                                <div class="form-group">
                                    {!! Form::label('mail_port', 'Mail porta: *') !!}
                                    {!! Form::number('mail_port', setting('mail_port'), ['class' => 'form-control']) !!}
                                </div>
                                <div class="form-group">
                                    {!! Form::label('mail_username', 'Mail usuario: *') !!}
                                    {!! Form::email('mail_username', setting('mail_username'), ['class' => 'form-control']) !!}
                                </div>
                                <div class="form-group">
                                    <label for="mail_password">Mail Senha: *</label>
                                    <input class="form-control" name="mail_password" type="password" id="mail_password" value="*******">
                                </div>
                                <div class="form-group">
                                    {!! Form::label('mail_encryption', 'Mail tls: *') !!}
                                    {!! Form::text('mail_encryption', setting('mail_encryption'), ['class' => 'form-control']) !!}
                                </div>
                                {!! Form::submit('Atualizar', ['class' => 'btn btn-success btn-rounded']) !!}
                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
