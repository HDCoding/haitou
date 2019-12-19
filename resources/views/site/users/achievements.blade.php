@extends('layouts.dashboard')

@section('title', 'Conquistas')

@section('content')

    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-5 align-self-center">
                <h4 class="page-title">Home</h4>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('home') }}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Conquistas</li>
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
                        <h4 class="card-title">Conquistas desbloqueadas: {{ $unlocked }}</h4>
                        <div class="table-responsive m-t-15">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>Troféu</th>
                                    <th>Descrição</th>
                                    <th class="text-center">Progresso</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($achievements as $achievement)
                                    <tr>
                                        <td>
                                            <img src="{{ asset('images/achievements/' . strtolower(str_replace(' ', '', $achievement->details->name) . '.png')) }}"
                                                 data-toggle="tooltip"
                                                 data-original-title="{{ $achievement->details->name }}"
                                                 alt="{{ $achievement->details->name }}" width="40px">
                                        </td>
                                        <td>{{ $achievement->details->description }}</td>
                                        @if($achievement->isUnlocked())
                                            <td class="text-center">
                                                <span class="badge badge-pill badge-success">Desbloqueado</span>
                                            </td>
                                        @else
                                            <td class="text-center">
                                                <span class="badge badge-pill badge-warning"> Progresso:
                                                {{ $achievement->points }} / {{ $achievement->details->points }}
                                                </span>
                                            </td>
                                        @endif
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
