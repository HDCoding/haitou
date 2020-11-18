@extends('layouts.dashboard')

@section('title', trans('dashboard.calendars'))

@section('css')
    <!-- DataTables -->
    <link href="{{ secure_asset('vendor/datatables/DataTables-1.10.20/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    <!-- Sweet-Alert  -->
    <link href="{{ secure_asset('vendor/sweetalert/sweetalert.css') }}" rel="stylesheet"/>
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
                        <h4 class="card-title">@lang('dashboard.calendars')</h4>
                        <div class="table-responsive m-t-15">
                            <table class="table" id="datatable">
                                <thead>
                                <tr>
                                    <th>Usuário</th>
                                    <th>Evento</th>
                                    <th>Início</th>
                                    <th>Fim</th>
                                    <th>Ativado</th>
                                    <th>Views</th>
                                    <th>Criado Em</th>
                                    <th class="text-center">Opções</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($calendars as $calendar)
                                    <tr>
                                        <th>{{ $calendar->username }}</th>
                                        <td>{{ $calendar->name }}</td>
                                        <td>{{ format_date_time($calendar->start_date) }}</td>
                                        <td>{{ format_date_time($calendar->end_date) }}</td>
                                        <td>{{ $calendar->is_enabled ? 'Sim' : 'Não'}}</td>
                                        <td><span class="badge badge-info">{{ $calendar->views }}</span></td>
                                        <td>{{ format_date_time($calendar->created_at) }}</td>
                                        <td class="text-center">
                                            <div class="btn-group">
                                                <a href="javascript:;"
                                                   onclick="document.getElementById('calendar-upd-{{ $calendar->id }}').submit();">
                                                    @if($calendar->is_enabled)
                                                        <button type="button" class="btn btn-xs btn-info">
                                                            <i class="fas fa-pause" data-toggle="tooltip"
                                                               title="Desativar Evento"></i>
                                                            Desativar Evento
                                                        </button>
                                                    @else
                                                        <button type="button" class="btn btn-xs btn-success">
                                                            <i class="fas fa-play" data-toggle="tooltip"
                                                               title="Ativar Evento"></i>
                                                            Ativar Evento
                                                        </button>
                                                    @endif
                                                </a>
                                                {!! Form::open(['url' => 'staff/calendars/' . $calendar->id, 'method' => 'PUT', 'id' => 'calendar-upd-' . $calendar->id, 'style' => 'display: none']) !!}
                                                {!! Form::close() !!}
                                                <a class="m-l-15" href="#" data-toggle="tooltip"
                                                   data-original-title="Remover Evento"
                                                   onclick="deleteData({{ $calendar->id }})" type="submit">
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
    <!-- dataTables  -->
    <script src="{{ secure_asset('vendor/datatables/datatables.min.js') }}"></script>
    <!-- dataTables  -->
    <script nonce="{{ Bepsvpt\SecureHeaders\SecureHeaders::nonce() }}">
        $(document).ready(function () {
            $('#datatable').DataTable({
                "displayLength": 50,
                "searching": true,
                "responsive": true,
                "order": [[1, "asc"]],
                "language": {
                    "url": '{{ secure_asset('vendor/datatables/Portuguese-Brasil.json') }}'
                }
            });
        });
    </script>

    <!-- Sweet-Alert  -->
    <script src="{{ secure_asset('vendor/sweetalert/sweetalert.min.js') }}"></script>

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
                    url: "{{ url('staff/calendars') }}" + '/' + dataId,
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
