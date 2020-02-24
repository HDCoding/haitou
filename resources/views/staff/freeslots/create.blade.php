@extends('layouts.dashboard')

@section('title', 'Adicionar')

@section('content')

    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-5 align-self-center">
                <h4 class="page-title">Staff Painel</h4>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('staff') }}">@lang('dashboard.title')</a></li>
                            <li class="breadcrumb-item"><a href="{{ url('staff/freeslots') }}">@lang('dashboard.freeslots')</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Adicionar</li>
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
                        <h4 class="card-title">Adicionar</h4>
                        <div class="col-xs-12 push-15">
                            <div class="push-5">
                                <div class="pull-right">2.000.000.000 &bullet;</div>
                                <strong>Limite Máximo Total</strong>
                            </div>
                            <div class="progress" style="height: 6px;">
                                <div class="progress-bar bg-success" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%"></div>
                            </div>
                        </div>
                        {!! Form::open(['url' => ['staff/freeslots'], 'class' => 'form-horizontal']) !!}
                        <div class="form-group">
                            <label class="form-label">Título</label>
                            {!! Form::text('name', null, ['class' => 'form-control', 'required', 'maxlength' => 250]) !!}
                        </div>

                        <div class="form-group">
                            <label class="form-label">Necessário</label>
                            {!! Form::number('required', null, ['class' => 'form-control', 'required', 'min' => 1000, 'max' => 2000000000]) !!}
                        </div>
                        <div class="col-xs-12 push-15">
                            <div class="push-5">
                                <div class="pull-right">125 &bullet;</div>
                                <strong>Limite Máximo de Dias</strong>
                            </div>
                            <div class="progress" style="height: 6px;">
                                <div class="progress-bar bg-primary" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Dias</label>
                            {!! Form::number('days', null, ['class' => 'form-control', 'required', 'min' => 1, 'max' => 125]) !!}
                        </div>
                        <div class="col-xs-12 push-15">
                            <div class="push-5">
                                <strong>Opções</strong>
                            </div>
                            <div class="progress" style="height: 6px;">
                                <div class="progress-bar bg-google" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%"></div>
                            </div>
                        </div>
                        <div class="form-group form-inline row mt-2">
                            <label class="custom-control custom-checkbox ml-3 mr-5">
                                {!! Form::checkbox('is_freeleech', 1, null, ['class' => 'custom-control-input']) !!}
                                <span class="custom-control-label">Freeleech</span>
                            </label>
                            <label class="custom-control custom-checkbox mr-5">
                                {!! Form::checkbox('is_silver', 1, null, ['class' => 'custom-control-input']) !!}
                                <span class="custom-control-label">Silver</span>
                            </label>
                            <label class="custom-control custom-checkbox">
                                {!! Form::checkbox('is_doubleup', 1, null, ['class' => 'custom-control-input']) !!}
                                <span class="custom-control-label">Double UP</span>
                            </label>
                        </div>
                        {!! Form::submit('Cadastrar', ['class' => 'btn btn-success btn-rounded mt-4']) !!}
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
