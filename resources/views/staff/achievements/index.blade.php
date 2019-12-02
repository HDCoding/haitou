@extends('layouts.dashboard')

@section('title', 'Conquistas')

@section('content')

    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-5 align-self-center">
                <h4 class="page-title">Staff Painel</h4>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('staff') }}">@lang('dashboard.title')</a></li>
                            <li class="breadcrumb-item active" aria-current="page">@lang('dashboard.achievements')</li>
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
                        <h4 class="card-title">Conquistas</h4>
                        <div class="table-responsive m-t-40">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Troféu</th>
                                    <th>Descrição</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($achievements as $achievement)
                                    <tr>
                                        <th scope="row">{{ $achievement->id }}</th>
                                        <td>
                                            <img
                                                src="{{ asset('images/achievements/' . strtolower(str_replace(' ', '', $achievement->name) . '.png')) }}"
                                                data-toggle="tooltip"
                                                data-original-title="{{ $achievement->name }}"
                                                alt="{{ $achievement->name }}" width="40px">
                                        </td>
                                        <td>{{ $achievement->description }}</td>
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
