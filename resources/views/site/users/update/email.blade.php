@extends('layouts.dashboard')

@section('title', 'E-mail')

@section('content')

    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-5 align-self-center">
                <h4 class="page-title">Home</h4>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('home') }}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">E-mail</li>
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
                            <h4 class="card-title">E-mail</h4>
                            @includeIf('errors.errors', [$errors])
                            {!! Form::model(['url' => 'user/edit/email', 'class' => 'form-horizontal', 'autocomplete' => 'off']) !!}
                            <div class="form-group mt-4">
                                {!! Form::label('email', 'E-mail') !!}
                                {!! Form::email('email', null, ['class' => 'form-control', 'maxlength' => 70, 'autocomplete' => 'off', 'required']) !!}
                            </div>
                            <h5 class="text-danger m-t-10">Ao alterar seu e-mail, sua conta será congelada até a confirmação do novo e-mail!!</h5>
                            <button type="submit" class="btn btn-primary">Alterar email</button>&nbsp;
                            <button type="reset" class="btn btn-default">Cancelar</button>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
