@extends('layouts.dashboard')

@section('title', 'Resultados da pesquisa')

@section('content')

    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-5 align-self-center">
                <h4 class="page-title">Home</h4>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('home') }}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Resultados da pesquisa</li>
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
                        <h3 class="card-title">{{ $poll->name }}</h3>
                        @foreach ($poll->options as $option)
                            <strong>{{ $option->name }}</strong>
                            <span class="pull-right">{{ $option->votes()->count() }} Voto(s)</span>
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

@endsection
