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
                                {!! Form::open(['url' => 'staff/settings/others', 'class' => 'form-horizontal']) !!}
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            {!! Form::label('signup_on', 'Registro aberto?') !!}
                                            {!! Form::select('signup_on', [true => 'Sim', false => 'Não'], setting('signup_on'), ['class' => 'form-control']) !!}
                                        </div>
                                        <div class="form-group">
                                            {!! Form::label('invite_on', 'Convites liberado?') !!}
                                            {!! Form::select('invite_on', [true => 'Sim', false => 'Não'], setting('invite_on'), ['class' => 'form-control']) !!}
                                        </div>
                                        <div class="form-group">
                                            {!! Form::label('forum_on', 'Fórum Online?') !!}
                                            {!! Form::select('forum_on', [true => 'Sim', false => 'Não'], setting('forum_on'), ['class' => 'form-control']) !!}
                                        </div>
                                        <div class="form-group">
                                            {!! Form::label('rnh_on', 'H-N-R Ligado?') !!}
                                            {!! Form::select('rnh_on', [true => 'Sim', false => 'Não'], setting('rnh_on'), ['class' => 'form-control']) !!}
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            {!! Form::label('max_ratio', 'Max. Ratio:') !!}
                                            {!! Form::number('max_ratio', setting('max_ratio'), ['class' => 'form-control', 'step' => 'any']) !!}
                                        </div>
                                        <div class="form-group">
                                            {!! Form::label('min_ratio', 'Min. Ratio:') !!}
                                            {!! Form::number('min_ratio', setting('min_ratio'), ['class' => 'form-control', 'step' => 'any']) !!}
                                        </div>
                                        <div class="form-group">
                                            {!! Form::label('low_ratio', 'Low. Ratio:') !!}
                                            {!! Form::number('low_ratio', setting('low_ratio'), ['class' => 'form-control', 'step' => 'any']) !!}

                                        </div>
                                        <div class="form-group">
                                            {!! Form::label('invitedays', 'Convite limite de dias:') !!}
                                            {!! Form::number('invitedays', setting('invitedays'), ['class' => 'form-control']) !!}
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
