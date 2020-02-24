@extends('layouts.dashboard')

@section('title', trans('dashboard.polls'))

@section('css')
    <!-- DataTables -->
    <link href="{{ asset('vendor/datatables/DataTables-1.10.20/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    <!-- Sweet-Alert  -->
    <link href="{{ asset('vendor/sweetalert/sweetalert.css') }}" rel="stylesheet"/>
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
                        <a href="{{ url('staff/polls/create') }}" class="btn btn-xs btn-primary">
                            <i class="ion ion-md-add"></i> Adicionar
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
                                                <button type="submit" class="btn btn-sm" data-toggle="tooltip"
                                                        title="Abrir Pesquisa">
                                                    <i class="fa fa-play text-success"></i>
                                                </button>
                                                {!! Form::close() !!}
                                            @else
                                                {!! Form::open(['url' => 'staff/poll/' . $poll->id . '/close']) !!}
                                                <button type="submit" class="btn btn-sm" data-toggle="tooltip"
                                                        title="Fechar Pesquisa">
                                                    <i class="fa fa-stop text-danger"></i>
                                                </button>
                                                {!! Form::close() !!}
                                            @endif
                                        </td>
                                        <td>{{ $poll->votes()->count() }}</td>
                                        <td>{{ format_date($poll->created_at) }}</td>
                                        <td class="text-center">
                                            <div class="btn-group">
                                                <a href="{{ url('staff/poll/' . $poll->id . '/options/add') }}"
                                                   data-toggle="tooltip" title="Adicionar Opções">
                                                    <i class="fa fa-plus text-warning"></i>
                                                </a>
                                                <a class="m-l-15"
                                                   href="{{ url('staff/poll/' . $poll->id . '/options/remove') }}"
                                                   data-toggle="tooltip" title="Remover Opções">
                                                    <i class="fa fa-minus text-success"></i>
                                                </a>
                                                <a class="m-l-15" href="{{ url('staff/polls/' . $poll->id . '/edit') }}"
                                                   data-toggle="tooltip" title="Editar Poll">
                                                    <i class="fa fa-pencil-alt text-info"></i>
                                                </a>
                                                <a class="m-l-15" href="#" data-toggle="tooltip"
                                                   data-original-title="Remover Poll"
                                                   onclick="deleteData({{ $poll->id }})" type="submit">
                                                    <i class="fa fa-times text-danger"></i>
                                                </a>
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
    <!-- DataTables -->
    <script src="{{ asset('vendor/datatables/datatables.min.js') }}"></script>
    <!-- DataTables -->
    <script nonce="{{ Bepsvpt\SecureHeaders\SecureHeaders::nonce() }}">
        $(document).ready(function () {
            $('#datatable').DataTable({
                "displayLength": 50,
                "searching": true,
                "responsive": true,
                "order": [[0, "asc"]],
                "language": {
                    "url": '{{ asset('vendor/datatables/Portuguese-Brasil.json') }}'
                }
            });
        });
    </script>

    <!-- Sweet-Alert  -->
    <script src="{{ asset('vendor/sweetalert/sweetalert.min.js') }}"></script>

    <!-- Sweet-Alert -->
    <script nonce="{{ Bepsvpt\SecureHeaders\SecureHeaders::nonce() }}">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        function deleteData(dataId) {
            swal({
                title: "Confirmar exclusão",
                text: "Tem certeza de que deseja excluir?",
                type: "warning",
                showCancelButton: true,
                cancelButtonText: "Cancelar",
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Sim, apague!",
            }, function (isConfirm) {
                if (!isConfirm) {
                    return;
                }
                $.ajax({
                    url: "{{ url('staff/polls') }}" + '/' + dataId,
                    type: "POST",
                    data: {'_method': 'DELETE'},
                    success: function () {
                        swal({
                                title: "Sucesso!",
                                text: "OK, excluído! \nClique em 'Ok' para atualizar a página.",
                                type: "success",
                            },
                            function () {
                                location.reload();
                            });
                    },
                    error: function () {
                        swal({
                            title: 'Opps...',
                            text: data.message,
                            type: 'error',
                            timer: '1500'
                        })
                    }
                })
            });
        }
    </script>
@endsection
