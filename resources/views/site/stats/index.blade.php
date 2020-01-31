@extends('layouts.dashboard')

@section('title', 'Estatísticas')

@section('content')

    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-5 align-self-center">
                <h4 class="page-title">Home</h4>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('home') }}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Estatísticas</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <!-- Column -->
            <div class="col-lg-3 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h1 class="m-t-0"><i class="fa fa-users text-info"></i></h1>
                        <a class="h3 text-info" href="{{ route('stats.uploaded') }}">Usuários</a>
                    </div>
                </div>
            </div>
            <!-- Column -->
            <!-- Column -->
            <div class="col-lg-3 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h1 class="m-t-0"><i class="fa fa-file text-primary"></i></h1>
                        <a class="h3 text-primary" href="{{ route('stats.seeded') }}">Torrents</a>
                    </div>
                </div>
            </div>
            <!-- Column -->
            <!-- Column -->
            <div class="col-lg-3 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h1 class="m-t-0"><i class="fa fa-user-astronaut text-success"></i></h1>
                        <a class="h3 text-success" href="{{ route('stats.groups') }}">Grupos</a>
                    </div>
                </div>
            </div>
            <!-- Column -->
        </div>
        <hr>
        <div class="row">
            <div class="col-lg-3 col-md-6">
                <div class="card border-left border-orange">
                    <div class="card-body">
                        <div class="d-flex no-block align-items-center">
                            <div>
                                <span class="text-orange display-6"><i class="ti-user"></i></span>
                            </div>
                            <div class="ml-auto">
                                <h2>{{ $total_users }}</h2>
                                <h6 class="text-orange">Total Contas</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="card border-left border-info">
                    <div class="card-body">
                        <div class="d-flex no-block align-items-center">
                            <div>
                                <span class="text-info display-6"><i class="fa fa-user-clock"></i></span>
                            </div>
                            <div class="ml-auto">
                                <h2>{{ $pending_user }}</h2>
                                <h6 class="text-info">Pendentes Ativação</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="card border-left border-cyan">
                    <div class="card-body">
                        <div class="d-flex no-block align-items-center">
                            <div>
                                <span class="text-cyan display-6"><i class="fa fa-user-check"></i></span>
                            </div>
                            <div class="ml-auto">
                                <h2>{{ $activated_user }}</h2>
                                <h6 class="text-cyan">Contas Ativadas</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="card border-left border-success">
                    <div class="card-body">
                        <div class="d-flex no-block align-items-center">
                            <div>
                                <span class="text-success display-6"><i class="fa fa-user-lock"></i></span>
                            </div>
                            <div class="ml-auto">
                                <h2>{{ $suspended_user }}</h2>
                                <h6 class="text-success">Contas Suspensas</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-lg-3 col-md-6">
                <div class="card border-bottom border-danger">
                    <div class="card-body">
                        <div class="d-flex no-block align-items-center">
                            <div>
                                <h2>{{ $banned_user }}</h2>
                                <h6 class="text-danger">Contas Banidas</h6>
                            </div>
                            <div class="ml-auto">
                                <span class="text-danger display-6"><i class="fa fa-user-alt-slash"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="card border-bottom border-info">
                    <div class="card-body">
                        <div class="d-flex no-block align-items-center">
                            <div>
                                <h2>{{ $total_torrents }}</h2>
                                <h6 class="text-info">Total Torrents</h6>
                            </div>
                            <div class="ml-auto">
                                <span class="text-info display-6"><i class="fa fa-file"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="card border-bottom border-cyan">
                    <div class="card-body">
                        <div class="d-flex no-block align-items-center">
                            <div>
                                <h2>{{ make_size($torrent_size) }}</h2>
                                <h6 class="text-cyan">Tamanho total de torrents</h6>
                            </div>
                            <div class="ml-auto">
                                <span class="text-cyan display-6"><i class="ti-clipboard"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="card border-bottom border-success">
                    <div class="card-body">
                        <div class="d-flex no-block align-items-center">
                            <div>
                                <h2>{{ $num_seeders }}</h2>
                                <h6 class="text-success">Seeders</h6>
                            </div>
                            <div class="ml-auto">
                                <span class="text-success display-6"><i class="fas fa-chart-line"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-lg-3 col-md-6">
                <div class="card border-right border-orange">
                    <div class="card-body">
                        <div class="d-flex no-block align-items-center">
                            <div>
                                <span class="text-orange display-6"><i class="ti-stats-down"></i></span>
                            </div>
                            <div class="ml-auto">
                                <h2>{{ $num_leechers }}</h2>
                                <h6 class="text-orange">Leechers</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="card border-right border-dark">
                    <div class="card-body">
                        <div class="d-flex no-block align-items-center">
                            <div>
                                <span class="text-dark display-6"><i class="ti-layout-slider-alt"></i></span>
                            </div>
                            <div class="ml-auto">
                                <h2>{{ $num_peers }}</h2>
                                <h6 class="text-dark">Peers</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="card border-right border-info">
                    <div class="card-body">
                        <div class="d-flex no-block align-items-center">
                            <div>
                                <span class="text-info display-6"><i class="ti-pie-chart"></i></span>
                            </div>
                            <div class="ml-auto">
                                <h2>{{ make_size($real_upload) }}</h2>
                                <h6 class="text-info">Real Uploaded</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="card border-right border-cyan">
                    <div class="card-body">
                        <div class="d-flex no-block align-items-center">
                            <div>
                                <span class="text-cyan display-6"><i class="ti-panel"></i></span>
                            </div>
                            <div class="ml-auto">
                                <h2>{{ make_size($real_download) }}</h2>
                                <h6 class="text-cyan">Real Downloaded</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-lg-3 col-md-6">
                <div class="card border-top border-success">
                    <div class="card-body">
                        <div class="d-flex no-block align-items-center">
                            <div>
                                <h2>{{ make_size($actual_up_down) }}</h2>
                                <h6 class="text-success">Real Tráfego total</h6>
                            </div>
                            <div class="ml-auto">
                                <span class="text-success display-6"><i class="ti-layers-alt"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="card border-top border-success">
                    <div class="card-body">
                        <div class="d-flex no-block align-items-center">
                            <div>
                                <h2>{{ make_size($credited_upload) }}</h2>
                                <h6 class="text-success">Credited Total Upload</h6>
                            </div>
                            <div class="ml-auto">
                                <span class="text-success display-6"><i class="ti-map-alt"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="card border-top border-dark">
                    <div class="card-body">
                        <div class="d-flex no-block align-items-center">
                            <div>
                                <h2>{{ make_size($credited_download) }}</h2>
                                <h6 class="text-dark">Credited Total Download</h6>
                            </div>
                            <div class="ml-auto">
                                <span class="text-dark display-6"><i class="ti-check-box"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="card border-top border-info">
                    <div class="card-body">
                        <div class="d-flex no-block align-items-center">
                            <div>
                                <h2>{{ make_size($credited_up_down) }}</h2>
                                <h6 class="text-info">Credited Total Traffic</h6>
                            </div>
                            <div class="ml-auto">
                                <span class="text-info display-6"><i class="ti-bar-chart-alt"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-lg-3 col-md-6">
                <div class="card border-left border-orange">
                    <div class="card-body">
                        <div class="d-flex no-block align-items-center">
                            <div>
                                <span class="text-orange display-6"><i class="ti-user"></i></span>
                            </div>
                            <div class="ml-auto">
                                <h2>{{ $total_comments }}</h2>
                                <h6 class="text-orange">Total Comentários</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="card border-left border-info">
                    <div class="card-body">
                        <div class="d-flex no-block align-items-center">
                            <div>
                                <span class="text-info display-6"><i class="fa fa-user-clock"></i></span>
                            </div>
                            <div class="ml-auto">
                                <h2>{{ $total_cheaters }}</h2>
                                <h6 class="text-info">Total Cheaters</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="card border-left border-cyan">
                    <div class="card-body">
                        <div class="d-flex no-block align-items-center">
                            <div>
                                <span class="text-cyan display-6"><i class="fa fa-user-check"></i></span>
                            </div>
                            <div class="ml-auto">
                                <h2>{{ $invitations }}</h2>
                                <h6 class="text-cyan">Convites Aceitos</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="card border-left border-success">
                    <div class="card-body">
                        <div class="d-flex no-block align-items-center">
                            <div>
                                <span class="text-success display-6"><i class="fa fa-user-lock"></i></span>
                            </div>
                            <div class="ml-auto">
                                <h2>{{ $total_reports }}</h2>
                                <h6 class="text-success">Total Reports</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-lg-3 col-md-6">
                <div class="card border-bottom border-success">
                    <div class="card-body">
                        <div class="d-flex no-block align-items-center">
                            <div>
                                <h2>{{ $reports_solved }}</h2>
                                <h6 class="text-success">Reports Resolvidos</h6>
                            </div>
                            <div class="ml-auto">
                                <span class="text-danger display-6"><i class="fa fa-user-alt-slash"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="card border-bottom border-info">
                    <div class="card-body">
                        <div class="d-flex no-block align-items-center">
                            <div>
                                <h2>{{ $torrent_completes }}</h2>
                                <h6 class="text-info">Torrents Baixados</h6>
                            </div>
                            <div class="ml-auto">
                                <span class="text-info display-6"><i class="fa fa-file"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="card border-bottom border-cyan">
                    <div class="card-body">
                        <div class="d-flex no-block align-items-center">
                            <div>
                                <h2>{{ $total_thanks }}</h2>
                                <h6 class="text-cyan">Total de Agradecimentos</h6>
                            </div>
                            <div class="ml-auto">
                                <span class="text-cyan display-6"><i class="ti-clipboard"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection
