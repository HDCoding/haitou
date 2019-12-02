@extends('layouts.dashboard')

@section('title', trans('dashboard.freeslots'))

@section('content')

    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-5 align-self-center">
                <h4 class="page-title">Staff Painel</h4>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('staff') }}">@lang('dashboard.title')</a></li>
                            <li class="breadcrumb-item active" aria-current="page">@lang('dashboard.freeslots')</li>
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
                        <h4 class="card-title">@lang('dashboard.freeslots')</h4>
                        <div class="table-responsive m-t-40">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Evento</th>
                                    <th>Necessário</th>
                                    <th>Atual</th>
                                    <th>Dias</th>
                                    <th>Freeleech</th>
                                    <th>Silver</th>
                                    <th>DoubleUP</th>
                                    <th>Opções</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($freeslots as $freeslot)
                                    <tr>
                                        <th>{{ $freeslot->id }}</th>
                                        <td>{{ $freeslot->name }}</td>
                                        <td>{{ $freeslot->required }}</td>
                                        <td>{{ $freeslot->actual }}</td>
                                        <td>{{ $freeslot->days }}</td>
                                        <td>{{ $freeslot->is_freeleech }}</td>
                                        <td>{{ $freeslot->is_silver }}</td>
                                        <td>{{ $freeslot->is_doubleup }}</td>
                                        <td>Deletar?</td>
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
