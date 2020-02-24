@extends('layouts.dashboard')

@section('title', trans('dashboard.bonus'))

@section('css')
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
                            <li class="breadcrumb-item active" aria-current="page">@lang('dashboard.bonus')</li>
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
                        <h4 class="card-title">@lang('dashboard.bonus')</h4>
                        <a href="{{ url('staff/bonus/create') }}" class="btn btn-xs btn-primary">
                            <i class="ion ion-md-add"></i> Adicionar
                        </a>
                        <div class="table-responsive m-t-15">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th></th>
                                    <th>Tipo</th>
                                    <th>Tipo</th>
                                    <th>Pontos</th>
                                    <th>Ativado</th>
                                    <th>Opções</th>
                                </tr>
                                </thead>
                                <tbody class="js-table-sections-header">
                                @forelse($bonus as $b)
                                    <tr>
                                        <td><i class="fa fa-angle-right"></i></td>
                                        <td>{{ $b->name }}</td>
                                        <td><span class="badge badge-primary">{{ $b->type() }}</span></td>
                                        <td><span class="badge badge-info">{{ $b->cost }}</span></td>
                                        <td>
                                            @if($b->is_enabled)
                                                <span class="label label-success">Ativado</span>
                                            @else
                                                <span class="label label-danger">Desativado</span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <div class="btn-group">
                                                @if($b->is_enabled)
                                                    <a class="m-l-15" href="{{ url('staff/bonus/' . $b->id . '/disable') }}"
                                                       data-toggle="tooltip" title="Desativar Bônus">
                                                        <i class="fa fa-pause text-warning"></i>
                                                    </a>
                                                @else
                                                    <a class="m-l-15" href="{{ url('staff/bonus/' . $b->id . '/enable') }}"
                                                       data-toggle="tooltip" title="Ativar Bônus">
                                                        <i class="fa fa-play text-success"></i>
                                                    </a>
                                                @endif

                                                <a class="m-l-15" href="{{ url('staff/bonus/' . $b->id . '/edit') }}"
                                                   data-toggle="tooltip" title="Editar Bônus">
                                                    <i class="fas fa-pencil-alt text-info"></i>
                                                </a>

                                                <a class="m-l-15" href="#" data-toggle="tooltip"
                                                   data-original-title="Remover Bônus"
                                                   onclick="deleteData({{ $b->id }})" type="submit">
                                                    <i class="fa fa-times text-danger"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td class="text-center" colspan="6">Nada cadastrado no momento.</td>
                                    </tr>
                                @endforelse
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
                    url: "{{ url('staff/bonus') }}" + '/' + dataId,
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
