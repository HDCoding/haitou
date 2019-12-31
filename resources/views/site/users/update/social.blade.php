@extends('layouts.dashboard')

@section('title', 'Social e Info')

@section('content')

    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-5 align-self-center">
                <h4 class="page-title">Home</h4>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('home') }}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Social e Info</li>
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
                            <h4 class="card-title">Social e Info</h4>
                            @includeIf('errors.errors', [$errors])
                            {!! Form::open(['url' => 'user/edit/social', 'class' => 'form-horizontal', 'autocomplete' => 'off']) !!}
                            <div class="form-group">
                                {!! Form::label('facebook', 'Facebook', ['class' => 'form-label']) !!}
                                {!! Form::text('facebook', auth()->user()->facebook, ['class' => 'form-control', 'maxlength' => 250]) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('twitter', 'Twitter', ['class' => 'form-label']) !!}
                                {!! Form::text('twitter', auth()->user()->twitter, ['class' => 'form-control', 'maxlength' => 250]) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('linkedin', 'Linkedin', ['class' => 'form-label']) !!}
                                {!! Form::text('linkedin', auth()->user()->linkedin, ['class' => 'form-control', 'maxlength' => 250]) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('instagram', 'Instagram', ['class' => 'form-label']) !!}
                                {!! Form::text('instagram', auth()->user()->instagram, ['class' => 'form-control', 'maxlength' => 250]) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('pinterest', 'Pinterest', ['class' => 'form-label']) !!}
                                {!! Form::text('pinterest', auth()->user()->pinterest, ['class' => 'form-control', 'maxlength' => 250]) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('torrents_per_page', 'Torrents por pagina', ['class' => 'form-label']) !!}
                                {!! Form::number('torrents_per_page', auth()->user()->torrents_per_page, ['class' => 'form-control', 'min' => 10, 'max' => 50]) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('topics_per_page', 'Topicos por pagina', ['class' => 'form-label']) !!}
                                {!! Form::number('topics_per_page', auth()->user()->topics_per_page, ['class' => 'form-control', 'min' => 10, 'max' => 50]) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('posts_per_page', 'Posts por pagina', ['class' => 'form-label']) !!}
                                {!! Form::number('posts_per_page', auth()->user()->posts_per_page, ['class' => 'form-control', 'min' => 10, 'max' => 50]) !!}
                            </div>
                            <hr class="border-light m-0">
                            <h6 class="mt-4">Notificações</h6>
                            <div class="form-group">
                                <label class="custom-control custom-checkbox form-check-inline" for="receive_email">
                                    {!! Form::checkbox('receive_email', 1, auth()->user()->receive_email, ['class' => 'custom-control-input', 'id' => 'receive_email']) !!}
                                    <span class="custom-control-label">Receber e-mails</span>
                                </label>
                            </div>
                            <div class="mt-5">
                                <button type="submit" class="btn btn-primary btn-rounded">Salvar alterações</button>&nbsp;
                                <button type="reset" class="btn btn-default btn-rounded">Cancelar</button>
                            </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
