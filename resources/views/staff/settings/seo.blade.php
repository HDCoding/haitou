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
                                {!! Form::open(['url' => 'staff/settings/seo', 'class' => 'form-horizontal']) !!}
                                <div class="form-group">
                                    {!! Form::label('site_title', 'Site Título: *') !!}
                                    {!! Form::text('site_title', setting('site_title'), ['class' => 'form-control', 'required']) !!}
                                </div>
                                <div class="form-group">
                                    {!! Form::label('meta_keywords', 'Meta Keywords') !!}
                                    {!! Form::textarea('meta_keywords', setting('meta_keywords'), ['class' => 'form-control', 'rows' => 3]) !!}
                                </div>
                                <div class="form-group">
                                    {!! Form::label('meta_description', 'Meta Descrição') !!}
                                    {!! Form::textarea('meta_description', setting('meta_description'), ['class' => 'form-control', 'rows' => 3]) !!}
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
