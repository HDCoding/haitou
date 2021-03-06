@extends('layouts.dashboard')

@section('title', trans('dashboard.commands'))

@section('content')

    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-5 align-self-center">
                <h4 class="page-title">Staff Painel</h4>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('staff') }}">@lang('dashboard.title')</a></li>
                            <li class="breadcrumb-item active" aria-current="page">@lang('dashboard.commands')</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6 col-xl-4">
                <div class="card text-center m-b-3">
                    <div class="card-body">
                        <h4 class="card-title text-success">
                            <i class="fa fa-terminal"></i> Ativar modo de manutenção
                        </h4>
                        <p class="card-text">Esses comandos ativam o modo de manutenção enquanto na lista de permissões apenas o seu endereço IP.</p>
                        <a href="{{ url('staff/commands/maintance-enable') }}" class="btn btn-primary">Executar Comando</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-4">
                <div class="card text-center m-b-3">
                    <div class="card-body">
                        <h4 class="card-title text-success">
                            <i class="fa fa-terminal"></i> Desativar modo de manutenção
                        </h4>
                        <p class="card-text">Este comando desativa o modo de manutenção. Trazendo o backup do site para todos acessarem.</p>
                        <a href="{{ url('staff/commands/maintance-disable') }}" class="btn btn-primary">Executar Comando</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-4">
                <div class="card text-center m-b-3">
                    <div class="card-body">
                        <h4 class="card-title text-success">
                            <i class="fa fa-terminal"></i> Limpar cache
                        </h4>
                        <p class="card-text">Este comando limpa o cache do seu site.</p>
                        <a href="{{ url('staff/commands/clear-cache') }}" class="btn btn-primary">Executar Comando</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 col-xl-4">
                <div class="card text-center m-b-3">
                    <div class="card-body">
                        <h4 class="card-title text-success">
                            <i class="fa fa-terminal"></i> Limpar cache de exibição
                        </h4>
                        <p class="card-text">Este comando limpa o cache de visualizações compiladas dos sites.</p>
                        <a href="{{ url('staff/commands/clear-view-cache') }}" class="btn btn-primary">Executar Comando</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-4">
                <div class="card text-center m-b-3">
                    <div class="card-body">
                        <h4 class="card-title text-success">
                            <i class="fa fa-terminal"></i> Limpar cache de rota
                        </h4>
                        <p class="card-text">Este comando limpa o cache de rotas compiladas dos sites.</p>
                        <a href="{{ url('staff/commands/clear-route-cache') }}" class="btn btn-primary">Executar Comando</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-4">
                <div class="card text-center m-b-3">
                    <div class="card-body">
                        <h4 class="card-title text-success">
                            <i class="fa fa-terminal"></i> Limpar cache de configuração
                        </h4>
                        <p class="card-text">Este comando limpa o cache de configurações compiladas dos seus sites.</p>
                        <a href="{{ url('staff/commands/clear-config-cache') }}" class="btn btn-primary">Executar Comando</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 col-xl-4">
                <div class="card text-center m-b-3">
                    <div class="card-body">
                        <h4 class="card-title text-success">
                            <i class="fa fa-terminal"></i> Limpar todo o cache
                        </h4>
                        <p class="card-text">Este comando limpa TODO o cache do seu site.</p>
                        <a href="{{ url('staff/commands/clear-all-cache') }}" class="btn btn-primary">Executar Comando</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-4">
                <div class="card text-center m-b-3">
                    <div class="card-body">
                        <h4 class="card-title text-success">
                            <i class="fa fa-terminal"></i> Redefinir todo o cache
                        </h4>
                        <p class="card-text">Este comando define TODOS os seus sites em cache.</p>
                        <a href="{{ url('staff/commands/set-all-cache') }}" class="btn btn-primary">Executar Comando</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-4">
                <div class="card text-center m-b-3">
                    <div class="card-body">
                        <h4 class="card-title text-success">
                            <i class="fa fa-terminal"></i> Enviar email de teste
                        </h4>
                        <p class="card-text">Este comando testa sua configuração de email.</p>
                        <a href="{{ url('staff/commands/test-email') }}" class="btn btn-primary">Executar Comando</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
