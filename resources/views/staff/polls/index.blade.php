@extends('layouts.dashboard')

@section('subtitle', trans('dashboard.polls'))

@section('css')
    @include('includes.datatables.css')
@endsection

@section('content')

    <div class="font-weight-bold py-3 h4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ url('staff') }}">@lang('dashboard.title')</a>
            </li>
            <li class="breadcrumb-item active">@lang('dashboard.polls')</li>
        </ol>
    </div>

    <hr class="container-m-nx border-light mt-0 mb-5">

    <div class="card mb-4">
        <div class="card-header with-elements">
            <div class="card-header-elements">
                <a href="{{ url('staff/polls/create') }}">
                    <button type="button" class="btn btn-xs btn-outline-primary">
                        <span class="ion ion-md-add"></span> Adicionar
                    </button>
                </a>
            </div>
        </div>
        <div class="card-datatable table-responsive">
            <table class="table table-striped table-bordered data-table">
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
                            <a href="javascript:;" onclick="document.getElementById('poll-upd-{{ $poll->id }}').submit();" class="btn btn-xs btn-default" type="button">
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
                                <a href="{{ url('staff/poll/' . $poll->id . '/options/add') }}" class="btn btn-xs btn-default" type="button" data-toggle="tooltip" title="Adicionar Opções"><i class="fa fa-plus text-warning"></i></a>
                                <a href="{{ url('staff/poll/' . $poll->id . '/options/remove') }}" class="btn btn-xs btn-default" type="button" data-toggle="tooltip" title="Remover Opções"><i class="fa fa-minus text-success"></i></a>
                                <a href="{{ url('staff/polls/' . $poll->id . '/edit') }}" class="btn btn-xs btn-default" type="button" data-toggle="tooltip" title="Editar Poll"><i class="fa fa-pencil-alt text-info"></i></a>
                                <a href="javascript:;" onclick="document.getElementById('poll-del-{{ $poll->id }}').submit();" class="btn btn-xs btn-default" type="button" data-toggle="tooltip" title="Remover Poll"><i class="fa fa-times text-danger"></i></a>
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

@endsection

@section('script')
    @include('includes.datatables.js', ['perPage' => 50, 'order' => false])
@endsection
