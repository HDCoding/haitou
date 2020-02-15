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
                        <h6 class="card-subtitle text-center">
                            <b class="text-danger">OBS:</b>
                            <strong>Min:</strong> 1 Ponto - <strong>Max:</strong> 250 Pontos
                        </h6>
                        @includeIf('errors.errors', [$errors])
                        @include('includes.messages')
                        <div class="row">
                            @include('staff.settings.nav')
                            <div class="col-lg-8 col-xl-9">
                                {!! Form::open(['url' => 'staff/settings/points', 'class' => 'form-horizontal']) !!}
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            {!! Form::label('points_signup', 'Registrar-se:') !!}
                                            {!! Form::number('points_signup', setting('points_signup'), ['class' => 'form-control', 'required']) !!}
                                        </div>
                                        <div class="form-group">
                                            {!! Form::label('points_invite', 'Convidar:') !!}
                                            {!! Form::number('points_invite', setting('points_invite'), ['class' => 'form-control', 'required']) !!}
                                        </div>
                                        <div class="form-group">
                                            {!! Form::label('points_download', 'Download:') !!}
                                            {!! Form::number('points_download', setting('points_download'), ['class' => 'form-control', 'required']) !!}
                                        </div>
                                        <div class="form-group">
                                            {!! Form::label('points_comment', 'Comentar:') !!}
                                            {!! Form::number('points_comment', setting('points_comment'), ['class' => 'form-control', 'required']) !!}
                                        </div>
                                        <div class="form-group">
                                            {!! Form::label('points_upload', 'Upload:') !!}
                                            {!! Form::number('points_upload', setting('points_upload'), ['class' => 'form-control', 'required']) !!}
                                        </div>
                                        <div class="form-group">
                                            {!! Form::label('points_rating', 'Votar:') !!}
                                            {!! Form::number('points_rating', setting('points_rating'), ['class' => 'form-control', 'required']) !!}
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            {!! Form::label('points_topic', 'Novo Tópico:') !!}
                                            {!! Form::number('points_topic', setting('points_topic'), ['class' => 'form-control', 'required']) !!}
                                        </div>
                                        <div class="form-group">
                                            {!! Form::label('points_post', 'Postar:') !!}
                                            {!! Form::number('points_post', setting('points_post'), ['class' => 'form-control', 'required']) !!}
                                        </div>
                                        <div class="form-group">
                                            {!! Form::label('points_delete', 'Deletar:') !!}
                                            {!! Form::number('points_delete', setting('points_delete'), ['class' => 'form-control', 'required']) !!}
                                        </div>
                                        <div class="form-group">
                                            {!! Form::label('points_thanks', 'Agradecer:') !!}
                                            {!! Form::number('points_thanks', setting('points_thanks'), ['class' => 'form-control', 'required']) !!}
                                        </div>
                                        <div class="form-group">
                                            {!! Form::label('points_report', 'Reportar:') !!}
                                            {!! Form::number('points_report', setting('points_report'), ['class' => 'form-control', 'required']) !!}
                                        </div>
                                        <div class="form-group">
                                            {!! Form::label('points_calendar', 'Calendário:') !!}
                                            {!! Form::number('points_calendar', setting('points_calendar'), ['class' => 'form-control', 'required']) !!}
                                        </div>
                                    </div>
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
