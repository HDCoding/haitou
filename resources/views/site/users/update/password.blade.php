@extends('layouts.dashboard')

@section('subtitle', 'Alterar senha')

@section('content')

    <div class="font-weight-bold py-3 h4">
        Alterar senha
    </div>

    @includeIf('errors.errors', [$errors])
    {!! Form::open(['url' => 'user/edit/password', 'class' => 'form-horizontal', 'autocomplete' => 'off', 'id' => 'password', 'name' => 'password']) !!}
    <div class="card overflow-hidden">
        <div class="row no-gutters row-bordered row-border-light">
            @include('site.users.list-links')
            <div class="col-md-9">
                <div class="tab-content">

                    <div class="card-body">
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
                        <br>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div class="text-right mt-3">
        <button type="submit" class="btn btn-primary">Salvar alterações</button>&nbsp;
        <button type="button" class="btn btn-default">Cancelar</button>
    </div>
    {!! Form::close() !!}

@endsection
