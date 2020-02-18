@extends('layouts.dashboard')

@section('title', trans('dashboard.polls'))

@section('css')
    <!-- DataTables -->
    <link href="{{ asset('vendor/datatables/DataTables-1.10.20/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endsection

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
                            <button type="button" class="btn btn-xs btn-primary">
                                <span class="ion ion-md-add"></span> Adicionar
                            </button>
                        </a>
                        <div class="table-responsive m-t-15">
                            <table class="table" id="datatable">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Pergunta</th>
                                    <th>Multipla escolha</th>
                                    <th>Tópico</th>
                                    <th>Status</th>
                                    <th>Votos</th>
                                    <th>Criado em</th>
                                    <th class="text-center" style="width: 100px;">Opções</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($polls as $poll)
                                    <tr>
                                        <td>{{ $poll->id }}</td>
                                        <td>{{ link_to_route('polls.show', $poll->name, $poll->id) }}</td>
                                        <td>{{ $poll->multi_choice ? 'Sim' : 'Não' }}</td>
                                        <td>{{ $poll->name() }}</td>
                                        <td>
                                            @if($poll->is_closed)
                                            {!! Form::open(['url' => 'staff/poll/' . $poll->id . '/open']) !!}
                                                <button type="submit" class="btn btn-sm" data-toggle="tooltip" title="Abrir Pesquisa">
                                                    <i class="fa fa-play text-success"></i>
                                                </button>
                                            {!! Form::close() !!}
                                            @else
                                            {!! Form::open(['url' => 'staff/poll/' . $poll->id . '/close']) !!}
                                                <button type="submit" class="btn btn-sm" data-toggle="tooltip" title="Fechar Pesquisa">
                                                    <i class="fa fa-stop text-danger"></i>
                                                </button>
                                            {!! Form::close() !!}
                                            @endif
                                        </td>
                                        <td>{{ $poll->votes()->count() }}</td>
                                        <td>{{ format_date($poll->created_at) }}</td>
                                        <td class="text-center">
                                            <div class="btn-group">
                                                <a href="{{ url('staff/poll/' . $poll->id . '/options/add') }}" data-toggle="tooltip" title="Adicionar Opções"><i class="fa fa-plus text-warning"></i></a>
                                                <a class="m-l-15" href="{{ url('staff/poll/' . $poll->id . '/options/remove') }}" data-toggle="tooltip" title="Remover Opções"><i class="fa fa-minus text-success"></i></a>
                                                <a class="m-l-15" href="{{ url('staff/polls/' . $poll->id . '/edit') }}" data-toggle="tooltip" title="Editar Poll"><i class="fa fa-pencil-alt text-info"></i></a>
                                                <a class="m-l-15" href="javascript:;" onclick="document.getElementById('poll-del-{{ $poll->id }}').submit();" data-toggle="tooltip" title="Remover Poll"><i class="fa fa-times text-danger"></i></a>
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

@section('scripts')
    <script src="{{ asset('vendor/datatables/datatables.min.js') }}"></script>
    <script nonce="{{ Bepsvpt\SecureHeaders\SecureHeaders::nonce() }}">
        $(document).ready(function () {
            $('#datatable').DataTable({
                "displayLength": 50,
                "searching": true,
                "responsive": true,
                "order": [[ 0, "asc" ]],
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Portuguese-Brasil.json"
                }
            });
        });
    </script>
@endsection
