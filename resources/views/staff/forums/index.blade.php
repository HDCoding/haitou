@extends('layouts.dashboard')

@section('subtitle', trans('dashboard.forums'))

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
            <li class="breadcrumb-item active">@lang('dashboard.forums')</li>
        </ol>
    </div>

    <hr class="container-m-nx border-light mt-0 mb-5">

    <div class="demo-vertical-spacing">
        <ul class="nav nav-lg nav-tabs tabs-alt">
            <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#tab-forum">
                    <i class="fa fa-home"></i> @lang('dashboard.forums')
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ url('staff/forums/create') }}">
                    <i class="fa fa-plus text-primary"></i> Adicionar Fórum
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ url('staff/categories/create') }}" target="_blank">
                    <i class="fa fa-plus text-primary"></i> Adicionar Categoria
                </a>
            </li>
        </ul>
        @includeIf('errors.errors', [$errors])
        <div class="tab-content">
            <p class="text-center">
                <b class="text-danger">OBS:</b>
                <b>Excluindo a categoria todos os Fórums daquela categoria seram deletados.</b>
            </p>
            <div class="tab-pane fade show active" id="tab-forum">

                @forelse($categories as $category)
                    <div class="card mb-5">
                        <div class="card-header with-elements">
                            <h5 class="m-0 mr-5">{{ $category->name }}</h5>
                            <div class="card-header-elements">
                                <b class="text-success">Ordem:</b>
                                <a href="#" class="OrderEdit ml-3" id="position" data-type="number" data-column="position" data-title="Editar Ordem" data-name="position" data-value="{{ $category->position }}" data-pk="{{ $category->id }}" data-url="{{ route('category.order', ['id' => $category->id]) }}">{{ $category->position }}</a>
                            </div>
                            <div class="card-header-elements ml-md-auto">
                                <a href="{{ url('staff/categories/' . $category->id . '/edit') }}" class="btn btn-xs btn-default" type="button" data-toggle="tooltip" title="Editar Categoria"><i class="fa fa-pencil-alt text-info"></i></a>
                                <a href="javascript:;" onclick="document.getElementById('category-del-{{ $category->id }}').submit();" class="btn btn-xs btn-default" type="button" data-toggle="tooltip" title="Remover Categoria"><i class="fa fa-times text-danger"></i></a>
                                {!! Form::open(['url' => 'staff/categories/' . $category->id, 'method' => 'DELETE', 'id' => 'category-del-' . $category->id , 'style' => 'display: none']) !!}
                                {!! Form::close() !!}
                            </div>
                        </div>
                        <table class="table card-table">
                            <thead class="thead-light">
                                <tr>
                                    <th class="text-center" style="width: 100px;">Icone</th>
                                    <th>Nome</th>
                                    <th>Tópicos</th>
                                    <th style="width: 100px;">Ordem</th>
                                    <th class="text-center" style="width: 70px;">Opções</th>
                                </tr>
                            </thead>
                            <tbody>
                            @forelse($forums as $forum)
                                @if($category->id == $forum->category_id)
                                    <tr>
                                        <td class="text-center">
                                            <i class="{{ $forum->icon }} fa-2x"></i>
                                        </td>
                                        <td>
                                            <p class="push-10">{{ $forum->name }}</p>
                                            <p class="text-muted remove-margin-b">{{ $forum->description }}</p>
                                            <b>Moderadores: &nbsp;</b>
                                            @foreach($moderators as $moderator)
                                                @if($moderator->forum_id == $forum->id)
                                                    {{ link_to_route('user.profile', $moderator->staff->name, ['slug' => $moderator->staff->slug], ['target' => '_blank']) }}
                                                    &nbsp;
                                                @endif
                                            @endforeach
                                        </td>
                                        <td>{{ $forum->forum_topics()->count() }}</td>
                                        <td>
                                            <a href="#" class="OrderEdit" id="position" data-type="number"
                                               data-column="position" data-title="Editar Ordem" data-name="position"
                                               data-value="{{ $forum->position }}" data-pk="{{ $forum->id }}"
                                               data-url="{{ route('forum.order', ['id' => $forum->id]) }}">{{ $forum->position }}</a>
                                        </td>
                                        <td class="text-center">
                                            <div class="btn-group">
                                                <button class="btn btn-default" type="button">Opções</button>
                                                <div class="btn-group">
                                                    <button class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                                        <span class="caret"></span>
                                                    </button>
                                                    <ul class="dropdown-menu">
                                                        <li class="dropdown-header">Mod</li>
                                                        <li>
                                                            <a tabindex="-1" href="{{ route('forum.formaddmod', ['id' => $forum->id]) }}">
                                                                <i class="fa fa-plus text-warning"></i> Add Mod
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a tabindex="-1" href="{{ route('forum.formeditmod', ['id' => $forum->id]) }}">
                                                                <i class="fa fa-pencil-alt text-primary"></i> Editar Mod
                                                            </a>
                                                        </li>
                                                        <li class="divider"></li>
                                                        <li class="dropdown-header">Fórum</li>
                                                        <li>
                                                            <a tabindex="-1" href="{{ url('staff/forums/' . $forum->id . '/edit') }}">
                                                                <i class="fa fa-pencil-alt text-info"></i> Editar Fórum
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a tabindex="-1" href="javascript:;" onclick="document.getElementById('forum-del-{{ $forum->id }}').submit();"><i class="fa fa-times text-danger"></i> Remover Fórum</a>
                                                            {!! Form::open(['url' => 'staff/forums/' . $forum->id, 'method' => 'DELETE', 'id' => 'forum-del-' . $forum->id , 'style' => 'display: none']) !!}
                                                            {!! Form::close() !!}
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endif
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center">Nenhum fórum cadastrado no momento.</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                @empty
                    <p class="text-center">Nenhuma categoria cadastrada até o momento</p>
                @endforelse

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
