@extends('layouts.dashboard')

@section('title', 'Permissões')

@section('content')

    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-5 align-self-center">
                <h4 class="page-title">Staff Painel</h4>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('staff') }}">@lang('dashboard.title')</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Permissões</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12 col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title text-success">Permissões comuns</h4>
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>Nome</th>
                                <th>Total usuários</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($usual_perms as $usual)
                                <tr>
                                    <th>{{ link_to_route('staff.permission', $usual->name, ['permission_id' => $usual->id]) }}</th>
                                    <td>({{ $usual->user()->count() }})</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-sm-12 col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title text-danger">Permissões staff</h4>
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>Nome</th>
                                <th>Total usuários</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($staff_perms as $staff)
                                <tr>
                                    <th>{{ link_to_route('staff.permission', $staff->name, ['permission_id' => $staff->id]) }}</th>
                                    <td>({{ $staff->user()->count() }})</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
