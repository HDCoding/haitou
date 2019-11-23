@extends('layouts.dashboard')

@section('subtitle', 'Privacidade')

@section('content')

    <div class="font-weight-bold py-3 h4">
        Privacidade
    </div>

    @includeIf('errors.errors', [$errors])
    {!! Form::open(['url' => 'user/edit/privacy', 'class' => 'form-horizontal', 'autocomplete' => 'off', 'id' => 'privacy', 'name' => 'privacy']) !!}
    <div class="card overflow-hidden">
        <div class="row no-gutters row-bordered row-border-light">
            @include('site.users.list-links')
            <div class="col-md-9">
                <div class="tab-content">

                    <div class="card-body pb-2">
                        <h6 class="mb-4">Privacidade</h6>

                        <div class="form-group">
                            <label class="switcher">
                                {!! Form::checkbox('show_achievements', 1, auth()->user()->user_privacies->show_achievements, ['class' => 'switcher-input']) !!}
                                <span class="switcher-indicator">
                                        <span class="switcher-yes"></span>
                                        <span class="switcher-no"></span>
                                    </span>
                                <span class="switcher-label">Exibir Consquistas</span>
                            </label>
                        </div>
                        <div class="form-group">
                            <label class="switcher">
                                {!! Form::checkbox('show_mood', 1, auth()->user()->user_privacies->show_mood, ['class' => 'switcher-input']) !!}
                                <span class="switcher-indicator">
                                        <span class="switcher-yes"></span>
                                        <span class="switcher-no"></span>
                                    </span>
                                <span class="switcher-label">Exibir Humor</span>
                            </label>
                        </div>
                        <div class="form-group">
                            <label class="switcher">
                                {!! Form::checkbox('show_state', 1, auth()->user()->user_privacies->show_state, ['class' => 'switcher-input']) !!}
                                <span class="switcher-indicator">
                                        <span class="switcher-yes"></span>
                                        <span class="switcher-no"></span>
                                    </span>
                                <span class="switcher-label">Exibir UF/Estado</span>
                            </label>
                        </div>
                        <div class="form-group">
                            <label class="switcher">
                                {!! Form::checkbox('show_role', 1, auth()->user()->user_privacies->show_role, ['class' => 'switcher-input']) !!}
                                <span class="switcher-indicator">
                                        <span class="switcher-yes"></span>
                                        <span class="switcher-no"></span>
                                    </span>
                                <span class="switcher-label">Exibir Grupo</span>
                            </label>
                        </div>
                        <div class="form-group">
                            <label class="switcher">
                                {!! Form::checkbox('show_downloaded', 1, auth()->user()->user_privacies->show_downloaded, ['class' => 'switcher-input']) !!}
                                <span class="switcher-indicator">
                                        <span class="switcher-yes"></span>
                                        <span class="switcher-no"></span>
                                    </span>
                                <span class="switcher-label">Exibir Donwloaded</span>
                            </label>
                        </div>
                        <div class="form-group">
                            <label class="switcher">
                                {!! Form::checkbox('show_uploaded', 1, auth()->user()->user_privacies->show_uploaded, ['class' => 'switcher-input']) !!}
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
                                {!! Form::checkbox('show_profile', 1, auth()->user()->user_privacies->show_profile, ['class' => 'switcher-input']) !!}
                                <span class="switcher-indicator">
                                        <span class="switcher-yes"></span>
                                        <span class="switcher-no"></span>
                                    </span>
                                <span class="switcher-label">Perfil Privado</span>
                            </label>
                        </div>
                        <div class="form-group">
                            <label class="switcher">
                                {!! Form::checkbox('show_profile_points', 1, auth()->user()->user_privacies->show_profile_points, ['class' => 'switcher-input']) !!}
                                <span class="switcher-indicator">
                                        <span class="switcher-yes"></span>
                                        <span class="switcher-no"></span>
                                    </span>
                                <span class="switcher-label">Exibir perfil pontos</span>
                            </label>
                        </div>
                        <div class="form-group">
                            <label class="switcher">
                                {!! Form::checkbox('show_profile_level', 1, auth()->user()->user_privacies->show_profile_level, ['class' => 'switcher-input']) !!}
                                <span class="switcher-indicator">
                                        <span class="switcher-yes"></span>
                                        <span class="switcher-no"></span>
                                    </span>
                                <span class="switcher-label">Exibir perfil level</span>
                            </label>
                        </div>
                        <div class="form-group">
                            <label class="switcher">
                                {!! Form::checkbox('show_profile_info', 1, auth()->user()->user_privacies->show_profile_info, ['class' => 'switcher-input']) !!}
                                <span class="switcher-indicator">
                                        <span class="switcher-yes"></span>
                                        <span class="switcher-no"></span>
                                    </span>
                                <span class="switcher-label">Exibir perfil info</span>
                            </label>
                        </div>
                        <div class="form-group">
                            <label class="switcher">
                                {!! Form::checkbox('show_profile_title', 1, auth()->user()->user_privacies->show_profile_title, ['class' => 'switcher-input']) !!}
                                <span class="switcher-indicator">
                                        <span class="switcher-yes"></span>
                                        <span class="switcher-no"></span>
                                    </span>
                                <span class="switcher-label">Exibir perfil titulo</span>
                            </label>
                        </div>
                        <div class="form-group">
                            <label class="switcher">
                                {!! Form::checkbox('show_profile_signature', 1, auth()->user()->user_privacies->show_profile_signature, ['class' => 'switcher-input']) !!}
                                <span class="switcher-indicator">
                                        <span class="switcher-yes"></span>
                                        <span class="switcher-no"></span>
                                    </span>
                                <span class="switcher-label">Exibir perfil assinatura</span>
                            </label>
                        </div>
                        <div class="form-group">
                            <label class="switcher">
                                {!! Form::checkbox('show_profile_birthday', 1, auth()->user()->user_privacies->show_profile_birthday, ['class' => 'switcher-input']) !!}
                                <span class="switcher-indicator">
                                        <span class="switcher-yes"></span>
                                        <span class="switcher-no"></span>
                                    </span>
                                <span class="switcher-label">Exibir perfil aniversario</span>
                            </label>
                        </div>
                        <div class="form-group">
                            <label class="switcher">
                                {!! Form::checkbox('show_profile_social_links', 1, auth()->user()->user_privacies->show_profile_social_links, ['class' => 'switcher-input']) !!}
                                <span class="switcher-indicator">
                                        <span class="switcher-yes"></span>
                                        <span class="switcher-no"></span>
                                    </span>
                                <span class="switcher-label">Exibir perfil links sociais</span>
                            </label>
                        </div>
                        <div class="form-group">
                            <label class="switcher">
                                {!! Form::checkbox('show_profile_friends', 1, auth()->user()->user_privacies->show_profile_friends, ['class' => 'switcher-input']) !!}
                                <span class="switcher-indicator">
                                        <span class="switcher-yes"></span>
                                        <span class="switcher-no"></span>
                                    </span>
                                <span class="switcher-label">Exibir perfil amigos</span>
                            </label>
                        </div>
                        <div class="form-group">
                            <label class="switcher">
                                {!! Form::checkbox('show_profile_warning', 1, auth()->user()->user_privacies->show_profile_warning, ['class' => 'switcher-input']) !!}
                                <span class="switcher-indicator">
                                        <span class="switcher-yes"></span>
                                        <span class="switcher-no"></span>
                                    </span>
                                <span class="switcher-label">Exibir perfil icone advertencia</span>
                            </label>
                        </div>
                        <div class="form-group">
                            <label class="switcher">
                                {!! Form::checkbox('show_forum_signatures', 1, auth()->user()->user_privacies->show_forum_signatures, ['class' => 'switcher-input']) !!}
                                <span class="switcher-indicator">
                                        <span class="switcher-yes"></span>
                                        <span class="switcher-no"></span>
                                    </span>
                                <span class="switcher-label">Exibir Forum Assinaturas</span>
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
