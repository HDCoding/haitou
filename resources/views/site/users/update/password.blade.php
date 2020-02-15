@extends('layouts.dashboard')

@section('title', 'Senha')

@section('content')

    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-5 align-self-center">
                <h4 class="page-title">Home</h4>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('home') }}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Senha</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            @include('site.users.update.card')
            <!-- Column -->
            <div class="col-lg-8 col-xlg-9 col-md-7">
                <div class="card">
                    @include('site.users.update.links')
                    <div class="tab-content">
                        <div class="card-body">
                            <h4 class="card-title">Senha</h4>
                            @includeIf('errors.errors', [$errors])
                            @include('includes.messages')
                            {!! Form::open(['url' => 'user/edit/password', 'class' => 'form-horizontal', 'autocomplete' => 'off']) !!}
                            <div class="form-group">
                                {!! Form::label('senha', 'Senha Atual', ['class' => 'form-label']) !!}
                                {!! Form::password('senha', ['class' => 'form-control', 'minlength' => 6, 'maxlength' => 16, 'required']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('password', 'Nova Senha', ['class' => 'form-label']) !!}
                                {!! Form::password('password', ['class' => 'form-control', 'minlength' => 6, 'maxlength' => 16, 'required']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('password_confirmation', 'Confirmar Senha', ['class' => 'form-label']) !!}
                                {!! Form::password('password_confirmation', ['class' => 'form-control', 'minlength' => 6, 'maxlength' => 16, 'required']) !!}
                            </div>
                            <button type="submit" class="btn btn-primary btn-rounded">Salvar alterações</button>&nbsp;
                            <button type="reset" class="btn btn-default btn-rounded">Cancelar</button>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
