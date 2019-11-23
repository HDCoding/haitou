@extends('layouts.dashboard')

@section('subtitle', 'Alterar email')

@section('content')

    <div class="font-weight-bold py-3 h4">
        Alterar email
    </div>

    @includeIf('errors.errors', [$errors])
    {!! Form::model(['url' => 'user/edit/email', 'class' => 'form-horizontal', 'autocomplete' => 'off', 'id' => 'email', 'name' => 'email']) !!}
    <div class="card overflow-hidden">
        <div class="row no-gutters row-bordered row-border-light">
            @include('site.users.list-links')
            <div class="col-md-9">
                <div class="tab-content">

                    <div class="card-body">
                        <div class="form-group mt-4">
                            {!! Form::label('email', 'E-mail') !!}
                            {!! Form::email('email', null, ['class' => 'form-control', 'maxlength' => 70, 'autocomplete' => 'off', 'required']) !!}
                        </div>
                        <h5 class="text-danger">Ao alterar seu e-mail, sua conta será congelada até a confirmação do novo e-mail!!</h5>
                        <br>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div class="text-right mt-3">
        <button type="submit" class="btn btn-primary">Alterar email</button>&nbsp;
        <button type="button" class="btn btn-default">Cancelar</button>
    </div>
    {!! Form::close() !!}

@endsection
