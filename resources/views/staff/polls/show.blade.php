@extends('layouts.dashboard')

@section('title', 'Resultados')

@section('content')

    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-5 align-self-center">
                <h4 class="page-title">Staff Painel</h4>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('staff') }}">@lang('dashboard.title')</a></li>
                            <li class="breadcrumb-item"><a href="{{ url('staff/polls') }}">@lang('dashboard.polls')</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Resultados</li>
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
                        <h4 class="card-title">Resultados</h4>
                        <div class="panel panel-chat">
                            <div class="panel-body">
                                @foreach ($poll->poll_options as $option)
                                    <strong>{{ $option->option }}</strong>
                                    <span class="pull-right">{{ $option->poll_votes()->count() }} Voto(s)</span>
                                    <div class="progress">
                                        <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="{{ $option->votesPercent($totalVotes) }}" aria-valuemin="0" aria-valuemax="100" style="width: {{ $option->votesPercent($totalVotes) }}%;">
                                            {{ $option->votesPercent($totalVotes) }}%
                                        </div>
                                    </div>
                                @endforeach
                                <br>
                                <p>Total votos: {{ $totalVotes }}</p>
                                <hr />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
