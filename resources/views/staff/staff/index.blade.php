@extends('layouts.dashboard')

@section('title', 'Painel Staff')

@section('content')

    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-5 align-self-center">
                <h4 class="page-title">Staff Painel</h4>
            </div>
        </div>
    </div>

    <div class="container-fluid">

        <div class="row">
            <!-- column -->
            <div class="col-sm-12 col-lg-4">
                <div class="card card-hover">
                    <div class="card-body">
                        <div class="d-flex">
                            <div class="m-r-10">
                                <span>Uptime</span>
                                <h4>{{ $system->uptime() }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- column -->
            <div class="col-sm-12 col-lg-4">
                <div class="card card-hover">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="m-r-10">
                                <span>Load Average</span>
                                <h4>{{ $system->avg() }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- column -->
            <div class="col-sm-12 col-lg-4">
                <div class="card card-hover">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="m-r-10">
                                <span>CERTIFICADO SSL</span>
                                @if($certificate != '')
                                    <b class="text-{{ $certificate->isValid() ? 'success' : 'warning' }}">
                                        {{ $certificate->isValid() ? 'Válido' : 'Inválido' }}
                                    </b>
                                @endif
                            </div>
                            <div class="ml-auto">
                                @if($certificate != '')
                                    Emitido por {{ $certificate->getIssuer() }} <br>
                                    Expira {{ $certificate->expirationDate()->diffForHumans() }}
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row m-t-10">
                            <!-- Column -->
                            <div class="col-sm-12 col-md-6 col-lg-3">
                                <div class="d-flex align-items-center">
                                    <div class="m-r-20">
                                        <div data-label="{{ $system->disk()['percentage'] }}%" class="css-bar m-b-0 css-bar-primary css-bar-50"></div>
                                    </div>
                                    <div class="media-body small">
                                        <div class="m-b-1">Total: {{ $system->disk()['total'] }}</div>
                                        <div class="m-b-1">Usando: {{ $system->disk()['used'] }}</div>
                                        <div>Livre: {{ $system->disk()['free'] }}</div>
                                    </div>
                                    <div>
                                        <h3 class="m-b-0">{{ $system->disk()['percentage'] }}%</h3>
                                        <span>DISCO</span>
                                    </div>
                                </div>
                            </div>
                            <!-- Column -->
                            <!-- Column -->
                            <div class="col-sm-12 col-md-6 col-lg-3">
                                <div class="d-flex align-items-center">
                                    <div class="m-r-20">
                                        <div data-label="{{ $system->memory()['percentage'] }}%" class="css-bar m-b-0 css-bar-danger css-bar-30"></div>
                                    </div>
                                    <div class="media-body small">
                                        <div class="font-weight-semibold m-b-3"></div>
                                        <div class="m-b-1">Total: {{ $system->memory()['total'] }}</div>
                                        <div class="m-b-1">Usando: {{ $system->memory()['used'] }}</div>
                                        <div>Livre: {{ $system->memory()['free'] }}</div>
                                    </div>
                                    <div>
                                        <h3 class="m-b-0">{{ $system->memory()['percentage'] }}%</h3>
                                        <span>Memória</span>
                                    </div>
                                </div>
                            </div>
                            <!-- Column -->
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">

            <!-- Information -->
            <div class="col-sm-6 col-xl-3">

                <div class="card bg-info border-0 text-white m-b-4">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div>
                            <div class="text-xlarge">{{ $system->basic()['os'] }}</div>
                            <div class="small opacity-75">Sistema Operacional</div>
                        </div>
                        <i class="fab fa-linux fa-3x"></i>
                    </div>
                </div>

            </div>
            <div class="col-sm-6 col-xl-3">

                <div class="card bg-info border-0 text-white m-b-4">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div>
                            <div class="text-xlarge">{{ $system->basic()['php'] }}</div>
                            <div class="small opacity-75">PHP Versão</div>
                        </div>
                        <i class="fab fa-php fa-3x"></i>
                    </div>
                </div>

            </div>
            <div class="col-sm-6 col-xl-3">

                <div class="card bg-info border-0 text-white m-b-4">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div>
                            <div class="text-xlarge">{{ $system->basic()['database'] }}</div>
                            <div class="small opacity-75">Database</div>
                        </div>
                        <i class="fas fa-database fa-3x"></i>
                    </div>
                </div>

            </div>
            <div class="col-sm-6 col-xl-3">

                <div class="card bg-info border-0 text-white m-b-4">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div>
                            <div class="text-xlarge">{{ $system->basic()['laravel'] }}</div>
                            <div class="small opacity-75">Laravel Versão</div>
                        </div>
                        <i class="fab fa-laravel fa-3x"></i>
                    </div>
                </div>

            </div>

        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">@lang('dashboard.options')</h4>
                        <div class="row text-center">
                            @if(auth()->user()->can('conquistas-mod'))
                                <div class="col-md-3 col-lg-3">
                                    <a href="{{ url('staff/achievements') }}">
                                        <img src="{{ asset('images/staff/achievements.png') }}"
                                             alt="@lang('dashboard.achievements')">
                                    </a>
                                    <h5 class="mt-2">@lang('dashboard.achievements')</h5>
                                </div>
                            @endif
                            @if(auth()->user()->can('atores-mod'))
                                <div class="col-md-3 col-lg-3">
                                    <a href="{{ url('staff/actors') }}">
                                        <img src="{{ asset('images/staff/actors.png') }}"
                                             alt="@lang('dashboard.actors')">
                                    </a>
                                    <h5 class="mt-2">@lang('dashboard.actors')</h5>
                                </div>
                            @endif
                            @if(auth()->user()->can('backups-mod'))
                                <div class="col-md-3 col-lg-3">
                                    <a href="{{ url('staff/backups') }}">
                                        <img src="{{ asset('images/staff/backups.png') }}"
                                             alt="@lang('dashboard.backups')">
                                    </a>
                                    <h5 class="mt-2">@lang('dashboard.backups')</h5>
                                </div>
                            @endif
                            @if(auth()->user()->can('bonus-mod'))
                                <div class="col-md-3 col-lg-3">
                                    <a href="{{ url('staff/bonus') }}">
                                        <img src="{{ asset('images/staff/bonus.png') }}" alt="@lang('dashboard.bonus')">
                                    </a>
                                    <h5 class="mt-2">@lang('dashboard.bonus')</h5>
                                </div>
                            @endif
                            @if(auth()->user()->can('calendarios-mod'))
                                <div class="col-md-3 col-lg-3">
                                    <a href="{{ url('staff/calendars') }}">
                                        <img src="{{ asset('images/staff/calendars.png') }}"
                                             alt="@lang('dashboard.calendars')">
                                    </a>
                                    <h5 class="mt-2">@lang('dashboard.calendars')</h5>
                                </div>
                            @endif
                            @if(auth()->user()->can('categorias-mod'))
                                <div class="col-md-3 col-lg-3">
                                    <a href="{{ url('staff/categories') }}">
                                        <img src="{{ asset('images/staff/categories.png') }}"
                                             alt="@lang('dashboard.categories')">
                                    </a>
                                    <h5 class="mt-2">@lang('dashboard.categories')</h5>
                                </div>
                            @endif
                            @if(auth()->user()->can('personagens-mod'))
                                <div class="col-md-3 col-lg-3">
                                    <a href="{{ url('staff/characters') }}">
                                        <img src="{{ asset('images/staff/characters.png') }}"
                                             alt="@lang('dashboard.characters')">
                                    </a>
                                    <h5 class="mt-2">@lang('dashboard.characters')</h5>
                                </div>
                            @endif
                            @if(auth()->user()->can('cheaters-mod'))
                                <div class="col-md-3 col-lg-3">
                                    <a href="{{ url('staff/cheaters') }}">
                                        <img src="{{ asset('images/staff/cheaters.png') }}"
                                             alt="@lang('dashboard.cheaters')">
                                    </a>
                                    <h5 class="mt-2">@lang('dashboard.cheaters')</h5>
                                </div>
                            @endif
                            @if(auth()->user()->can('comandos-mod'))
                                <div class="col-md-3 col-lg-3">
                                    <a href="{{ url('staff/commands') }}">
                                        <img src="{{ asset('images/staff/commands.png') }}"
                                             alt="@lang('dashboard.commands')">
                                    </a>
                                    <h5 class="mt-2">@lang('dashboard.commands')</h5>
                                </div>
                            @endif
                            @if(auth()->user()->can('falhas-login-mod'))
                                <div class="col-md-3 col-lg-3">
                                    <a href="{{ url('staff/failedlogins') }}">
                                        <img src="{{ asset('images/staff/failedlogins.png') }}"
                                             alt="@lang('dashboard.failedlogins')">
                                    </a>
                                    <h5 class="mt-2">@lang('dashboard.failedlogins')</h5>
                                </div>
                            @endif
                            @if(auth()->user()->can('fansubs-mod'))
                                <div class="col-md-3 col-lg-3">
                                    <a href="{{ url('staff/fansubs') }}">
                                        <img src="{{ asset('images/staff/fansubs.png') }}"
                                             alt="@lang('dashboard.fansubs')">
                                    </a>
                                    <h5 class="mt-2">@lang('dashboard.fansubs')</h5>
                                </div>
                            @endif
                            @if(auth()->user()->can('faq-mod'))
                                <div class="col-md-3 col-lg-3">
                                    <a href="{{ url('staff/faqs') }}">
                                        <img src="{{ asset('images/staff/faqs.png') }}" alt="@lang('dashboard.faqs')">
                                    </a>
                                    <h5 class="mt-2">@lang('dashboard.faqs')</h5>
                                </div>
                            @endif
                            @if(auth()->user()->can('forum-mod'))
                                <div class="col-md-3 col-lg-3">
                                    <a href="{{ url('staff/forums') }}">
                                        <img src="{{ asset('images/staff/forums.png') }}"
                                             alt="@lang('dashboard.forums')">
                                    </a>
                                    <h5 class="mt-2">@lang('dashboard.forums')</h5>
                                </div>
                            @endif
                            @if(auth()->user()->can('generos-mod'))
                                <div class="col-md-3 col-lg-3">
                                    <a href="{{ url('staff/genres') }}">
                                        <img src="{{ asset('images/staff/genres.png') }}"
                                             alt="@lang('dashboard.genres')">
                                    </a>
                                    <h5 class="mt-2">@lang('dashboard.genres')</h5>
                                </div>
                            @endif
                            @if(auth()->user()->can('grupos-mod'))
                                <div class="col-md-3 col-lg-3">
                                    <a href="{{ url('staff/groups') }}">
                                        <img src="{{ asset('images/staff/groups.png') }}"
                                             alt="@lang('dashboard.groups')">
                                    </a>
                                    <h5 class="mt-2">@lang('dashboard.groups')</h5>
                                </div>
                            @endif
                            <div class="col-md-3 col-lg-3">
                                <a href="{{ url('staff/icons/fontawesome') }}">
                                    <img src="{{ asset('images/staff/icons.png') }}" alt="@lang('dashboard.icons')">
                                </a>
                                <h5 class="mt-2">@lang('dashboard.icons')</h5>
                            </div>
                            @if(auth()->user()->can('logs-mod'))
                                <div class="col-md-3 col-lg-3">
                                    <a href="{{ url('staff/logs') }}" target="_blank">
                                        <img src="{{ asset('images/staff/logs.png') }}" alt="@lang('dashboard.logs')">
                                    </a>
                                    <h5 class="mt-2">@lang('dashboard.logs')</h5>
                                </div>
                            @endif
                            @if(auth()->user()->can('sorteios-mod'))
                                <div class="col-md-3 col-lg-3">
                                    <a href="{{ url('staff/lotteries') }}">
                                        <img src="{{ asset('images/staff/lotteries.png') }}"
                                             alt="@lang('dashboard.lotteries')">
                                    </a>
                                    <h5 class="mt-2">@lang('dashboard.lotteries')</h5>
                                </div>
                            @endif
                            @if(auth()->user()->can('midias-mod'))
                                <div class="col-md-3 col-lg-3">
                                    <a href="{{ url('staff/medias') }}">
                                        <img src="{{ asset('images/staff/medias.png') }}"
                                             alt="@lang('dashboard.medias')">
                                    </a>
                                    <h5 class="mt-2">@lang('dashboard.medias')</h5>
                                </div>
                            @endif
                            @if(auth()->user()->can('humor-mod'))
                                <div class="col-md-3 col-lg-3">
                                    <a href="{{ url('staff/moods') }}">
                                        <img src="{{ asset('images/staff/moods.png') }}" alt="@lang('dashboard.moods')">
                                    </a>
                                    <h5 class="mt-2">@lang('dashboard.moods')</h5>
                                </div>
                            @endif
                            @if(auth()->user()->can('noticias-mod'))
                                <div class="col-md-3 col-lg-3">
                                    <a href="{{ url('staff/news') }}">
                                        <img src="{{ asset('images/staff/news.png') }}" alt="@lang('dashboard.news')">
                                    </a>
                                    <h5 class="mt-2">@lang('dashboard.news')</h5>
                                </div>
                            @endif
                            @if(auth()->user()->can('acesso-total'))
                                <div class="col-md-3 col-lg-3">
                                    <a href="{{ url('staff/permissions') }}">
                                        <img src="{{ asset('images/staff/permissions.png') }}" alt="@lang('dashboard.permissions')">
                                    </a>
                                    <h5 class="mt-2">@lang('dashboard.permissions')</h5>
                                </div>
                            @endif
                            @if(auth()->user()->can('pesquisas-mod'))
                                <div class="col-md-3 col-lg-3">
                                    <a href="{{ url('staff/polls') }}">
                                        <img src="{{ asset('images/staff/polls.png') }}" alt="@lang('dashboard.polls')">
                                    </a>
                                    <h5 class="mt-2">@lang('dashboard.polls')</h5>
                                </div>
                            @endif
                            @if(auth()->user()->can('relatorios-mod'))
                                <div class="col-md-3 col-lg-3">
                                    <a href="{{ url('staff/reports') }}">
                                        <img src="{{ asset('images/staff/reports.png') }}"
                                             alt="@lang('dashboard.reports')">
                                    </a>
                                    <h5 class="mt-2">@lang('dashboard.reports')</h5>
                                </div>
                            @endif
                            @if(auth()->user()->can('freeslots-mod'))
                                <div class="col-md-3 col-lg-3">
                                    <a href="{{ url('staff/freeslots') }}">
                                        <img src="{{ asset('images/staff/freeslots.png') }}"
                                             alt="@lang('dashboard.freeslots')">
                                    </a>
                                    <h5 class="mt-2">@lang('dashboard.freeslots')</h5>
                                </div>
                            @endif
                            @if(auth()->user()->can('regras-mod'))
                                <div class="col-md-3 col-lg-3">
                                    <a href="{{ url('staff/rules') }}">
                                        <img src="{{ asset('images/staff/rules.png') }}" alt="@lang('dashboard.rules')">
                                    </a>
                                    <h5 class="mt-2">@lang('dashboard.rules')</h5>
                                </div>
                            @endif
                            @if(auth()->user()->can('configuracoes-mod'))
                                <div class="col-md-3 col-lg-3">
                                    <a href="{{ url('staff/settings/analytics') }}">
                                        <img src="{{ asset('images/staff/settings.png') }}"
                                             alt="@lang('dashboard.settings')">
                                    </a>
                                    <h5 class="mt-2">@lang('dashboard.settings')</h5>
                                </div>
                            @endif
                            @if(auth()->user()->can('estudios-mod'))
                                <div class="col-md-3 col-lg-3">
                                    <a href="{{ url('staff/studios') }}">
                                        <img src="{{ asset('images/staff/studios.png') }}"
                                             alt="@lang('dashboard.studios')">
                                    </a>
                                    <h5 class="mt-2">@lang('dashboard.studios')</h5>
                                </div>
                            @endif
                            @if(auth()->user()->can('torrents-mod'))
                                <div class="col-md-3 col-lg-3">
                                    <a href="{{ url('staff/torrents') }}">
                                        <img src="{{ asset('images/staff/torrents.png') }}"
                                             alt="@lang('dashboard.torrents')">
                                    </a>
                                    <h5 class="mt-2">@lang('dashboard.torrents')</h5>
                                </div>
                            @endif
                            <div class="col-md-3 col-lg-3">
                                <a href="{{ url('staff/traffics') }}">
                                    <img src="{{ asset('images/staff/traffics.png') }}"
                                         alt="@lang('dashboard.traffics')">
                                </a>
                                <h5 class="mt-2">@lang('dashboard.traffics')</h5>
                            </div>
                            @if(auth()->user()->can('usuarios-mod'))
                                <div class="col-md-3 col-lg-3">
                                    <a href="{{ url('staff/users') }}">
                                        <img src="{{ asset('images/staff/users.png') }}" alt="@lang('dashboard.users')">
                                    </a>
                                    <h5 class="mt-2">@lang('dashboard.users')</h5>
                                </div>
                            @endif
                            @if(auth()->user()->can('visitantes-mod'))
                                <div class="col-md-3 col-lg-3">
                                    <a href="{{ url('staff/visitors') }}">
                                        <img src="{{ asset('images/staff/visitors.png') }}"
                                             alt="@lang('dashboard.visitors')">
                                    </a>
                                    <h5 class="mt-2">@lang('dashboard.visitors')</h5>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Permissões de diretório</h4>
                        <div class="table-responsive m-t-15">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th><i class="fas fa-folder-open"></i> Diretório</th>
                                    <th>Atual</th>
                                    <th>Recomendado</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($file_permissions as $permission)
                                    <tr>
                                        <td>{{ $permission['directory'] }}</td>
                                        <td>
                                            @if ($permission['permission'] == $permission['recommended'])
                                                <span class="text-success font-weight-bold">
                                                    <i class="fas fa-check-circle"></i>
                                                    {{ $permission['permission'] }}
                                                </span>
                                            @else
                                                <span class="text-danger font-weight-bold">
                                                    <i class="fas fa-times-circle"></i>
                                                    {{ $permission['permission'] }}
                                                </span>
                                            @endif
                                        </td>
                                        <td>
                                            <span class="text-success font-weight-bold">
                                                {{ $permission['recommended'] }}
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection
