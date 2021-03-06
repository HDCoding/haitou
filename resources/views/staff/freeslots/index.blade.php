@extends('layouts.dashboard')

@section('title', trans('dashboard.freeslots'))

@section('css')
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
                            <li class="breadcrumb-item active" aria-current="page">@lang('dashboard.freeslots')</li>
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
                        <h4 class="card-title">@lang('dashboard.freeslots')</h4>
                        <a href="{{ url('staff/freeslots/create') }}" class="btn btn-xs btn-primary">
                            <i class="ion ion-md-add"></i> Adicionar
                        </a>
                        <div class="table-responsive m-t-15">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Evento</th>
                                    <th>Necessário</th>
                                    <th>Atual</th>
                                    <th>Dias</th>
                                    <th>Freeleech</th>
                                    <th>Silver</th>
                                    <th>DoubleUP</th>
                                    <th class="text-center">Opções</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($freeslots as $freeslot)
                                    <tr>
                                        <th>{{ $freeslot->id }}</th>
                                        <td>{{ $freeslot->name }}</td>
                                        <td>{{ number_format($freeslot->required) }}</td>
                                        <td>{{ number_format($freeslot->actual) }}</td>
                                        <td>{{ $freeslot->days }}</td>
                                        <td>{{ $freeslot->is_freeleech == 1 ? 'Sim' : 'Nao' }}</td>
                                        <td>{{ $freeslot->is_silver == 1 ? 'Sim' : 'Nao' }}</td>
                                        <td>{{ $freeslot->is_doubleup == 1 ? 'Sim' : 'Nao' }}</td>
                                        <td class="text-center">
                                            <div class="btn-group">
                                                <a href="{{ url('staff/freeslots/' . $freeslot->id . '/edit') }}"
                                                   data-toggle="tooltip" title="Editar FreeSlot">
                                                    <i class="fas fa-pencil-alt text-info"></i>
                                                </a>
                                                <a class="m-l-15" href="#" data-toggle="tooltip"
                                                   data-original-title="Remover FreeSlot"
                                                   onclick="deleteData({{ $freeslot->id }})" type="submit">
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
                    url: "{{ url('staff/freeslots') }}" + '/' + dataId,
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
