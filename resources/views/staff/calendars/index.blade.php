@extends('layouts.dashboard')

@section('title', trans('dashboard.calendars'))

@section('content')

    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-5 align-self-center">
                <h4 class="page-title">Staff Painel</h4>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('staff') }}">@lang('dashboard.title')</a></li>
                            <li class="breadcrumb-item active" aria-current="page">@lang('dashboard.calendars')</li>
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
                                    <th>Usuário</th>
                                    <th>Evento</th>
                                    <th>Início</th>
                                    <th>Fim</th>
                                    <th>Ativado</th>
                                    <th>Views</th>
                                    <th>Criado Em</th>
                                    <th>Opções</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($calendars as $calendar)
                                    <tr class="odd gradeX">
                                        <td>{{ $calendar->user->username }}</td>
                                        <td>{{ $calendar->name }}</td>
                                        <td>{{ $calendar->startAt() }}</td>
                                        <td>{{ $calendar->endAt() }}</td>
                                        <td>{{ $calendar->is_enabled ? 'Sim' : 'Não'}}</td>
                                        <td><span class="badge badge-info">{{ $calendar->views }}</span></td>
                                        <td>{{ $calendar->createdAt() }}</td>
                                        <td class="text-center">
                                            <div class="btn-group">
                                                <a href="javascript:;" onclick="document.getElementById('calendar-upd-{{ $calendar->id }}').submit();" class="btn btn-xs btn-outline" type="button">
                                                    @if($calendar->is_enabled)
                                                        <i class="fas fa-pause text-warning" data-toggle="tooltip" title="Desativar Evento"></i>
                                                        Desativar Evento
                                                    @else
                                                        <i class="fas fa-play text-success" data-toggle="tooltip" title="Ativar Evento"></i>
                                                        Ativar Evento
                                                    @endif
                                                </a>
                                                {!! Form::open(['url' => 'staff/calendars/' . $calendar->id, 'method' => 'PUT', 'id' => 'calendar-upd-' . $calendar->id, 'style' => 'display: none']) !!}
                                                {!! Form::close() !!}
                                                <a href="javascript:;" onclick="document.getElementById('calendar-del-{{ $calendar->id }}').submit();" data-toggle="tooltip" title="Remover Evento">
                                                    <button type="button" class="btn btn-xs btn-outline-danger">
                                                        <span class="fas fa-times"></span> Deletar
                                                    </button>
                                                </a>
                                                {!! Form::open(['url' => 'staff/calendars/' . $calendar->id, 'method' => 'DELETE', 'id' => 'calendar-del-' . $calendar->id , 'style' => 'display: none']) !!}
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
