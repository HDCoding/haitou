@extends('layouts.dashboard')

@section('title', 'Editar')

@section('content')

    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-5 align-self-center">
                <h4 class="page-title">Staff Painel</h4>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('staff') }}">@lang('dashboard.title')</a></li>
                            <li class="breadcrumb-item"><a href="{{ url('staff/forums') }}">@lang('dashboard.forums')</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Editar</li>
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
                        <h4 class="card-title">Editar - Fórum: {{ $forum->name }}</h4>
                        @includeIf('errors.errors', [$errors])
                        {!! Form::model($forum, ['url' => 'staff/forums/' . $forum->id, 'method' => 'PUT', 'class' => 'form-horizontal']) !!}
                        <div class="form-group">
                            <div class="col-sm-5">
                                {!! Form::label('name', 'Nome: *') !!}
                                {!! Form::text('name', null, ['class' => 'form-control', 'required', 'maxlength' => 250]) !!}
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-3">
                                {!! Form::label('category_id', 'Categoria: *') !!}
                                {!! Form::select('category_id', $categories, null, ['class' => 'form-control custom-select', 'required']) !!}
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-5">
                                {!! Form::label('icon', 'Ìcone: (Opcional)') !!}
                                {!! Form::text('icon', null, ['class' => 'form-control']) !!}
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-8">
                                {!! Form::label('description', 'Descrição: *') !!}
                                {!! Form::textarea('description', null, ['class' => 'form-control', 'rows' => 8, 'required']) !!}
                            </div>
                        </div>

                        <h3>Permissões</h3>
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th class="text-center">Grupos</th>
                                <th class="text-center">Ver o fórum</th>
                                <th class="text-center">Ler tópicos</th>
                                <th class="text-center">Responder aos tópicos</th>
                                <th class="text-center">Iniciar novo tópico</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($groups as $group)
                                <tr>
                                    <th class="text-center">{{ $group->name }}</th>
                                    <td class="text-center">
                                        <label class="custom-control custom-checkbox px-2 m-0">
                                            <input class="custom-control-input" type="checkbox" name="permissions[{{ $group->id }}][view_forum]" value="1" {{ $group->permissionsByForum($forum)->view_forum ? 'checked' : '' }}>
                                            <span class="custom-control-label"></span>
                                        </label>
                                    </td>
                                    <td class="text-center">
                                        <label class="custom-control custom-checkbox px-2 m-0">
                                            <input class="custom-control-input" type="checkbox" name="permissions[{{ $group->id }}][read_topic]" value="1" {{ $group->permissionsByForum($forum)->read_topic ? 'checked' : '' }}>
                                            <span class="custom-control-label"></span>
                                        </label>
                                    </td>
                                    <td class="text-center">
                                        <label class="custom-control custom-checkbox px-2 m-0">
                                            <input class="custom-control-input" type="checkbox" name="permissions[{{ $group->id }}][reply_topic]" value="1" {{ $group->permissionsByForum($forum)->reply_topic ? 'checked' : '' }}>
                                            <span class="custom-control-label"></span>
                                        </label>
                                    </td>
                                    <td class="text-center">
                                        <label class="custom-control custom-checkbox px-2 m-0">
                                            <input class="custom-control-input" type="checkbox" name="permissions[{{ $group->id }}][start_topic]" value="1" {{ $group->permissionsByForum($forum)->start_topic ? 'checked' : '' }}>
                                            <span class="custom-control-label"></span>
                                        </label>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                        <div class="form-group">
                            <div class="col-sm-5">
                                {!! Form::submit('Editar', ['class' => 'btn btn-primary btn-rounded']) !!}
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
