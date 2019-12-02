@extends('layouts.dashboard')

@section('title', trans('dashboard.polls'))

@section('content')

    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-5 align-self-center">
                <h4 class="page-title">Staff Painel</h4>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('staff') }}">@lang('dashboard.title')</a></li>
                            <li class="breadcrumb-item active" aria-current="page">@lang('dashboard.polls')</li>
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
                        <h4 class="card-title">@lang('dashboard.polls')</h4>
                        <a href="{{ url('staff/polls/create') }}">
                            <button type="button" class="btn btn-xs btn-outline-primary">
                                <span class="ion ion-md-add"></span> Adicionar
                            </button>
                        </a>
                        <hr>
                        <div class="table-responsive m-t-40">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th style="width: 5%;">#</th>
                                    <th style="width: 30%;">Pergunta</th>
                                    <th style="width: 12%;">Multipla escolha</th>
                                    <th style="width: 50px;">Tópico</th>
                                    <th style="width: 10px;">Fechado</th>
                                    <th style="width: 10px;">Votos</th>
                                    <th style="width: 10px;">Criado em</th>
                                    <th class="text-center" style="width: 100px;">Opções</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($polls as $poll)
                                    <tr>
                                        <td>{{ $poll->id }}</td>
                                        <td>{{ link_to_route('polls.show', $poll->name, ['id' => $poll->id]) }}</td>
                                        <td>{{ $poll->multi_choice ? 'Sim' : 'Não' }}</td>
                                        <td>{{ $poll->getName() }}</td>
                                        <td class="text-center">
                                            <a href="javascript:;" onclick="document.getElementById('poll-upd-{{ $poll->id }}').submit();" class="btn btn-xs" type="button">
                                                @if($poll->is_closed)
                                                    <i class="fa fa-stop text-danger" data-toggle="tooltip" title="Fechado"></i>
                                                @else
                                                    <i class="fa fa-play text-success" data-toggle="tooltip" title="Em Aberto"></i>
                                                @endif
                                            </a>
                                            {!! Form::open(['url' => 'staff/poll/' . $poll->id . '/update', 'method' => 'PUT', 'id' => 'poll-upd-' . $poll->id, 'style' => 'display: none']) !!}
                                            {!! Form::close() !!}
                                        </td>
                                        <td>{{ $poll->poll_votes()->count() }}</td>
                                        <td>{{ $poll->created_at->format('d/m/Y') }}</td>
                                        <td class="text-center">
                                            <div class="btn-group">
                                                <a href="{{ url('staff/poll/' . $poll->id . '/options/add') }}" class="btn btn-xs" type="button" data-toggle="tooltip" title="Adicionar Opções"><i class="fa fa-plus text-warning"></i></a>
                                                <a href="{{ url('staff/poll/' . $poll->id . '/options/remove') }}" class="btn btn-xs" type="button" data-toggle="tooltip" title="Remover Opções"><i class="fa fa-minus text-success"></i></a>
                                                <a href="{{ url('staff/polls/' . $poll->id . '/edit') }}" class="btn btn-xs" type="button" data-toggle="tooltip" title="Editar Poll"><i class="fa fa-pencil-alt text-info"></i></a>
                                                <a href="javascript:;" onclick="document.getElementById('poll-del-{{ $poll->id }}').submit();" class="btn btn-xs" type="button" data-toggle="tooltip" title="Remover Poll"><i class="fa fa-times text-danger"></i></a>
                                                {!! Form::open(['url' => 'staff/polls/' . $poll->id, 'method' => 'DELETE', 'id' => 'poll-del-' . $poll->id, 'style' => 'display: none']) !!}
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
