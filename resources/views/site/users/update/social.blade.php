@extends('layouts.dashboard')

@section('subtitle', 'Social e Info')

@section('content')

    <div class="font-weight-bold py-3 h4">
        Social e Info
    </div>

    @includeIf('errors.errors', [$errors])
    {!! Form::open(['url' => 'user/edit/social', 'class' => 'form-horizontal', 'autocomplete' => 'off', 'id' => 'setting', 'name' => 'setting']) !!}
    <div class="card overflow-hidden">
        <div class="row no-gutters row-bordered row-border-light">
            @include('site.users.list-links')
            <div class="col-md-9">
                <div class="tab-content">

                    <hr class="border-light m-0">

                    <div class="card-body">
                        <div class="form-group">
                            {!! Form::label('facebook', 'Facebook', ['class' => 'form-label']) !!}
                            {!! Form::text('facebook', auth()->user()->user_settings->facebook, ['class' => 'form-control', 'maxlength' => 250]) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('twitter', 'Twitter', ['class' => 'form-label']) !!}
                            {!! Form::text('twitter', auth()->user()->user_settings->twitter, ['class' => 'form-control', 'maxlength' => 250]) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('googleplus', 'Google Plus', ['class' => 'form-label']) !!}
                            {!! Form::text('googleplus', auth()->user()->user_settings->googleplus, ['class' => 'form-control', 'maxlength' => 250]) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('linkedin', 'Linkedin', ['class' => 'form-label']) !!}
                            {!! Form::text('linkedin', auth()->user()->user_settings->linkedin, ['class' => 'form-control', 'maxlength' => 250]) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('instagram', 'Instagram', ['class' => 'form-label']) !!}
                            {!! Form::text('instagram', auth()->user()->user_settings->instagram, ['class' => 'form-control', 'maxlength' => 250]) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('pinterest', 'Pinterest', ['class' => 'form-label']) !!}
                            {!! Form::text('pinterest', auth()->user()->user_settings->pinterest, ['class' => 'form-control', 'maxlength' => 250]) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('torrents_per_page', 'Torrents por pagina', ['class' => 'form-label']) !!}
                            {!! Form::number('torrents_per_page', auth()->user()->user_settings->torrents_per_page, ['class' => 'form-control', 'min' => 10, 'max' => 50]) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('topics_per_page', 'Topicos por pagina', ['class' => 'form-label']) !!}
                            {!! Form::number('topics_per_page', auth()->user()->user_settings->topics_per_page, ['class' => 'form-control', 'min' => 10, 'max' => 50]) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('posts_per_page', 'Posts por pagina', ['class' => 'form-label']) !!}
                            {!! Form::number('posts_per_page', auth()->user()->user_settings->posts_per_page, ['class' => 'form-control', 'min' => 10, 'max' => 50]) !!}
                        </div>
                        <br>
                    </div>
                    <div class="card-body pb-2">
                        <h6 class="mb-4">Notificações</h6>
                        <div class="form-group">
                            <label class="switcher">
                                {!! Form::checkbox('receive_email', 1, auth()->user()->user_settings->receive_email, ['class' => 'switcher-input']) !!}
                                <span class="switcher-indicator">
                                        <span class="switcher-yes"></span>
                                        <span class="switcher-no"></span>
                                    </span>
                                <span class="switcher-label">Receber e-mails</span>
                            </label>
                        </div>
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
