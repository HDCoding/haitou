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
                                <label class="switcher">
                                    {!! Form::checkbox('show_achievements', 1, auth()->user()->show_achievements, ['class' => 'switcher-input']) !!}
                                    <span class="switcher-indicator">
                                        <span class="switcher-yes"></span>
                                        <span class="switcher-no"></span>
                                    </span>
                                    <span class="switcher-label">Exibir Consquistas</span>
                                </label>
                            </div>
                            <div class="form-group">
                                <label class="switcher">
                                    {!! Form::checkbox('show_mood', 1, auth()->user()->show_mood, ['class' => 'switcher-input']) !!}
                                    <span class="switcher-indicator">
                                        <span class="switcher-yes"></span>
                                        <span class="switcher-no"></span>
                                    </span>
                                    <span class="switcher-label">Exibir Humor</span>
                                </label>
                            </div>
                            <div class="form-group">
                                <label class="switcher">
                                    {!! Form::checkbox('show_state', 1, auth()->user()->show_state, ['class' => 'switcher-input']) !!}
                                    <span class="switcher-indicator">
                                        <span class="switcher-yes"></span>
                                        <span class="switcher-no"></span>
                                    </span>
                                    <span class="switcher-label">Exibir UF/Estado</span>
                                </label>
                            </div>
                            <div class="form-group">
                                <label class="switcher">
                                    {!! Form::checkbox('show_role', 1, auth()->user()->show_role, ['class' => 'switcher-input']) !!}
                                    <span class="switcher-indicator">
                                        <span class="switcher-yes"></span>
                                        <span class="switcher-no"></span>
                                    </span>
                                    <span class="switcher-label">Exibir Grupo</span>
                                </label>
                            </div>
                            <div class="form-group">
                                <label class="switcher">
                                    {!! Form::checkbox('show_downloaded', 1, auth()->user()->show_downloaded, ['class' => 'switcher-input']) !!}
                                    <span class="switcher-indicator">
                                        <span class="switcher-yes"></span>
                                        <span class="switcher-no"></span>
                                    </span>
                                    <span class="switcher-label">Exibir Donwloaded</span>
                                </label>
                            </div>
                            <div class="form-group">
                                <label class="switcher">
                                    {!! Form::checkbox('show_uploaded', 1, auth()->user()->show_uploaded, ['class' => 'switcher-input']) !!}
                                    <span class="switcher-indicator">
                                        <span class="switcher-yes"></span>
                                        <span class="switcher-no"></span>
                                    </span>
                                    <span class="switcher-label">Exibir Uploaded</span>
                                </label>
                            </div>
                            <hr class="border-light m-0">
                            <h6 class="mb-4 mt-4">Perfil</h6>
                            <div class="form-group">
                                <label class="switcher">
                                    {!! Form::checkbox('show_profile', 1, auth()->user()->show_profile, ['class' => 'switcher-input']) !!}
                                    <span class="switcher-indicator">
                                        <span class="switcher-yes"></span>
                                        <span class="switcher-no"></span>
                                    </span>
                                    <span class="switcher-label">Perfil Privado</span>
                                </label>
                            </div>
                            <div class="form-group">
                                <label class="switcher">
                                    {!! Form::checkbox('show_profile_points', 1, auth()->user()->show_profile_points, ['class' => 'switcher-input']) !!}
                                    <span class="switcher-indicator">
                                        <span class="switcher-yes"></span>
                                        <span class="switcher-no"></span>
                                    </span>
                                    <span class="switcher-label">Exibir perfil pontos</span>
                                </label>
                            </div>
                            <div class="form-group">
                                <label class="switcher">
                                    {!! Form::checkbox('show_profile_level', 1, auth()->user()->show_profile_level, ['class' => 'switcher-input']) !!}
                                    <span class="switcher-indicator">
                                        <span class="switcher-yes"></span>
                                        <span class="switcher-no"></span>
                                    </span>
                                    <span class="switcher-label">Exibir perfil level</span>
                                </label>
                            </div>
                            <div class="form-group">
                                <label class="switcher">
                                    {!! Form::checkbox('show_profile_info', 1, auth()->user()->show_profile_info, ['class' => 'switcher-input']) !!}
                                    <span class="switcher-indicator">
                                        <span class="switcher-yes"></span>
                                        <span class="switcher-no"></span>
                                    </span>
                                    <span class="switcher-label">Exibir perfil info</span>
                                </label>
                            </div>
                            <div class="form-group">
                                <label class="switcher">
                                    {!! Form::checkbox('show_profile_title', 1, auth()->user()->show_profile_title, ['class' => 'switcher-input']) !!}
                                    <span class="switcher-indicator">
                                        <span class="switcher-yes"></span>
                                        <span class="switcher-no"></span>
                                    </span>
                                    <span class="switcher-label">Exibir perfil titulo</span>
                                </label>
                            </div>
                            <div class="form-group">
                                <label class="switcher">
                                    {!! Form::checkbox('show_profile_signature', 1, auth()->user()->show_profile_signature, ['class' => 'switcher-input']) !!}
                                    <span class="switcher-indicator">
                                        <span class="switcher-yes"></span>
                                        <span class="switcher-no"></span>
                                    </span>
                                    <span class="switcher-label">Exibir perfil assinatura</span>
                                </label>
                            </div>
                            <div class="form-group">
                                <label class="switcher">
                                    {!! Form::checkbox('show_profile_birthday', 1, auth()->user()->show_profile_birthday, ['class' => 'switcher-input']) !!}
                                    <span class="switcher-indicator">
                                        <span class="switcher-yes"></span>
                                        <span class="switcher-no"></span>
                                    </span>
                                    <span class="switcher-label">Exibir perfil aniversario</span>
                                </label>
                            </div>
                            <div class="form-group">
                                <label class="switcher">
                                    {!! Form::checkbox('show_profile_social_links', 1, auth()->user()->show_profile_social_links, ['class' => 'switcher-input']) !!}
                                    <span class="switcher-indicator">
                                        <span class="switcher-yes"></span>
                                        <span class="switcher-no"></span>
                                    </span>
                                    <span class="switcher-label">Exibir perfil links sociais</span>
                                </label>
                            </div>
                            <div class="form-group">
                                <label class="switcher">
                                    {!! Form::checkbox('show_profile_friends', 1, auth()->user()->show_profile_friends, ['class' => 'switcher-input']) !!}
                                    <span class="switcher-indicator">
                                        <span class="switcher-yes"></span>
                                        <span class="switcher-no"></span>
                                    </span>
                                    <span class="switcher-label">Exibir perfil amigos</span>
                                </label>
                            </div>
                            <div class="form-group">
                                <label class="switcher">
                                    {!! Form::checkbox('show_profile_warning', 1, auth()->user()->show_profile_warning, ['class' => 'switcher-input']) !!}
                                    <span class="switcher-indicator">
                                        <span class="switcher-yes"></span>
                                        <span class="switcher-no"></span>
                                    </span>
                                    <span class="switcher-label">Exibir perfil icone advertencia</span>
                                </label>
                            </div>
                            <div class="form-group">
                                <label class="switcher">
                                    {!! Form::checkbox('show_forum_signatures', 1, auth()->user()->show_forum_signatures, ['class' => 'switcher-input']) !!}
                                    <span class="switcher-indicator">
                                        <span class="switcher-yes"></span>
                                        <span class="switcher-no"></span>
                                    </span>
                                    <span class="switcher-label">Exibir Forum Assinaturas</span>
                                </label>
                            </div>
                            <button type="submit" class="btn btn-primary">Salvar alterações</button>&nbsp;
                            <button type="button" class="btn btn-default">Cancelar</button>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
