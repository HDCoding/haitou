@extends('layouts.dashboard')

@section('subtitle', 'Painel Staff')

@section('content')

    <!-- Head block -->
    <div class="container-m-nx container-m-ny bg-white container-p-x py-5 mb-0">

        <div class="d-flex justify-content-between align-items-center mb-5">
            <div>
                <h2 class="font-weight-light mb-2">Uptime</h2>
                <div class="badge badge-success font-weight-bold">{{ $system->uptime() }}</div>
            </div>
            <div class="text-center font-weight-bold py-3">
                <p>{{ day_month_year() }}</p>
                <p class="text-light mt-2"><b class="text-dark">System Time:</b> {{ $system->system_time() }}</p>
            </div>
            <div class="d-flex align-items-center">
                <div class="ml-3">
                    <div class="text-muted small">Load Average</div>
                    <div class="text-large">{{ $system->avg() }}</div>
                </div>
            </div>
        </div>

        <!-- Stats -->
        <div class="row">
            <div class="col-sm-6 col-md-4 col-lg-6 col-xl-4">

                <div class="border-light ui-bordered p-3 mt-2">
                    <div class="media align-items-center">
                        <div class="media-body small mr-3">
                            <div class="font-weight-semibold mb-3">CERTIFICADO SSL</div>
                            <div class="mb-1">
                                <b class="text-{{ $certificate->isValid() ? 'success' : 'warning' }}">
                                    {{ $certificate->isValid() ? 'Válido' : 'Inválido' }}
                                </b>
                            </div>
                            <div class="mb-1 text-danger">
                                Emitido por {{ $certificate->getIssuer() }}
                            </div>
                            <div class="text-info">
                                Expira {{ $certificate->expirationDate()->diffForHumans() }}
                            </div>
                        </div>
                        <div class="d-flex align-items-center position-relative" style="height:60px;width: 60px;">
                            <div class="w-100 position-absolute" style="height:60px;top:0;">
                                <div class="fas fa-lock fa-3x text-warning"></div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-sm-6 col-md-4 col-lg-6 col-xl-4">

                <div class="border-light ui-bordered p-3 mt-2">
                    <div class="media align-items-center">
                        <div class="media-body small mr-3">
                            <div class="font-weight-semibold mb-3">DISCO</div>
                            <div class="mb-1">Total: {{ $system->disk()['total'] }}</div>
                            <div class="mb-1">Usando: {{ $system->disk()['used'] }}</div>
                            <div>Livre: {{ $system->disk()['free'] }}</div>
                        </div>
                        <div class="d-flex align-items-center position-relative" style="height:60px;width: 60px;">
                            <div class="w-100 position-absolute" style="height:60px;top:0;">
                                <canvas id="disk-chart"></canvas>
                            </div>
                            <div class="w-100 text-center font-weight-bold">{{ $system->disk()['percentage'] }}%</div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-sm-6 col-md-4 col-lg-6 col-xl-4">

                <div class="border-light ui-bordered p-3 mt-2">
                    <div class="media align-items-center">
                        <div class="media-body small mr-3">
                            <div class="font-weight-semibold mb-3">MEMORIA</div>
                            <div class="mb-1">Total: {{ $system->memory()['total'] }}</div>
                            <div class="mb-1">Usando: {{ $system->memory()['used'] }}</div>
                            <div>Livre: {{ $system->memory()['free'] }}</div>
                        </div>
                        <div class="d-flex align-items-center position-relative" style="height:60px;width: 60px;">
                            <div class="w-100 position-absolute" style="height:60px;top:0;">
                                <canvas id="memory-chart"></canvas>
                            </div>
                            <div class="w-100 text-center font-weight-bold">{{ $system->memory()['percentage'] }}%</div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <!-- / Stats -->

    </div>
    <!-- / Head block -->

    <hr class="container-m-nx border-light mt-0 mb-4">

    <div class="row">

        <!-- Information -->
        <div class="col-sm-6 col-xl-3">

            <div class="card bg-info border-0 text-white mb-4">
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

            <div class="card bg-info border-0 text-white mb-4">
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

            <div class="card bg-info border-0 text-white mb-4">
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

            <div class="card bg-info border-0 text-white mb-4">
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

    <hr class="container-m-nx border-light mt-0 mb-4">

    <!-- Counters -->
    <div class="row">
        <div class="col-sm-6 col-xl-3">
            <div class="card mb-4">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="fas fa-user-check fa-3x text-success"></div>
                        <div class="ml-3">
                            <div class="text-muted small">@lang('dashboard.acc_activated')</div>
                            <div class="text-large">{{ $activated }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="card mb-4">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="fas fa-user-alt-slash fa-3x text-danger"></div>
                        <div class="ml-3">
                            <div class="text-muted small">@lang('dashboard.acc_banneds')</div>
                            <div class="text-large">{{ $banned }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="card mb-4">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="fas fa-user-clock fa-3x text-info"></div>
                        <div class="ml-3">
                            <div class="text-muted small">@lang('dashboard.pending_activation')</div>
                            <div class="text-large">{{ $pendent }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="card mb-4">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="fas fa-user-lock fa-3x text-warning"></div>
                        <div class="ml-3">
                            <div class="text-muted small">@lang('dashboard.suspended_accounts')</div>
                            <div class="text-large">{{ $suspended }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- / Counters -->

    <div class="card mb-4">
        <!-- Add `.with-elements` to the parent `.card-header` element -->
        <div class="card-header with-elements">
            <span class="card-header-subtitle mr-2">@lang('dashboard.options')</span>
        </div>
        <div class="card-body">
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
{{--                @if(auth()->user()->permission->roles_mod)--}}
                    <div class="col-md-3 col-lg-3">
                        <a href="{{ url('staff/groups') }}">
                            <img src="{{ asset('images/staff/groups.png') }}" alt="@lang('dashboard.groups')">
                        </a>
                        <h5 class="mt-2">@lang('dashboard.groups')</h5>
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

@endsection

@section('script')

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
