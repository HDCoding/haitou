@extends('layouts.dashboard')

@section('title', trans('dashboard.medias'))

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
                            <li class="breadcrumb-item active" aria-current="page">@lang('dashboard.medias')</li>
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
                        <h4 class="card-title">@lang('dashboard.medias')</h4>
                        <a href="{{ url('staff/medias/create') }}">
                            <button type="button" class="btn btn-xs btn-primary">
                                <span class="ion ion-md-add"></span> Adicionar
                            </button>
                        </a>
                        <div class="table-responsive m-t-15">
                            <table class="table table-striped" id="datatable">
                                <thead>
                                <tr>
                                    <th><i class="fas fa-image"></i></th>
                                    <th>Categoria</th>
                                    <th>Nome</th>
                                    <th>Genero</th>
                                    <th>Views</th>
                                    <th>Estudio</th>
                                    <th class="text-center">Opções</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($medias as $media)
                                    <tr>
                                        <td class="align-middle">
                                            <img class="img-fluid" src="{{ $media->poster() }}" alt="{{ $media->name }}" width="70px">
                                        </td>
                                        <td class="align-middle">{{ $media->category->name }}</td>
                                        <td class="align-middle">{{ $media->name }}</td>
                                        <td class="align-middle">{!! $media->type() !!}</td>
                                        <td class="align-middle">
                                            <span class="badge badge-info">{{ $media->views }}</span>
                                        </td>
                                        <td class="align-middle">{{ $media->studio->name }}</td>
                                        <td class="text-center align-middle">
                                            <div class="btn-group">
                                                <a href="{{ url('staff/media/' . $media->id . '/images') }}"
                                                   data-toggle="tooltip" title="Imagens">
                                                    <i class="fas fa-image text-success"></i>
                                                </a>
                                                <a class="m-l-15"
                                                   href="{{ url('staff/media/' . $media->id . '/casts') }}"
                                                   data-toggle="tooltip" title="Casts">
                                                    <i class="fas fa-users text-warning"></i>
                                                </a>
                                                <a class="m-l-15"
                                                   href="{{ url('staff/medias/' . $media->id . '/edit') }}"
                                                   data-toggle="tooltip" title="Editar Mídia">
                                                    <i class="fas fa-pencil-alt text-info"></i>
                                                </a>
                                                <a class="m-l-15" href="#" data-toggle="tooltip"
                                                   data-original-title="Remover Mídia"
                                                   onclick="deleteData({{ $media->id }})" type="submit">
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
                "order": [[2, "asc"]],
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
                    url: "{{ url('staff/medias') }}" + '/' + dataId,
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
