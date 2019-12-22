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
                        <a href="{{ url('staff/freeslots/create') }}">
                            <button type="button" class="btn btn-xs btn-outline-primary">
                                <span class="ion ion-md-add"></span> Adicionar
                            </button>
                        </a>
                        <div class="table-responsive m-t-15">
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
                                    <th class="text-center">Opções</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($freeslots as $freeslot)
                                    <tr>
                                        <th>{{ $freeslot->id }}</th>
                                        <td>{{ $freeslot->name }}</td>
                                        <td>{{ number_format($freeslot->required) }}</td>
                                        <td>{{ number_format($freeslot->actual) }}</td>
                                        <td>{{ $freeslot->days }}</td>
                                        <td>{{ $freeslot->is_freeleech == 1 ? 'Sim' : 'Nao' }}</td>
                                        <td>{{ $freeslot->is_silver == 1 ? 'Sim' : 'Nao' }}</td>
                                        <td>{{ $freeslot->is_doubleup == 1 ? 'Sim' : 'Nao' }}</td>
                                        <td class="text-center">
                                            <div class="btn-group">
                                                <a href="{{ url('staff/freeslots/' . $freeslot->id . '/edit') }}" data-toggle="tooltip" title="Editar FreeSlot">
                                                    <span class="fas fa-pencil-alt text-info"></span>
                                                </a>
                                                <a class="m-l-15" href="javascript:;" onclick="document.getElementById('freeslot-del-{{ $freeslot->id }}').submit();" data-toggle="tooltip" title="Remover FreeSlot">
                                                    <span class="fas fa-times text-danger"></span>
                                                </a>
                                                {!! Form::open(['url' => 'staff/freeslots/' . $freeslot->id, 'method' => 'DELETE', 'id' => 'freeslot-del-' . $freeslot->id , 'style' => 'display: none']) !!}
                                                {!! Form::close() !!}
                                            </div>
                                        </td>
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
