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
                <div class="card poll-widget">
                    <div class="card-body">
                        <h4 class="card-title">Resultados da Pesquisa: {{ $poll->name }}</h4>
                        <h5 class="card-subtitle">Aqui está o resultado da última pesquisa</h5>
                        <p class="font-bold text-muted mt-4">
                            {!! $poll->descriptionHtml() !!}
                        </p>
                        <ul class="list-style-none m-t-20 m-b-10">
                            @foreach ($poll->options as $option)
                            <li class="m-t-25">
                                <div class="d-flex align-items-center">
                                    <div>
                                        <h6 class="m-b-0 font-bold">{{ $option->name }}
                                            <span class="font-light">{{ $option->votes()->count() }} Votos</span>
                                        </h6>
                                    </div>
                                    <div class="ml-auto">
                                        <h6 class="m-b-0 font-bold">{{ $option->votesPercent($totalVotes) }}%</h6>
                                    </div>
                                </div>
                                <div class="progress m-t-10">
                                    <div class="progress-bar bg-success" role="progressbar" style="width: {{ $option->votesPercent($totalVotes) }}%" aria-valuenow="{{ $option->votesPercent($totalVotes) }}" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </li>
                            @endforeach
                        </ul>
                        <p class="mt-5"><strong>Total votos</strong>: {{ $poll->totalVotes() }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
