@extends('layouts.dashboard')

@section('title', 'Top 10')

@section('content')

    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-5 align-self-center">
                <h4 class="page-title">Staff Painel</h4>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('staff') }}">@lang('dashboard.title')</a></li>
                            <li class="breadcrumb-item"><a href="{{ url('staff/traffics') }}">Tráficos</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Top 10</li>
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
                        <h4 class="card-title">Top 10</h4>
                        <div class="table-responsive m-t-15">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>Mensal</th>
                                    <th>Recebido</th>
                                    <th>Enviado</th>
                                    <th>Total</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($topten as $key => $value)
                                    <tr>
                                        <td>{{ $value['label'] }}</td>
                                        <td>{{ $value['rx'] }}</td>
                                        <td>{{ $value['tx'] }}</td>
                                        <td>{{ $value['total'] }}</td>
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
