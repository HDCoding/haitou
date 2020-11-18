@extends('layouts.dashboard')

@section('title', trans('dashboard.faqs'))

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
                            <li class="breadcrumb-item active" aria-current="page">@lang('dashboard.faqs')</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <a href="{{ url('staff/faqs/create') }}" class="btn btn-primary m-b-4 m-l-15 mb-3">
                <i class="ion ion-md-add"></i> Adicionar Pergunta
            </a>
            @includeIf('errors.errors', [$errors])
            @include('includes.messages')
            @forelse($categories as $category)
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">{{ $category->name }}</h4>
                        </div>
                        <table class="table m-b-0">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Pergunta</th>
                                <th>Ativado</th>
                                <th class="text-center">Opções</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($faqs as $faq)
                                @if($faq->category_id == $category->id)
                                    <tr>
                                        <th>{{ $faq->id }}</th>
                                        <td>{{ $faq->question }}</td>
                                        <td>
                                            @if ($faq->is_enabled)
                                                <span class="label label-success">Ativado</span>
                                            @else
                                                <span class="label label-danger">Desativado</span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <div class="btn-group">
                                                @if($faq->is_enabled)
                                                    <a class="m-l-15" href="{{ url('staff/faq/' . $faq->id . '/disable') }}"
                                                       data-toggle="tooltip" title="Desativar Pergunta">
                                                        <i class="fa fa-pause text-warning"></i>
                                                    </a>
                                                @else
                                                    <a class="m-l-15" href="{{ url('staff/faq/' . $faq->id . '/enable') }}"
                                                       data-toggle="tooltip" title="Ativar Pergunta">
                                                        <i class="fa fa-play text-success"></i>
                                                    </a>
                                                @endif

                                                <a class="m-l-15" href="{{ url('staff/faqs/' . $faq->id . '/edit') }}"
                                                   data-toggle="tooltip" title="Editar Pergunta">
                                                    <i class="fa fa-pencil-alt text-info"></i>
                                                </a>

                                                <a class="m-l-15" href="#" data-toggle="tooltip"
                                                   data-original-title="Remover Pergunta"
                                                   onclick="deleteData({{ $faq->id }})" type="submit">
                                                    <i class="fa fa-times text-danger"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @endif
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center">Nenhuma pergunta cadastrada até o momento</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            @empty
                <p class="text-center">Nenhuma categoria cadastrada até o momento</p>
            @endforelse
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
                    url: "{{ url('staff/faqs') }}" + '/' + dataId,
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
