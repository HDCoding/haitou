@extends('layouts.dashboard')

@section('subtitle', trans('dashboard.categories'))

@section('css')
    <!-- X-Editable -->
    <link href="{{ asset('vendor/x-editable/dist/css/bootstrap-editable.css') }}" rel="stylesheet">
@endsection

@section('content')

    <div class="font-weight-bold py-3 h4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ url('staff') }}">@lang('dashboard.title')</a>
            </li>
            <li class="breadcrumb-item active">@lang('dashboard.categories')</li>
        </ol>
    </div>

    <hr class="container-m-nx border-light mt-0 mb-5">

    <div class="card-header">
        <div class="card-header-elements">
            <a href="{{ url('staff/categories/create') }}">
                <button type="button" class="btn btn-outline-primary">
                    <span class="ion ion-md-add"></span> Adicionar
                </button>
            </a>
        </div>
    </div>

    <div class="demo-vertical-spacing">
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
                <div class="card-header">F.A.Q</div>
                <table class="table card-table">
                    <thead class="thead-light">
                        <tr>
                            <th>Nome</th>
                            <th>Icone</th>
                            <th>Posição</th>
                            <th>Views</th>
                            <th>Opções</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($categories as $category)
                        @if($category->is_faq)
                        <tr>
                            <th>{{ $category->name }}</th>
                            <td>{{ $category->icon }}</td>
                            <td>
                                <a href="#" class="OrderEdit ml-3" id="position" data-type="number" data-column="position" data-title="Editar Ordem" data-name="position" data-value="{{ $category->position }}" data-pk="{{ $category->id }}" data-url="{{ route('category.order', ['id' => $category->id]) }}">{{ $category->position }}</a>
                            </td>
                            <td>{{ $category->views }}</td>
                            <td class="text-center">
                                <div class="btn-group">
                                    <a href="{{ url('staff/categories/' . $category->id . '/edit') }}" data-toggle="tooltip" title="Editar Categoria">
                                        <button type="button" class="btn btn-xs btn-outline-primary">
                                            <span class="fas fa-pencil-alt"></span> Editar
                                        </button>
                                    </a>
                                    <a href="javascript:;" onclick="document.getElementById('category-del-{{ $category->id }}').submit();" data-toggle="tooltip" title="Remover Categoria">
                                        <button type="button" class="btn btn-xs btn-outline-danger">
                                            <span class="fas fa-times"></span> Deletar
                                        </button>
                                    </a>
                                    {!! Form::open(['url' => 'staff/categories/' . $category->id, 'method' => 'DELETE', 'id' => 'category-del-' . $category->id , 'style' => 'display: none']) !!}
                                    {!! Form::close() !!}
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
                <div class="card-header">Fórum</div>
                <table class="table card-table">
                    <thead class="thead-light">
                        <tr>
                            <th>Nome</th>
                            <th>Cor</th>
                            <th>Icone</th>
                            <th>Posição</th>
                            <th>Views</th>
                            <th>Opções</th>
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
                                    <a href="#" class="OrderEdit ml-3" id="position" data-type="number" data-column="position" data-title="Editar Ordem" data-name="position" data-value="{{ $category->position }}" data-pk="{{ $category->id }}" data-url="{{ route('category.order', ['id' => $category->id]) }}">{{ $category->position }}</a>
                                </td>
                                <td>{{ $category->views }}</td>
                                <td class="text-center">
                                    <div class="btn-group">
                                        <a href="{{ url('staff/categories/' . $category->id . '/edit') }}">
                                            <button type="button" class="btn btn-xs btn-outline-primary">
                                                <span class="fas fa-pencil-alt" data-toggle="tooltip" title="Editar Categoria"></span> Editar
                                            </button>
                                        </a>
                                        <a href="javascript:;" onclick="document.getElementById('category-del-{{ $category->id }}').submit();">
                                            <button type="button" class="btn btn-xs btn-outline-danger">
                                                <span class="fas fa-times" data-toggle="tooltip" title="Remover Categoria"></span> Deletar
                                            </button>
                                        </a>
                                        {!! Form::open(['url' => 'staff/categories/' . $category->id, 'method' => 'DELETE', 'id' => 'category-del-' . $category->id , 'style' => 'display: none']) !!}
                                        {!! Form::close() !!}
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
                <div class="card-header">Mídia</div>
                <table class="table card-table">
                    <thead class="thead-light">
                        <tr>
                            <th>Nome</th>
                            <th>Icone</th>
                            <th>Views</th>
                            <th>Opções</th>
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
                                        <a href="{{ url('staff/categories/' . $category->id . '/edit') }}">
                                            <button type="button" class="btn btn-xs btn-outline-primary">
                                                <span class="fas fa-pencil-alt" data-toggle="tooltip" title="Editar Categoria"></span> Editar
                                            </button>
                                        </a>
                                        <a href="javascript:;" onclick="document.getElementById('category-del-{{ $category->id }}').submit();">
                                            <button type="button" class="btn btn-xs btn-outline-danger">
                                                <span class="fas fa-times" data-toggle="tooltip" title="Remover Categoria"></span> Deletar
                                            </button>
                                        </a>
                                        {!! Form::open(['url' => 'staff/categories/' . $category->id, 'method' => 'DELETE', 'id' => 'category-del-' . $category->id , 'style' => 'display: none']) !!}
                                        {!! Form::close() !!}
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
                <div class="card-header">Torrent</div>
                <table class="table card-table">
                    <thead class="thead-light">
                        <tr>
                            <th>Nome</th>
                            <th>Icone</th>
                            <th>Views</th>
                            <th>Opções</th>
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
                                        <a href="{{ url('staff/categories/' . $category->id . '/edit') }}">
                                            <button type="button" class="btn btn-xs btn-outline-primary">
                                                <span class="fas fa-pencil-alt" data-toggle="tooltip" title="Editar Categoria"></span> Editar
                                            </button>
                                        </a>
                                        <a href="javascript:;" onclick="document.getElementById('category-del-{{ $category->id }}').submit();">
                                            <button type="button" class="btn btn-xs btn-outline-danger">
                                                <span class="fas fa-times" data-toggle="tooltip" title="Remover Categoria"></span> Deletar
                                            </button>
                                        </a>
                                        {!! Form::open(['url' => 'staff/categories/' . $category->id, 'method' => 'DELETE', 'id' => 'category-del-' . $category->id , 'style' => 'display: none']) !!}
                                        {!! Form::close() !!}
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

@endsection

@section('script')
    <!-- X-Editable -->
    <script src="{{ asset('vendor/x-editable/dist/js/bootstrap-editable.min.js') }}"></script>
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
@endsection
