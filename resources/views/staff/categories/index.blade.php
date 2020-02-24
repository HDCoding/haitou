@extends('layouts.dashboard')

@section('title', trans('dashboard.categories'))

@section('css')
    <!-- X-Editable -->
    <link href="{{ asset('vendor/x-editable/dist/css/bootstrap-editable.css') }}" rel="stylesheet">
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
                            <li class="breadcrumb-item active" aria-current="page">@lang('dashboard.categories')</li>
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
                        <h4 class="card-title">@lang('dashboard.categories')</h4>
                        <a href="{{ url('staff/categories/create') }}" class="btn btn-xs btn-primary">
                            <i class="ion ion-md-add"></i> Adicionar
                        </a>
                        <div class="demo-vertical-spacing m-t-15">
                            <ul class="nav nav-pills nav-fill">
                                <li class="nav-item">
                                    <a class="nav-link active" data-toggle="tab" href="#faq">F.A.Q</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#forum">Fórum</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#media">Mídia</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#torrent">Torrent</a>
                                </li>
                            </ul>
                        </div>
                        <div class="tab-content">
                            <div class="tab-pane active" id="faq">
                                <div class="card">
                                    <table class="table card-table">
                                        <thead class="thead-light">
                                        <tr>
                                            <th>Nome</th>
                                            <th>Icone</th>
                                            <th>Posição</th>
                                            <th>Views</th>
                                            <th class="text-center">Opções</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($categories as $category)
                                            @if($category->is_faq)
                                                <tr>
                                                    <th>{{ $category->name }}</th>
                                                    <td>{{ $category->icon }}</td>
                                                    <td>
                                                        <a href="#" class="OrderEdit ml-3" id="position"
                                                           data-type="number" data-column="position"
                                                           data-title="Editar Ordem" data-name="position"
                                                           data-value="{{ $category->position }}"
                                                           data-pk="{{ $category->id }}"
                                                           data-url="{{ route('category.order', ['id' => $category->id]) }}">{{ $category->position }}</a>
                                                    </td>
                                                    <td>{{ $category->views }}</td>
                                                    <td class="text-center">
                                                        <div class="btn-group">
                                                            <a href="{{ url('staff/categories/' . $category->id . '/edit') }}"
                                                               data-toggle="tooltip" title="Editar Categoria">
                                                                <i class="fas fa-pencil-alt text-info"></i>
                                                            </a>
                                                            <a class="m-l-15" href="#" data-toggle="tooltip"
                                                               data-original-title="Remover Categoria"
                                                               onclick="deleteData({{ $category->id }})" type="submit">
                                                                <i class="fa fa-times text-danger"></i>
                                                            </a>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endif
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="tab-pane" id="forum">
                                <div class="card">
                                    <table class="table card-table">
                                        <thead class="thead-light">
                                        <tr>
                                            <th>Nome</th>
                                            <th>Cor</th>
                                            <th>Icone</th>
                                            <th>Posição</th>
                                            <th>Views</th>
                                            <th class="text-center">Opções</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($categories as $category)
                                            @if($category->is_forum)
                                                <tr>
                                                    <th>{{ $category->name }}</th>
                                                    <td>{{ $category->color }}</td>
                                                    <td>{{ $category->icon }}</td>
                                                    <td>
                                                        <a href="#" class="OrderEdit ml-3" id="position"
                                                           data-type="number" data-column="position"
                                                           data-title="Editar Ordem" data-name="position"
                                                           data-value="{{ $category->position }}"
                                                           data-pk="{{ $category->id }}"
                                                           data-url="{{ route('category.order', ['id' => $category->id]) }}">{{ $category->position }}</a>
                                                    </td>
                                                    <td>{{ $category->views }}</td>
                                                    <td class="text-center">
                                                        <div class="btn-group">
                                                            <a href="{{ url('staff/categories/' . $category->id . '/edit') }}"
                                                               data-toggle="tooltip" title="Editar Categoria">
                                                                <i class="fas fa-pencil-alt text-info"></i>
                                                            </a>
                                                            <a class="m-l-15" href="#" data-toggle="tooltip"
                                                               data-original-title="Remover Categoria"
                                                               onclick="deleteData({{ $category->id }})" type="submit">
                                                                <i class="fa fa-times text-danger"></i>
                                                            </a>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endif
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="tab-pane" id="media">
                                <div class="card">
                                    <table class="table card-table">
                                        <thead class="thead-light">
                                        <tr>
                                            <th>Nome</th>
                                            <th>Icone</th>
                                            <th>Views</th>
                                            <th class="text-center">Opções</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($categories as $category)
                                            @if($category->is_media)
                                                <tr>
                                                    <th>{{ $category->name }}</th>
                                                    <td>{{ $category->icon }}</td>
                                                    <td>{{ $category->views }}</td>
                                                    <td class="text-center">
                                                        <div class="btn-group">
                                                            <a href="{{ url('staff/categories/' . $category->id . '/edit') }}"
                                                               data-toggle="tooltip" title="Editar Categoria">
                                                                <i class="fas fa-pencil-alt text-info"></i>
                                                            </a>
                                                            <a class="m-l-15" href="#" data-toggle="tooltip"
                                                               data-original-title="Remover Categoria"
                                                               onclick="deleteData({{ $category->id }})" type="submit">
                                                                <i class="fa fa-times text-danger"></i>
                                                            </a>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endif
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="tab-pane" id="torrent">
                                <div class="card">
                                    <table class="table card-table">
                                        <thead class="thead-light">
                                        <tr>
                                            <th>Nome</th>
                                            <th>Icone</th>
                                            <th>Views</th>
                                            <th class="text-center">Opções</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($categories as $category)
                                            @if($category->is_torrent)
                                                <tr>
                                                    <th>{{ $category->name }}</th>
                                                    <td>{{ $category->icon }}</td>
                                                    <td>{{ $category->views }}</td>
                                                    <td class="text-center">
                                                        <div class="btn-group">
                                                            <a href="{{ url('staff/categories/' . $category->id . '/edit') }}"
                                                               data-toggle="tooltip" title="Editar Categoria">
                                                                <i class="fas fa-pencil-alt text-info"></i>
                                                            </a>
                                                            <a class="m-l-15" href="#" data-toggle="tooltip"
                                                               data-original-title="Remover Categoria"
                                                               onclick="deleteData({{ $category->id }})" type="submit">
                                                                <i class="fa fa-times text-danger"></i>
                                                            </a>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endif
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <!-- X-Editable -->
    <script src="{{ asset('vendor/x-editable/dist/js/bootstrap-editable.min.js') }}"></script>
    <!-- X-Editable -->
    <script nonce="{{ Bepsvpt\SecureHeaders\SecureHeaders::nonce() }}">
        $(document).ready(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('.OrderEdit').editable({
                mode: 'inline',
                type: 'number',
                min: 1,
                max: 125,
                ajaxOptions: {
                    type: 'put',
                    dataType: 'json'
                },
                validate: function (value) {
                    if ($.trim(value) === '') {
                        return "Campo é obrigatório";
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
                    url: "{{ url('staff/categories') }}" + '/' + dataId,
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
