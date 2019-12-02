@extends('layouts.dashboard')

@section('title', 'Tráficos')

@section('content')

    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-5 align-self-center">
                <h4 class="page-title">Staff Painel</h4>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('staff') }}">@lang('dashboard.title')</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Tráficos</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Tráficos</h4>
                        <div class="row">
                            <p class="text-center font-weight-light mb-3">Tráficos da placa de rede</p>
                        </div>
                        <div class="row row-bordered my-4">
                            <div class="col-6 col-sm-4 col-md-3 col-lg-4 col-xl-3">
                                <a href="{{ route('traffic.hourly') }}" class="card card-hover text-body my-2">
                                    <div class="card-body text-center py-5">
                                        <div class="fas fa-clock display-3 text-primary"></div>
                                        <h5 class="m-0 mt-3">Por Hora</h5>
                                    </div>
                                </a>
                            </div>
                            <div class="col-6 col-sm-4 col-md-3 col-lg-4 col-xl-3">
                                <a href="{{ route('traffic.daily') }}" class="card card-hover text-body my-2">
                                    <div class="card-body text-center py-5">
                                        <div class="fas fa-calendar-alt display-3 text-primary"></div>
                                        <h5 class="m-0 mt-3">Diariamente</h5>
                                    </div>
                                </a>
                            </div>
                            <div class="col-6 col-sm-4 col-md-3 col-lg-4 col-xl-3">
                                <a href="{{ route('traffic.monthly') }}" class="card card-hover text-body my-2">
                                    <div class="card-body text-center py-5">
                                        <div class="fas fa-calendar display-3 text-primary"></div>
                                        <h5 class="m-0 mt-3">Mensalmente</h5>
                                    </div>
                                </a>
                            </div>
                            <div class="col-6 col-sm-4 col-md-3 col-lg-4 col-xl-3">
                                <a href="{{ route('traffic.topten') }}" class="card card-hover text-body my-2">
                                    <div class="card-body text-center py-5">
                                        <div class="ion ion-md-trophy display-3 text-primary"></div>
                                        <h5 class="m-0 mt-3">Top 10</h5>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <hr class="container-m-nx border-light my-0">

                        <div class="card mt-5">
                            <h5 class="card-title py-4 px-5">vnStat</h5>
                            <div class="row no-gutters row-bordered">
                                <div class="col-md-6 p-5">
                                    <h6 class="mb-4">Versão:</h6>
                                    <p class="d-block mb-3 text-info">
                                        <i class="ion ion-ios-arrow-forward"></i>&nbsp;
                                        {{ $data['version'] }}
                                    </p>
                                </div>
                                <div class="col-md-6 p-5">
                                    <h6 class="mb-4">JSON Versão:</h6>
                                    <p class="d-block mb-3 text-info">
                                        <i class="ion ion-ios-arrow-forward"></i>&nbsp;
                                        {{ $data['json_version'] }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
