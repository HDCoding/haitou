@extends('layouts.dashboard')

@section('title', trans('dashboard.news'))

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
                            <li class="breadcrumb-item active" aria-current="page">@lang('dashboard.news')</li>
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
                        <h4 class="card-title">@lang('dashboard.news')</h4>
                        <a href="{{ url('staff/news/create') }}">
                            <button type="button" class="btn btn-xs btn-primary">
                                <span class="ion ion-md-add"></span> Adicionar
                            </button>
                        </a>
                        <div class="table-responsive m-t-15">
                            <table class="table" id="datatable">
                                <thead>
                                <tr>
                                    <th><i class="fa fa-suitcase text-gray"></i></th>
                                    <th>Título</th>
                                    <th>Por</th>
                                    <th>Views</th>
                                    <th class="text-center">Opções</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($news as $new)
                                    <tr class="odd gradeX">
                                        <td>{{ $new->id }}</td>
                                        <td>{{ $new->name }}</td>
                                        <td>{{ $new->user->username }}</td>
                                        <td><span class="badge badge-info">{{ $new->views }}</span></td>
                                        <td class="text-center">
                                            <div class="btn-group">
                                                <a href="{{ url('staff/news/' . $new->id . '/edit') }}"
                                                   data-toggle="tooltip" title="Editar News">
                                                    <i class="fas fa-pencil-alt text-info"></i>
                                                </a>
                                                <a class="m-l-15" href="#" data-toggle="tooltip"
                                                   data-original-title="Remover News"
                                                   onclick="deleteData({{ $new->id }})" type="submit">
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
                "order": [[0, "desc"]],
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
                    url: "{{ url('staff/news') }}" + '/' + dataId,
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
