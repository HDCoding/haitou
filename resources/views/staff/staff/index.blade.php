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
                                <span>RefeLoad Average</span>
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
                                <b class="text-{{ $certificate->isValid() ? 'success' : 'warning' }}">
                                    {{ $certificate->isValid() ? 'Válido' : 'Inválido' }}
                                </b>
                            </div>
                            <div class="ml-auto">
                                Emitido por {{ $certificate->getIssuer() }} <br>
                                Expira {{ $certificate->expirationDate()->diffForHumans() }}
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
                        <i class="ion ion-md-time text-xlarge opacity-25"></i>
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
                        <i class="ion ion-md-time text-xlarge opacity-25"></i>
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
                        <i class="ion ion-md-time text-xlarge opacity-25"></i>
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
                        <i class="ion ion-md-time text-xlarge opacity-25"></i>
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
                            {{--                @if(auth()->user()->permission->achievements_mod)--}}
                            <div class="col-md-3 col-lg-3">
                                <a href="{{ url('staff/achievements') }}">
                                    <img src="{{ asset('images/staff/achievements.png') }}" alt="@lang('dashboard.achievements')">
                                </a>
                                <h5 class="mt-2">@lang('dashboard.achievements')</h5>
                            </div>
                            {{--                @endif--}}
                            {{--                @if(auth()->user()->permission->actors_mod)--}}
                            <div class="col-md-3 col-lg-3">
                                <a href="{{ url('staff/actors') }}">
                                    <img src="{{ asset('images/staff/actors.png') }}" alt="@lang('dashboard.actors')">
                                </a>
                                <h5 class="mt-2">@lang('dashboard.actors')</h5>
                            </div>
                            {{--                @endif--}}
                            {{--                @if(auth()->user()->permission->backups_mod)--}}
                            <div class="col-md-3 col-lg-3">
                                <a href="{{ url('staff/backups') }}">
                                    <img src="{{ asset('images/staff/backups.png') }}" alt="@lang('dashboard.backups')">
                                </a>
                                <h5 class="mt-2">@lang('dashboard.backups')</h5>
                            </div>
                            {{--                @endif--}}
                            {{--                @if(auth()->user()->permission->bonus_mod)--}}
                            <div class="col-md-3 col-lg-3">
                                <a href="{{ url('staff/bonus') }}">
                                    <img src="{{ asset('images/staff/bonus.png') }}" alt="@lang('dashboard.bonus')">
                                </a>
                                <h5 class="mt-2">@lang('dashboard.bonus')</h5>
                            </div>
                            {{--                @endif--}}
                            {{--                @if(auth()->user()->permission->calendars_mod)--}}
                            <div class="col-md-3 col-lg-3">
                                <a href="{{ url('staff/calendars') }}">
                                    <img src="{{ asset('images/staff/calendars.png') }}" alt="@lang('dashboard.calendars')">
                                </a>
                                <h5 class="mt-2">@lang('dashboard.calendars')</h5>
                            </div>
                            {{--                @endif--}}
                            {{--                @if(auth()->user()->permission->categories_mod)--}}
                            <div class="col-md-3 col-lg-3">
                                <a href="{{ url('staff/categories') }}">
                                    <img src="{{ asset('images/staff/categories.png') }}" alt="@lang('dashboard.categories')">
                                </a>
                                <h5 class="mt-2">@lang('dashboard.categories')</h5>
                            </div>
                            {{--                @endif--}}
                            {{--                @if(auth()->user()->permission->characters_mod)--}}
                            <div class="col-md-3 col-lg-3">
                                <a href="{{ url('staff/characters') }}">
                                    <img src="{{ asset('images/staff/characters.png') }}" alt="@lang('dashboard.characters')">
                                </a>
                                <h5 class="mt-2">@lang('dashboard.characters')</h5>
                            </div>
                            {{--                @endif--}}
                            {{--                @if(auth()->user()->permission->cheaters_mod)--}}
                            <div class="col-md-3 col-lg-3">
                                <a href="{{ url('staff/cheaters') }}">
                                    <img src="{{ asset('images/staff/cheaters.png') }}" alt="@lang('dashboard.cheaters')">
                                </a>
                                <h5 class="mt-2">@lang('dashboard.cheaters')</h5>
                            </div>
                            {{--                @endif--}}
                            {{--                @if(auth()->user()->permission->commands_mod)--}}
                            <div class="col-md-3 col-lg-3">
                                <a href="{{ url('staff/commands') }}">
                                    <img src="{{ asset('images/staff/commands.png') }}" alt="@lang('dashboard.commands')">
                                </a>
                                <h5 class="mt-2">@lang('dashboard.commands')</h5>
                            </div>
                            {{--                @endif--}}
                            {{--                @if(auth()->user()->permission->failed_logins_mod)--}}
                            <div class="col-md-3 col-lg-3">
                                <a href="{{ url('staff/failedlogins') }}">
                                    <img src="{{ asset('images/staff/failedlogins.png') }}" alt="@lang('dashboard.failedlogins')">
                                </a>
                                <h5 class="mt-2">@lang('dashboard.failedlogins')</h5>
                            </div>
                            {{--                @endif--}}
                            {{--                @if(auth()->user()->permission->fansubs_mod)--}}
                            <div class="col-md-3 col-lg-3">
                                <a href="{{ url('staff/fansubs') }}">
                                    <img src="{{ asset('images/staff/fansubs.png') }}" alt="@lang('dashboard.fansubs')">
                                </a>
                                <h5 class="mt-2">@lang('dashboard.fansubs')</h5>
                            </div>
                            {{--                @endif--}}
                            {{--                @if(auth()->user()->permission->faqs_mod)--}}
                            <div class="col-md-3 col-lg-3">
                                <a href="{{ url('staff/faqs') }}">
                                    <img src="{{ asset('images/staff/faqs.png') }}" alt="@lang('dashboard.faqs')">
                                </a>
                                <h5 class="mt-2">@lang('dashboard.faqs')</h5>
                            </div>
                            {{--                @endif--}}
                            {{--                @if(auth()->user()->permission->forums_mod)--}}
                            <div class="col-md-3 col-lg-3">
                                <a href="{{ url('staff/forums') }}">
                                    <img src="{{ asset('images/staff/forums.png') }}" alt="@lang('dashboard.forums')">
                                </a>
                                <h5 class="mt-2">@lang('dashboard.forums')</h5>
                            </div>
                            {{--                @endif--}}
                            {{--                @if(auth()->user()->permission->genres_mod)--}}
                            <div class="col-md-3 col-lg-3">
                                <a href="{{ url('staff/genres') }}">
                                    <img src="{{ asset('images/staff/genres.png') }}" alt="@lang('dashboard.genres')">
                                </a>
                                <h5 class="mt-2">@lang('dashboard.genres')</h5>
                            </div>
                            {{--                @endif--}}
                            {{--                @if(auth()->user()->permission->roles_mod)--}}
                            <div class="col-md-3 col-lg-3">
                                <a href="{{ url('staff/groups') }}">
                                    <img src="{{ asset('images/staff/groups.png') }}" alt="@lang('dashboard.groups')">
                                </a>
                                <h5 class="mt-2">@lang('dashboard.groups')</h5>
                            </div>
                            {{--                @endif--}}
                            <div class="col-md-3 col-lg-3">
                                <a href="{{ url('staff/icon/fontawesome') }}">
                                    <img src="{{ asset('images/staff/icons.png') }}" alt="@lang('dashboard.icons')">
                                </a>
                                <h5 class="mt-2">@lang('dashboard.icons')</h5>
                            </div>
                            {{--                @if(auth()->user()->permission->logs_mod)--}}
                            <div class="col-md-3 col-lg-3">
                                <a href="{{ url('staff/logs') }}">
                                    <img src="{{ asset('images/staff/logs.png') }}" alt="@lang('dashboard.logs')">
                                </a>
                                <h5 class="mt-2">@lang('dashboard.logs')</h5>
                            </div>
                            {{--                @endif--}}
                            {{--                @if(auth()->user()->permission->lotteries_mod)--}}
                            <div class="col-md-3 col-lg-3">
                                <a href="{{ url('staff/lotteries') }}">
                                    <img src="{{ asset('images/staff/lotteries.png') }}" alt="@lang('dashboard.lotteries')">
                                </a>
                                <h5 class="mt-2">@lang('dashboard.lotteries')</h5>
                            </div>
                            {{--                @endif--}}
                            {{--                @if(auth()->user()->permission->medias_mod)--}}
                            <div class="col-md-3 col-lg-3">
                                <a href="{{ url('staff/medias') }}">
                                    <img src="{{ asset('images/staff/medias.png') }}" alt="@lang('dashboard.medias')">
                                </a>
                                <h5 class="mt-2">@lang('dashboard.medias')</h5>
                            </div>
                            {{--                @endif--}}
                            {{--                @if(auth()->user()->permission->moods_mod)--}}
                            <div class="col-md-3 col-lg-3">
                                <a href="{{ url('staff/moods') }}">
                                    <img src="{{ asset('images/staff/moods.png') }}" alt="@lang('dashboard.moods')">
                                </a>
                                <h5 class="mt-2">@lang('dashboard.moods')</h5>
                            </div>
                            {{--                @endif--}}
                            {{--                @if(auth()->user()->permission->news_mod)--}}
                            <div class="col-md-3 col-lg-3">
                                <a href="{{ url('staff/news') }}">
                                    <img src="{{ asset('images/staff/news.png') }}" alt="@lang('dashboard.news')">
                                </a>
                                <h5 class="mt-2">@lang('dashboard.news')</h5>
                            </div>
                            {{--                @endif--}}
                            {{--                @if(auth()->user()->permission->polls_mod)--}}
                            <div class="col-md-3 col-lg-3">
                                <a href="{{ url('staff/polls') }}">
                                    <img src="{{ asset('images/staff/polls.png') }}" alt="@lang('dashboard.polls')">
                                </a>
                                <h5 class="mt-2">@lang('dashboard.polls')</h5>
                            </div>
                            {{--                @endif--}}
                            {{--                @if(auth()->user()->permission->reports_mod)--}}
                            <div class="col-md-3 col-lg-3">
                                <a href="{{ url('staff/reports') }}">
                                    <img src="{{ asset('images/staff/reports.png') }}" alt="@lang('dashboard.reports')">
                                </a>
                                <h5 class="mt-2">@lang('dashboard.reports')</h5>
                            </div>
                            {{--                @endif--}}
                            {{--                @if(auth()->user()->permission->requests_mod)--}}
                            <div class="col-md-3 col-lg-3">
                                <a href="{{ url('staff/freeslots') }}">
                                    <img src="{{ asset('images/staff/freeslots.png') }}" alt="@lang('dashboard.freeslots')">
                                </a>
                                <h5 class="mt-2">@lang('dashboard.freeslots')</h5>
                            </div>
                            {{--                @endif--}}
                            {{--                @if(auth()->user()->permission->rules_mod)--}}
                            <div class="col-md-3 col-lg-3">
                                <a href="{{ url('staff/rules') }}">
                                    <img src="{{ asset('images/staff/rules.png') }}" alt="@lang('dashboard.rules')">
                                </a>
                                <h5 class="mt-2">@lang('dashboard.rules')</h5>
                            </div>
                            {{--                @endif--}}
                            {{--                @if(auth()->user()->permission->settings_mod)--}}
                            <div class="col-md-3 col-lg-3">
                                <a href="{{ url('staff/settings') }}">
                                    <img src="{{ asset('images/staff/settings.png') }}" alt="@lang('dashboard.settings')">
                                </a>
                                <h5 class="mt-2">@lang('dashboard.settings')</h5>
                            </div>
                            {{--                @endif--}}
                            {{--                @if(auth()->user()->permission->studios_mod)--}}
                            <div class="col-md-3 col-lg-3">
                                <a href="{{ url('staff/studios') }}">
                                    <img src="{{ asset('images/staff/studios.png') }}" alt="@lang('dashboard.studios')">
                                </a>
                                <h5 class="mt-2">@lang('dashboard.studios')</h5>
                            </div>
                            {{--                @endif--}}
                            {{--                @if(auth()->user()->permission->torrents_mod)--}}
                            <div class="col-md-3 col-lg-3">
                                <a href="{{ url('staff/torrents') }}">
                                    <img src="{{ asset('images/staff/torrents.png') }}" alt="@lang('dashboard.torrents')">
                                </a>
                                <h5 class="mt-2">@lang('dashboard.torrents')</h5>
                            </div>
                            {{--                @endif--}}
                            <div class="col-md-3 col-lg-3">
                                <a href="{{ url('staff/traffics') }}">
                                    <img src="{{ asset('images/staff/traffics.png') }}" alt="@lang('dashboard.traffics')">
                                </a>
                                <h5 class="mt-2">@lang('dashboard.traffics')</h5>
                            </div>
                            {{--                @if(auth()->user()->permission->users_mod)--}}
                            <div class="col-md-3 col-lg-3">
                                <a href="{{ url('staff/users') }}">
                                    <img src="{{ asset('images/staff/users.png') }}" alt="@lang('dashboard.users')">
                                </a>
                                <h5 class="mt-2">@lang('dashboard.users')</h5>
                            </div>
                            {{--                @endif--}}
                            {{--                @if(auth()->user()->permission->visitors_mod)--}}
                            <div class="col-md-3 col-lg-3">
                                <a href="{{ url('staff/visitors') }}">
                                    <img src="{{ asset('images/staff/visitors.png') }}" alt="@lang('dashboard.visitors')">
                                </a>
                                <h5 class="mt-2">@lang('dashboard.visitors')</h5>
                            </div>
                            {{--                @endif--}}
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection

@section('scripts')

    <script src="{{ asset('vendor/chartjs/chartjs.js') }}"></script>
    <script nonce="{{ Bepsvpt\SecureHeaders\SecureHeaders::nonce() }}">
        $(document).ready(function() {
            let disk = new Chart(document.getElementById('disk-chart').getContext("2d"), {
                type: 'doughnut',
                data: {
                    datasets: [{
                        data: [{{ round($system->disk()['percentage']) }}, 100],
                        backgroundColor: ['#d9534f', 'rgba(255, 255, 255, .1)'],
                        hoverBackgroundColor: ['#d9534f', 'rgba(255, 255, 255, .1)'],
                        borderWidth: 0
                    }]
                },
                options: {
                    scales: {
                        xAxes: [{
                            display: false,
                        }],
                        yAxes: [{
                            display: false
                        }]
                    },
                    legend: {
                        display: false
                    },
                    tooltips: {
                        enabled: false
                    },
                    cutoutPercentage: 94,
                    responsive: false,
                    maintainAspectRatio: false
                }
            });

            let memory = new Chart(document.getElementById('memory-chart').getContext("2d"), {
                type: 'doughnut',
                data: {
                    datasets: [{
                        data: [{{ round($system->memory()['percentage']) }}, 100],
                        backgroundColor: ['#28c3d7', 'rgba(255, 255, 255, .1)'],
                        hoverBackgroundColor: ['#28c3d7', 'rgba(255, 255, 255, .1)'],
                        borderWidth: 0
                    }]
                },
                options: {
                    scales: {
                        xAxes: [{
                            display: false,
                        }],
                        yAxes: [{
                            display: false
                        }]
                    },
                    legend: {
                        display: false
                    },
                    tooltips: {
                        enabled: false
                    },
                    cutoutPercentage: 94,
                    responsive: false,
                    maintainAspectRatio: false
                }
            });

            // Resizing charts
            function resizeCharts() {
                disk.resize();
                memory.resize();
            }

            // Initial resize
            resizeCharts();
        });
    </script>
@endsection
