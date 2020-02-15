@extends('layouts.dashboard')

@section('title', 'Editar')

@section('content')

    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-5 align-self-center">
                <h4 class="page-title">Staff Painel</h4>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('staff') }}">@lang('dashboard.title')</a></li>
                            <li class="breadcrumb-item"><a href="{{ url('staff/actors') }}">@lang('dashboard.actors')</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Editar</li>
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
                        <h4 class="card-title">Editar</h4>
                        @includeIf('errors.errors', [$errors])
                        @include('includes.messages')
                        {!! Form::model($actor, ['url' => 'staff/actors/' . $actor->id, 'method' => 'PUT', 'files' => true, 'class' => 'form-horizontal']) !!}
                        @include('staff.actors.form', ['submitButton' => 'Editar'])
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
