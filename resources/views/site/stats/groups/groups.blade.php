@extends('layouts.dashboard')

@section('title', 'Grupos')

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
                            <li class="breadcrumb-item active" aria-current="page">Grupos</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <h4 class="m-b-20">Grupos</h4>
                <p class="text-danger">
                    <i class="fas fa-users"></i>
                    Grupos (Usuários por grupo)
                </p>
                <div class="row">
                    <!-- Column -->
                    @foreach ($groups as $group)
                    <div class="col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="row p-t-10 p-b-10">
                                    <!-- Column -->
                                    <div class="col p-r-0">
                                        <a href="{{ route('stats.group', ['slug' => $group->slug]) }}">
                                            <h1 class="font-light" style="color: {{ $group->color }};">
                                                {{ $group->users()->count() }}
                                            </h1>
                                        </a>
                                        <a href="{{ route('stats.group', ['slug' => $group->slug]) }}">
                                            <h6 class="text-muted">{{ $group->name }}</h6>
                                        </a>
                                    </div>
                                    <!-- Column -->
                                    <div class="col text-right align-self-center">
                                        <i class="display-5 {{ $group->icon }}" style="color: {{ $group->color }};"></i>
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
