@extends('layouts.dashboard')

@section('subtitle', $user->name)

@section('css')
    <!-- Page -->
    <link rel="stylesheet" href="{{ asset('css/pages/users.css') }}">
@endsection

@section('content')

    <div class="media align-items-center py-3 mb-3">
        <img src="{{ $user->getAvatar() }}" alt="avatar" class="d-block ui-w-100 rounded-circle">
        <div class="media-body ml-4">
            <h4 class="font-weight-bold mb-0">{{ $user->name }}</h4>
            <div class="text-muted mb-2">ID: {{ $user->id }}</div>
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-body">
            <table class="table user-view-table m-0">
                <tbody>
                <tr>
                    <td>Registro:</td>
                    <td>{{ $user->created_at->format('d/m/Y') }}</td>
                </tr>
                <tr>
                    <td>Estado:</td>
                    <td>{{ $user->state->name }}</td>
                </tr>
                <tr>
                    <td>Download:</td>
                    <td>{{ $user->getDownloaded() }}</td>
                </tr>
                <tr>
                    <td>Upload:</td>
                    <td>{{ $user->getUploaded() }}</td>
                </tr>
                <tr>
                    <td>Ratio:</td>
                    <td>{{ $user->getRatio() }}</td>
                </tr>
                <tr>
                    <td>Classe:</td>
                    <td>{{ $user->role->name }}</td>
                </tr>
                <tr>
                    <td>Status:</td>
                    <td>{!! $user->getStatus() !!}</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>

    @includeIf('errors.errors', [$errors])
    <div class="nav-tabs-top">
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link" href="{{ url('staff/users/'.$user->id.'/edit') }}">Conta</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="">Permissões</a>
            </li>
        </ul>
        <div class="tab-content">
            {!! Form::open(['url' => 'staff/user/' . $user->id . '/updatepermission']) !!}
            <div class="tab-pane fade show active" id="permissions">
                <div class="card border-primary">
                    <div class="card-header font-weight-bold">Permissões de Membro</div>
                    <table class="table card-table table-striped">
                        <tbody>
                            <tr>
                                <td>Comentar nos Atores</td>
                                <td>
                                    <label class="custom-control custom-checkbox px-2 m-0">
                                        <input type="checkbox" name="actors_comment" class="custom-control-input" value="1" {{ $permission->actors_comment == 1 ? 'checked' : '' }}>
                                        <span class="custom-control-label"></span>
                                    </label>
                                </td>
                            </tr><tr>
                                <td>Criar Calendario</td>
                                <td>
                                    <label class="custom-control custom-checkbox px-2 m-0">
                                        <input type="checkbox" name="calendars_create" class="custom-control-input" value="1" {{ $permission->calendars_create == 1 ? 'checked' : '' }}>
                                        <span class="custom-control-label"></span>
                                    </label>
                                </td>
                            </tr><tr>
                                <td>Comentar nos Calendarios</td>
                                <td>
                                    <label class="custom-control custom-checkbox px-2 m-0">
                                        <input type="checkbox" name="calendars_comment" class="custom-control-input" value="1" {{ $permission->calendars_comment == 1 ? 'checked' : '' }}>
                                        <span class="custom-control-label"></span>
                                    </label>
                                </td>
                            </tr><tr>
                                <td>Comentar nos Personagens</td>
                                <td>
                                    <label class="custom-control custom-checkbox px-2 m-0">
                                        <input type="checkbox" name="characters_comment" class="custom-control-input" value="1" {{ $permission->characters_comment == 1 ? 'checked' : '' }}>
                                        <span class="custom-control-label"></span>
                                    </label>
                                </td>
                            </tr><tr>
                                <td>Visualizar Chatbox</td>
                                <td>
                                    <label class="custom-control custom-checkbox px-2 m-0">
                                        <input type="checkbox" name="chatbox_view" class="custom-control-input" value="1" {{ $permission->chatbox_view == 1 ? 'checked' : '' }}>
                                        <span class="custom-control-label"></span>
                                    </label>
                                </td>
                            </tr><tr>
                                <td>Comentar nos Fansubs</td>
                                <td>
                                    <label class="custom-control custom-checkbox px-2 m-0">
                                        <input type="checkbox" name="fansubs_comment" class="custom-control-input" value="1" {{ $permission->fansubs_comment == 1 ? 'checked' : '' }}>
                                        <span class="custom-control-label"></span>
                                    </label>
                                </td>
                            </tr><tr>
                                <td>Comentar nas Medias</td>
                                <td>
                                    <label class="custom-control custom-checkbox px-2 m-0">
                                        <input type="checkbox" name="medias_comment" class="custom-control-input" value="1" {{ $permission->medias_comment == 1 ? 'checked' : '' }}>
                                        <span class="custom-control-label"></span>
                                    </label>
                                </td>
                            </tr><tr>
                                <td>Comentar nos Estudios</td>
                                <td>
                                    <label class="custom-control custom-checkbox px-2 m-0">
                                        <input type="checkbox" name="studios_comment" class="custom-control-input" value="1" {{ $permission->studios_comment == 1 ? 'checked' : '' }}>
                                        <span class="custom-control-label"></span>
                                    </label>
                                </td>
                            </tr><tr>
                                <td>Comentar nos Torrents</td>
                                <td>
                                    <label class="custom-control custom-checkbox px-2 m-0">
                                        <input type="checkbox" name="torrents_comment" class="custom-control-input" value="1" {{ $permission->torrents_comment == 1 ? 'checked' : '' }}>
                                        <span class="custom-control-label"></span>
                                    </label>
                                </td>
                            </tr><tr>
                                <td>Upload Torrent</td>
                                <td>
                                    <label class="custom-control custom-checkbox px-2 m-0">
                                        <input type="checkbox" name="torrents_upload" class="custom-control-input" value="1" {{ $permission->torrents_upload == 1 ? 'checked' : '' }}>
                                        <span class="custom-control-label"></span>
                                    </label>
                                </td>
                            </tr><tr>
                                <td>Download Torrent</td>
                                <td>
                                    <label class="custom-control custom-checkbox px-2 m-0">
                                        <input type="checkbox" name="torrents_download" class="custom-control-input" value="1" {{ $permission->torrents_download == 1 ? 'checked' : '' }}>
                                        <span class="custom-control-label"></span>
                                    </label>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <hr class="border-dark m-0 mb-5 mt-5">

                <div class="card border-success">
                    <div class="card-header font-weight-bold">Permissões de Staff</div>
                    <table class="table card-table table-striped">
                        <tbody>
                            <tr>
                                <td>Visualizar Painel Staff</td>
                                <td>
                                    <label class="custom-control custom-checkbox px-2 m-0">
                                        <input type="checkbox" name="staff_panel" class="custom-control-input" value="1" {{ $permission->staff_panel == 1 ? 'checked' : '' }}>
                                        <span class="custom-control-label"></span>
                                    </label>
                                </td>
                            </tr>
                            <tr>
                                <td>Acesso Total</td>
                                <td>
                                    <label class="custom-control custom-checkbox px-2 m-0">
                                        <input type="checkbox" name="full_access" class="custom-control-input" value="1" {{ $permission->full_access == 1 ? 'checked' : '' }}>
                                        <span class="custom-control-label"></span>
                                    </label>
                                </td>
                            </tr>
                            <tr>
                                <td>Conquistas Mod</td>
                                <td>
                                    <label class="custom-control custom-checkbox px-2 m-0">
                                        <input type="checkbox" name="achievements_mod" class="custom-control-input" value="1" {{ $permission->achievements_mod == 1 ? 'checked' : '' }}>
                                        <span class="custom-control-label"></span>
                                    </label>
                                </td>
                            </tr>
                            <tr>
                                <td>Atores Mod</td>
                                <td>
                                    <label class="custom-control custom-checkbox px-2 m-0">
                                        <input type="checkbox" name="actors_mod" class="custom-control-input" value="1" {{ $permission->actors_mod == 1 ? 'checked' : '' }}>
                                        <span class="custom-control-label"></span>
                                    </label>
                                </td>
                            </tr>
                            <tr>
                                <td>Backups Mod</td>
                                <td>
                                    <label class="custom-control custom-checkbox px-2 m-0">
                                        <input type="checkbox" name="backups_mod" class="custom-control-input" value="1" {{ $permission->backups_mod == 1 ? 'checked' : '' }}>
                                        <span class="custom-control-label"></span>
                                    </label>
                                </td>
                            </tr>
                            <tr>
                                <td>Bonus Mod</td>
                                <td>
                                    <label class="custom-control custom-checkbox px-2 m-0">
                                        <input type="checkbox" name="bonus_mod" class="custom-control-input" value="1" {{ $permission->bonus_mod == 1 ? 'checked' : '' }}>
                                        <span class="custom-control-label"></span>
                                    </label>
                                </td>
                            </tr><tr>
                                <td>Calendario Mod</td>
                                <td>
                                    <label class="custom-control custom-checkbox px-2 m-0">
                                        <input type="checkbox" name="calendars_mod" class="custom-control-input" value="1" {{ $permission->calendars_mod == 1 ? 'checked' : '' }}>
                                        <span class="custom-control-label"></span>
                                    </label>
                                </td>
                            </tr>
                            <tr>
                                <td>Categorias Mod</td>
                                <td>
                                    <label class="custom-control custom-checkbox px-2 m-0">
                                        <input type="checkbox" name="categories_mod" class="custom-control-input" value="1" {{ $permission->categories_mod == 1 ? 'checked' : '' }}>
                                        <span class="custom-control-label"></span>
                                    </label>
                                </td>
                            </tr>
                            <tr>
                                <td>Personagens Mod</td>
                                <td>
                                    <label class="custom-control custom-checkbox px-2 m-0">
                                        <input type="checkbox" name="characters_mod" class="custom-control-input" value="1" {{ $permission->characters_mod == 1 ? 'checked' : '' }}>
                                        <span class="custom-control-label"></span>
                                    </label>
                                </td>
                            </tr>
                            <tr>
                                <td>Cheaters Mod</td>
                                <td>
                                    <label class="custom-control custom-checkbox px-2 m-0">
                                        <input type="checkbox" name="cheaters_mod" class="custom-control-input" value="1" {{ $permission->cheaters_mod == 1 ? 'checked' : '' }}>
                                        <span class="custom-control-label"></span>
                                    </label>
                                </td>
                            </tr>
                            <tr>
                                <td>Comandos Mod</td>
                                <td>
                                    <label class="custom-control custom-checkbox px-2 m-0">
                                        <input type="checkbox" name="commands_mod" class="custom-control-input" value="1" {{ $permission->commands_mod == 1 ? 'checked' : '' }}>
                                        <span class="custom-control-label"></span>
                                    </label>
                                </td>
                            </tr>
                            <tr>
                                <td>Falhas de Login Mod</td>
                                <td>
                                    <label class="custom-control custom-checkbox px-2 m-0">
                                        <input type="checkbox" name="failed_logins_mod" class="custom-control-input" value="1" {{ $permission->failed_logins_mod == 1 ? 'checked' : '' }}>
                                        <span class="custom-control-label"></span>
                                    </label>
                                </td>
                            </tr>
                            <tr>
                                <td>Fansubs Mod</td>
                                <td>
                                    <label class="custom-control custom-checkbox px-2 m-0">
                                        <input type="checkbox" name="fansubs_mod" class="custom-control-input" value="1" {{ $permission->fansubs_mod == 1 ? 'checked' : '' }}>
                                        <span class="custom-control-label"></span>
                                    </label>
                                </td>
                            </tr>
                            <tr>
                                <td>Faq Mod</td>
                                <td>
                                    <label class="custom-control custom-checkbox px-2 m-0">
                                        <input type="checkbox" name="faqs_mod" class="custom-control-input" value="1" {{ $permission->faqs_mod == 1 ? 'checked' : '' }}>
                                        <span class="custom-control-label"></span>
                                    </label>
                                </td>
                            </tr>
                            <tr>
                                <td>Forum Mod</td>
                                <td>
                                    <label class="custom-control custom-checkbox px-2 m-0">
                                        <input type="checkbox" name="forums_mod" class="custom-control-input" value="1" {{ $permission->forums_mod == 1 ? 'checked' : '' }}>
                                        <span class="custom-control-label"></span>
                                    </label>
                                </td>
                            </tr>
                            <tr>
                                <td>Generos Mod</td>
                                <td>
                                    <label class="custom-control custom-checkbox px-2 m-0">
                                        <input type="checkbox" name="genres_mod" class="custom-control-input" value="1" {{ $permission->genres_mod == 1 ? 'checked' : '' }}>
                                        <span class="custom-control-label"></span>
                                    </label>
                                </td>
                            </tr>
                            <tr>
                                <td>Logs Mod</td>
                                <td>
                                    <label class="custom-control custom-checkbox px-2 m-0">
                                        <input type="checkbox" name="logs_mod" class="custom-control-input" value="1" {{ $permission->logs_mod == 1 ? 'checked' : '' }}>
                                        <span class="custom-control-label"></span>
                                    </label>
                                </td>
                            </tr>
                            <tr>
                                <td>Sorteios Mod</td>
                                <td>
                                    <label class="custom-control custom-checkbox px-2 m-0">
                                        <input type="checkbox" name="lotteries_mod" class="custom-control-input" value="1" {{ $permission->lotteries_mod == 1 ? 'checked' : '' }}>
                                        <span class="custom-control-label"></span>
                                    </label>
                                </td>
                            </tr>
                            <tr>
                                <td>Medias Mod</td>
                                <td>
                                    <label class="custom-control custom-checkbox px-2 m-0">
                                        <input type="checkbox" name="medias_mod" class="custom-control-input" value="1" {{ $permission->medias_mod == 1 ? 'checked' : '' }}>
                                        <span class="custom-control-label"></span>
                                    </label>
                                </td>
                            </tr>
                            <tr>
                                <td>Humor Mod</td>
                                <td>
                                    <label class="custom-control custom-checkbox px-2 m-0">
                                        <input type="checkbox" name="moods_mod" class="custom-control-input" value="1" {{ $permission->moods_mod == 1 ? 'checked' : '' }}>
                                        <span class="custom-control-label"></span>
                                    </label>
                                </td>
                            </tr>
                            <tr>
                                <td>Noticias Mod</td>
                                <td>
                                    <label class="custom-control custom-checkbox px-2 m-0">
                                        <input type="checkbox" name="news_mod" class="custom-control-input" value="1" {{ $permission->news_mod == 1 ? 'checked' : '' }}>
                                        <span class="custom-control-label"></span>
                                    </label>
                                </td>
                            </tr>
                            <tr>
                                <td>Permissoes Mod</td>
                                <td>
                                    <label class="custom-control custom-checkbox px-2 m-0">
                                        <input type="checkbox" name="permissions_mod" class="custom-control-input" value="1" {{ $permission->permissions_mod == 1 ? 'checked' : '' }}>
                                        <span class="custom-control-label"></span>
                                    </label>
                                </td>
                            </tr>
                            <tr>
                                <td>Pesquisas Mod</td>
                                <td>
                                    <label class="custom-control custom-checkbox px-2 m-0">
                                        <input type="checkbox" name="polls_mod" class="custom-control-input" value="1" {{ $permission->polls_mod == 1 ? 'checked' : '' }}>
                                        <span class="custom-control-label"></span>
                                    </label>
                                </td>
                            </tr>
                            <tr>
                                <td>Relatorio Mod</td>
                                <td>
                                    <label class="custom-control custom-checkbox px-2 m-0">
                                        <input type="checkbox" name="reports_mod" class="custom-control-input" value="1" {{ $permission->reports_mod == 1 ? 'checked' : '' }}>
                                        <span class="custom-control-label"></span>
                                    </label>
                                </td>
                            </tr>
                            <tr>
                                <td>Site Points Mod</td>
                                <td>
                                    <label class="custom-control custom-checkbox px-2 m-0">
                                        <input type="checkbox" name="requests_mod" class="custom-control-input" value="1" {{ $permission->requests_mod == 1 ? 'checked' : '' }}>
                                        <span class="custom-control-label"></span>
                                    </label>
                                </td>
                            </tr>
                            <tr>
                                <td>Grupos Mod</td>
                                <td>
                                    <label class="custom-control custom-checkbox px-2 m-0">
                                        <input type="checkbox" name="roles_mod" class="custom-control-input" value="1" {{ $permission->roles_mod == 1 ? 'checked' : '' }}>
                                        <span class="custom-control-label"></span>
                                    </label>
                                </td>
                            </tr>
                            <tr>
                                <td>Regras Mod</td>
                                <td>
                                    <label class="custom-control custom-checkbox px-2 m-0">
                                        <input type="checkbox" name="rules_mod" class="custom-control-input" value="1" {{ $permission->rules_mod == 1 ? 'checked' : '' }}>
                                        <span class="custom-control-label"></span>
                                    </label>
                                </td>
                            </tr>
                            <tr>
                                <td>Configuracoes Mod</td>
                                <td>
                                    <label class="custom-control custom-checkbox px-2 m-0">
                                        <input type="checkbox" name="settings_mod" class="custom-control-input" value="1" {{ $permission->settings_mod == 1 ? 'checked' : '' }}>
                                        <span class="custom-control-label"></span>
                                    </label>
                                </td>
                            </tr>
                            <tr>
                                <td>Estudios Mod</td>
                                <td>
                                    <label class="custom-control custom-checkbox px-2 m-0">
                                        <input type="checkbox" name="studios_mod" class="custom-control-input" value="1" {{ $permission->studios_mod == 1 ? 'checked' : '' }}>
                                        <span class="custom-control-label"></span>
                                    </label>
                                </td>
                            </tr>
                            <tr>
                                <td>Torrents Mod</td>
                                <td>
                                    <label class="custom-control custom-checkbox px-2 m-0">
                                        <input type="checkbox" name="torrents_mod" class="custom-control-input" value="1" {{ $permission->torrents_mod == 1 ? 'checked' : '' }}>
                                        <span class="custom-control-label"></span>
                                    </label>
                                </td>
                            </tr>
                            <tr>
                                <td>Usuarios Mod</td>
                                <td>
                                    <label class="custom-control custom-checkbox px-2 m-0">
                                        <input type="checkbox" name="users_mod" class="custom-control-input" value="1" {{ $permission->users_mod == 1 ? 'checked' : '' }}>
                                        <span class="custom-control-label"></span>
                                    </label>
                                </td>
                            </tr>
                            <tr>
                                <td>Visitantes Mod</td>
                                <td>
                                    <label class="custom-control custom-checkbox px-2 m-0">
                                        <input type="checkbox" name="visitors_mod" class="custom-control-input" value="1" {{ $permission->visitors_mod == 1 ? 'checked' : '' }}>
                                        <span class="custom-control-label"></span>
                                    </label>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            </div>
            <div class="text-right mt-3">
                <button type="submit" class="btn btn-primary">Salvar alterações</button>&nbsp;
                <button type="reset" class="btn btn-default">Cancelar</button>
            </div>
        {!! Form::close() !!}
    </div>

@endsection
