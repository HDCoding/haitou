@extends('layouts.dashboard')

@section('subtitle', trans('dashboard.polls'))

@section('content')

    <div class="font-weight-bold py-3 h4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ url('staff') }}">@lang('dashboard.title')</a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{ url('staff/polls') }}">@lang('dashboard.polls')</a>
            </li>
            <li class="breadcrumb-item active">Resultados da pesquisa</li>
        </ol>
    </div>

    <hr class="container-m-nx border-light mt-0 mb-5">

    <div class="card mb-4">
        <h6 class="card-header">{{ $poll->name }}</h6>
        <div class="card-body">

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

@endsection
