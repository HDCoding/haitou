@extends('layouts.dashboard')

@section('title', trans('dashboard.forums'))

@section('css')
    <!-- X-Editable -->
    <link href="{{ asset('vendor/x-editable/dist/css/bootstrap-editable.css') }}" rel="stylesheet">
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
                            <li class="breadcrumb-item active" aria-current="page">@lang('dashboard.forums')</li>
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
                        <div class="button-group">
                            <a href="{{ url('staff/forums/create') }}" class="btn btn-primary waves-effect">Adicionar Fórum</a>
                            <a href="{{ url('staff/categories/create') }}" target="_blank" class="btn btn-secondary waves-effect">Adicionar Categoria</a>
                        </div>

                        <div class="tab-content">
                            <p class="text-center">
                                <b class="text-danger">OBS:</b>
                                <b>Excluindo a categoria todos os Fórums daquela categoria seram deletados.</b>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            @includeIf('errors.errors', [$errors])
            @forelse($categories as $category)
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">{{ $category->name }}</h4>
                        <div class="row">
                            <div class="float-left m-l-10">
                                <b class="text-success">Ordem:</b>
                                <a href="#" class="OrderEdit" id="position" data-type="number" data-column="position" data-title="Editar Ordem" data-name="position" data-value="{{ $category->position }}" data-pk="{{ $category->id }}" data-url="{{ route('category.order', ['id' => $category->id]) }}">{{ $category->position }}</a>
                            </div>
                            <div class="m-l-40 float-right">
                                <a href="{{ url('staff/categories/' . $category->id . '/edit') }}" data-toggle="tooltip" title="Editar Categoria"><i class="fa fa-pencil-alt text-info"></i></a>
                                <a class="m-l-15" href="javascript:;" onclick="document.getElementById('category-del-{{ $category->id }}').submit();" data-toggle="tooltip" title="Remover Categoria"><i class="fa fa-times text-danger"></i></a>
                                {!! Form::open(['url' => 'staff/categories/' . $category->id, 'method' => 'DELETE', 'id' => 'category-del-' . $category->id , 'style' => 'display: none']) !!}
                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                    <table class="table m-b-0">
                        <thead>
                        <tr>
                            <th>Icone</th>
                            <th>Nome</th>
                            <th>Tópicos</th>
                            <th>Ordem</th>
                            <th>Opções</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($forums as $forum)
                            @if($category->id == $forum->category_id)
                                <tr>
                                    <th>
                                        <i class="{{ $forum->icon }} fa-2x"></i>
                                    </th>
                                    <td>
                                        <p class="push-10">{{ $forum->name }}</p>
                                        <p class="text-muted remove-margin-b">{{ $forum->description }}</p>
                                        <b>Moderadores: &nbsp;</b>
                                        @foreach($moderators as $moderator)
                                            @if($moderator->forum_id == $forum->id)
                                                {{ $moderator->username }}
                                                &nbsp;
                                            @endif
                                        @endforeach
                                    </td>
                                    <td>{{ $forum->topics()->count() }}</td>
                                    <td>
                                        <a href="#" class="OrderEdit" id="position" data-type="number"
                                           data-column="position" data-title="Editar Ordem" data-name="position"
                                           data-value="{{ $forum->position }}" data-pk="{{ $forum->id }}"
                                           data-url="{{ route('forum.order', ['id' => $forum->id]) }}">{{ $forum->position }}</a>
                                    </td>
                                    <td>
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Opções
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="{{ route('forum.formaddmod', ['id' => $forum->id]) }}">
                                                    <i class="fa fa-plus text-warning"></i> Add Mod
                                                </a>
                                                <a class="dropdown-item" href="{{ route('forum.formeditmod', ['id' => $forum->id]) }}">
                                                    <i class="fa fa-pencil-alt text-primary"></i> Editar Mod
                                                </a>
                                                <div class="dropdown-divider"></div>
                                                <a class="dropdown-item" href="{{ url('staff/forums/' . $forum->id . '/edit') }}">
                                                    <i class="fa fa-pencil-alt text-info"></i> Editar Fórum
                                                </a>
                                                <a class="dropdown-item" href="javascript:;" onclick="document.getElementById('forum-del-{{ $forum->id }}').submit();"><i class="fa fa-times text-danger"></i> Remover Fórum</a>
                                                {!! Form::open(['url' => 'staff/forums/' . $forum->id, 'method' => 'DELETE', 'id' => 'forum-del-' . $forum->id , 'style' => 'display: none']) !!}
                                                {!! Form::close() !!}
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endif
                        @empty
                            <tr>
                                <td colspan="5" class="text-center">Nenhum fórum cadastrado no momento.</td>
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
