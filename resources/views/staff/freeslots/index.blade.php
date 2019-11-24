@extends('layouts.dashboard')

@section('subtitle', trans('dashboard.freeslots'))

@section('content')


    <div class="font-weight-bold py-3 h4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ url('staff') }}">@lang('dashboard.title')</a>
            </li>
            <li class="breadcrumb-item active">@lang('dashboard.freeslots')</li>
        </ol>
    </div>

    <hr class="container-m-nx border-light mt-0 mb-5">

    <div class="card mb-4">
        <div class="card-header with-elements">
            <span class="card-header-title mr-2">@lang('dashboard.freeslots')</span>
            <div class="card-header-elements ml-md-auto">
{{--                @if($freeslots->is_enabled)--}}
                    {!! Form::open(['url' => 'staff/freeslots/enableDisable']) !!}
                    <button type="submit" class="btn btn-xs btn-outline-danger">
                        <span class="ion ion-md-arrow-down"></span> Desativar
                    </button>
                    {!! Form::close() !!}
{{--                @else--}}
                    {!! Form::open(['url' => 'staff/freeslots/enableDisable']) !!}
                    <button type="submit" class="btn btn-xs btn-outline-primary">
                        <span class="ion ion-md-arrow-up"></span> Ativar
                    </button>
                    {!! Form::close() !!}
{{--                @endif--}}
            </div>
        </div>
        <div class="card-body">
            @includeIf('errors.errors', [$errors])
{{--            @if($request->is_enabled)--}}
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
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label class="form-label">Necessário</label>
                        {!! Form::number('required', null, ['class' => 'form-control', 'required', 'min' => 1000, 'max' => 2000000000]) !!}
                    </div>
                    <div class="form-group col-md-6">
                        <label class="form-label">Atual</label>
                        {!! Form::number('actual', null, ['class' => 'form-control', 'disabled' => 'disabled']) !!}
                    </div>
                </div>
                <hr>
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
                {{--<div class="col-sm-2">--}}
                    <label class="custom-control custom-checkbox ml-3 mr-5">
                        {!! Form::checkbox('is_freeleech', 1, null, ['class' => 'custom-control-input']) !!}
                        <span class="custom-control-label">Freeleech?</span>
                    </label>
                    <label class="custom-control custom-checkbox mr-5">
                        {!! Form::checkbox('is_silver', 1, null, ['class' => 'custom-control-input']) !!}
                        <span class="custom-control-label">Silver?</span>
                    </label>
                    <label class="custom-control custom-checkbox">
                        {!! Form::checkbox('is_doubleup', 1, null, ['class' => 'custom-control-input']) !!}
                        <span class="custom-control-label">Double UP?</span>
                    </label>
                {{--</div>--}}
                </div>

                {!! Form::submit('Atualizar', ['class' => 'btn btn-success btn-rounded btn-outline mt-4']) !!}
                {!! Form::close() !!}
{{--            @else--}}
                <p class="text-center"><b>Desativado no momento.</b></p>
{{--            @endif--}}
        </div>
    </div>

@endsection
