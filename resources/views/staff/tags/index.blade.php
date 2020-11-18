@extends('layouts.dashboard')

@section('title', trans('dashboard.tags'))

@section('css')
    <!-- X-Editable -->
    <link href="{{ secure_asset('vendor/x-editable/dist/css/bootstrap-editable.css') }}" rel="stylesheet">
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
                            <li class="breadcrumb-item active" aria-current="page">@lang('dashboard.tags')</li>
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
                        <h4 class="card-title">@lang('dashboard.tags')</h4>
                        <a href="#" data-toggle="modal" data-target="#modal-add" class="btn btn-xs btn-primary">
                            <i class="ion ion-md-add"></i> Adicionar
                        </a>
                        @includeIf('errors.errors', [$errors])
                        @include('includes.messages')
                        <div class="table-responsive m-t-15">
                            <table class="table" id="datatable">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nome</th>
                                    <th>Uso em torrents</th>
                                    <th class="text-center">Opções</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($tags as $tag)
                                    <tr>
                                        <td>{{ $tag->id }}</td>
                                        <td>
                                            <a href="#" class="tagEdit" id="name" data-type="text" data-column="name"
                                               data-title="Editar Tag" data-name="name" data-value="{{ $tag->name }}"
                                               data-pk="{{ $tag->id }}"
                                               data-url="{{ route('tags.update', [$tag->id]) }}">{{ $tag->name }}</a>
                                        </td>
                                        <td><span class="badge badge-success">{{ $tag->torrents()->count() }}</span>
                                        </td>
                                        <td class="text-center">
                                            <a class="m-l-15" href="#" data-toggle="tooltip"
                                               data-original-title="Remover Tag"
                                               onclick="deleteData({{ $tag->id }})" type="submit">
                                                <i class="fa fa-times text-danger"></i>
                                            </a>
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

        <!-- Add Modal -->
        <div class="modal fade" id="modal-add" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-sm">
                {!! Form::open(['url' => 'staff/tags', 'class' => 'modal-content form-horizontal']) !!}
                <div class="modal-header">
                    <h5 class="modal-title">Tag</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">×</button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        {!! Form::label('name', 'Tag:') !!}
                        {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Nome', 'required', 'maxlength' => 200]) !!}
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-rounded btn-info" data-dismiss="modal">Fechar</button>
                    {!! Form::submit('Adicionar', ['class' => 'btn btn-rounded btn-primary']) !!}
                </div>
                {!! Form::close() !!}
            </div>
        </div>
        <!-- END Add Modal -->
    </div>

@endsection

@section('scripts')
    <!-- X-Editable -->
    <script src="{{ secure_asset('vendor/x-editable/dist/js/bootstrap-editable.min.js') }}"></script>
    <script src="{{ secure_asset('vendor/datatables/datatables.min.js') }}"></script>

    <script nonce="{{ Bepsvpt\SecureHeaders\SecureHeaders::nonce() }}">
        $(document).ready(function () {
            //datatable
            $('#datatable').DataTable({
                "displayLength": 50,
                "searching": true,
                "responsive": true,
                "order": [[1, "asc"]],
                "language": {
                    "url": '{{ secure_asset('vendor/datatables/Portuguese-Brasil.json') }}'
                }
            });

            //update tag
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('.tagEdit').editable({
                mode: 'inline',
                type: 'string',
                min: 1,
                max: 200,
                ajaxOptions: {
                    type: 'put',
                    dataType: 'json'
                },
                params: function (params) {
                    // add additional params from data-attributes of trigger element
                    params._token = $("#_token").data("token");
                    params.name = $(this).editable().data('name');
                    return params;
                },
                validate: function (string) {
                    if ($.trim(string) === '') {
                        return "Campo é obrigatório.";
                    }
                    let texto = $.trim(string.length);
                    if (texto <= 0 || texto >= 201) {
                        return "Minimo 1 e Máximo de 200 caracteres.";
                    }
                },
                success: function (data) {
                    console.log(data);
                },
                error: function (data) {
                    console.log(data);
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
                    url: "{{ url('staff/tags') }}" + '/' + dataId,
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
