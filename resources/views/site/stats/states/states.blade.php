@extends('layouts.dashboard')

@section('title', 'Estados')

@section('content')

    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-5 align-self-center">
                <h4 class="page-title">Home</h4>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('home') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ url('statistics') }}">Estatísticas</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Estados</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <h4 class="m-b-20">Estados</h4>
                <p class="text-danger">
                    <i class="fas fa-users"></i>
                    Estados (Usuários por Estado)
                </p>
                <div class="row">
                    <!-- Column -->
                    @foreach ($states as $state)
                        <div class="col-lg-3 col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row p-t-10 p-b-10">
                                        <!-- Column -->
                                        <div class="p-r-10">
                                            <a href="{{ route('stats.state', ['state_id' => $state->id]) }}">
                                                <h1 class="font-light">
                                                    {{ $state->users()->count() }}
                                                </h1>
                                            </a>
                                            <a href="{{ route('stats.state', ['state_id' => $state->id]) }}">
                                                <h6 class="text-muted">{{ $state->name }}</h6>
                                            </a>
                                        </div>
                                        <!-- Column -->
                                        <div class="col text-right align-self-center">
                                            <img class="display-7" src="{{ $state->flag() }}" alt="Estado"/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <!-- Row -->
            </div>
        </div>
    </div>

@endsection
