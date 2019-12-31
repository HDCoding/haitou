@extends('layouts.dashboard')

@section('title', 'Privacidade')

@section('content')

    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-5 align-self-center">
                <h4 class="page-title">Home</h4>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('home') }}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Privacidade</li>
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
                            <h6 class="mb-4">Privacidade</h6>
                            @includeIf('errors.errors', [$errors])
                            {!! Form::open(['url' => 'user/edit/privacy', 'class' => 'form-horizontal', 'autocomplete' => 'off', 'id' => 'privacy', 'name' => 'privacy']) !!}
                            <div class="form-group">
                                <label class="custom-control custom-checkbox form-check-inline" for="show_achievements">
                                    {!! Form::checkbox('show_achievements', 1, auth()->user()->show_achievements, ['class' => 'custom-control-input', 'id' => 'show_achievements']) !!}
                                    <span class="custom-control-label">Exibir Consquistas</span>
                                </label>
                            </div>
                            <div class="form-group">
                                <label class="custom-control custom-checkbox form-check-inline" for="show_mood">
                                    {!! Form::checkbox('show_mood', 1, auth()->user()->show_mood, ['class' => 'custom-control-input', 'id' => 'show_mood']) !!}
                                    <span class="custom-control-label">Exibir Humor</span>
                                </label>
                            </div>
                            <div class="form-group">
                                <label class="custom-control custom-checkbox form-check-inline" for="show_state">
                                    {!! Form::checkbox('show_state', 1, auth()->user()->show_state, ['class' => 'custom-control-input', 'id' => 'show_state']) !!}
                                    <span class="custom-control-label">Exibir UF</span>
                                </label>
                            </div>
                            <div class="form-group">
                                <label class="custom-control custom-checkbox form-check-inline" for="show_group">
                                    {!! Form::checkbox('show_group', 1, auth()->user()->show_group, ['class' => 'custom-control-input', 'id' => 'show_group']) !!}
                                    <span class="custom-control-label">Exibir Grupo</span>
                                </label>
                            </div>
                            <div class="form-group">
                                <label class="custom-control custom-checkbox form-check-inline" for="show_downloaded">
                                    {!! Form::checkbox('show_downloaded', 1, auth()->user()->show_downloaded, ['class' => 'custom-control-input', 'id' => 'show_downloaded']) !!}
                                    <span class="custom-control-label">Exibir Donwloaded</span>
                                </label>
                            </div>
                            <div class="form-group">
                                <label class="custom-control custom-checkbox form-check-inline" for="show_uploaded">
                                    {!! Form::checkbox('show_uploaded', 1, auth()->user()->show_uploaded, ['class' => 'custom-control-input', 'id' => 'show_uploaded']) !!}
                                    <span class="custom-control-label">Exibir Uploaded</span>
                                </label>
                            </div>
                            <hr class="border-light m-0">
                            <h6 class="mb-4 mt-4">Perfil</h6>
                            <div class="form-group">
                                <label class="custom-control custom-checkbox form-check-inline" for="show_profile">
                                    {!! Form::checkbox('show_profile', 1, auth()->user()->show_profile, ['class' => 'custom-control-input', 'id' => 'show_profile']) !!}
                                    <span class="custom-control-label">Perfil Privado</span>
                                </label>
                            </div>
                            <div class="form-group">
                                <label class="custom-control custom-checkbox form-check-inline" for="show_profile_points">
                                    {!! Form::checkbox('show_profile_points', 1, auth()->user()->show_profile_points, ['class' => 'custom-control-input', 'id' => 'show_profile_points']) !!}
                                    <span class="custom-control-label">Exibir pontos</span>
                                </label>
                            </div>
                            <div class="form-group">
                                <label class="custom-control custom-checkbox form-check-inline" for="show_profile_level">
                                    {!! Form::checkbox('show_profile_level', 1, auth()->user()->show_profile_level, ['class' => 'custom-control-input', 'id' => 'show_profile_level']) !!}
                                    <span class="custom-control-label">Exibir level</span>
                                </label>
                            </div>
                            <div class="form-group">
                                <label class="custom-control custom-checkbox form-check-inline" for="show_profile_info">
                                    {!! Form::checkbox('show_profile_info', 1, auth()->user()->show_profile_info, ['class' => 'custom-control-input', 'id' => 'show_profile_info']) !!}
                                    <span class="custom-control-label">Exibir info</span>
                                </label>
                            </div>
                            <div class="form-group">
                                <label class="custom-control custom-checkbox form-check-inline" for="show_profile_title">
                                    {!! Form::checkbox('show_profile_title', 1, auth()->user()->show_profile_title, ['class' => 'custom-control-input', 'id' => 'show_profile_title']) !!}
                                    <span class="custom-control-label">Exibir titulo</span>
                                </label>
                            </div>
                            <div class="form-group">
                                <label class="custom-control custom-checkbox form-check-inline" for="show_profile_signature">
                                    {!! Form::checkbox('show_profile_signature', 1, auth()->user()->show_profile_signature, ['class' => 'custom-control-input', 'id' => 'show_profile_signature']) !!}
                                    <span class="custom-control-label">Exibir assinatura</span>
                                </label>
                            </div>
                            <div class="form-group">
                                <label class="custom-control custom-checkbox form-check-inline" for="show_profile_birthday">
                                    {!! Form::checkbox('show_profile_birthday', 1, auth()->user()->show_profile_birthday, ['class' => 'custom-control-input', 'id' => 'show_profile_birthday']) !!}
                                    <span class="custom-control-label">Exibir aniversario</span>
                                </label>
                            </div>
                            <div class="form-group">
                                <label class="custom-control custom-checkbox form-check-inline" for="show_profile_social_links">
                                    {!! Form::checkbox('show_profile_social_links', 1, auth()->user()->show_profile_social_links, ['class' => 'custom-control-input', 'id' => 'show_profile_social_links']) !!}
                                    <span class="custom-control-label">Exibir links sociais</span>
                                </label>
                            </div>
                            <div class="form-group">
                                <label class="custom-control custom-checkbox form-check-inline" for="show_profile_warning">
                                    {!! Form::checkbox('show_profile_warning', 1, auth()->user()->show_profile_warning, ['class' => 'custom-control-input', 'id' => 'show_profile_warning']) !!}
                                    <span class="custom-control-label">Exibir advertencia</span>
                                </label>
                            </div>
                            <div class="form-group">
                                <label class="custom-control custom-checkbox form-check-inline" for="show_forum_signatures">
                                    {!! Form::checkbox('show_forum_signatures', 1, auth()->user()->show_forum_signatures, ['class' => 'custom-control-input', 'id' => 'show_forum_signatures']) !!}
                                    <span class="custom-control-label">Exibir Forum Assinaturas</span>
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
