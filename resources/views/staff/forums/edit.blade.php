@extends('layouts.dashboard')

@section('subtitle', 'Editar Fórum')

@section('content')

    <div class="font-weight-bold py-3 h4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ url('staff') }}">@lang('dashboard.title')</a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{ url('staff/forums') }}">@lang('dashboard.forums')</a>
            </li>
            <li class="breadcrumb-item active">Editar</li>
        </ol>
    </div>

    <hr class="container-m-nx border-light mt-0 mb-5">

    <div class="card mb-4">
        <h6 class="card-header">Editar - Fórum: {{ $forum->name }}</h6>
        <div class="card-body">

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
                        <th>Grupos</th>
                        <th>Ver o fórum</th>
                        <th>Ler tópicos</th>
                        <th>Responder aos tópicos</th>
                        <th>Iniciar novo tópico</th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($roles as $role)
                    <tr>
                        <td>{{ $role->name }}</td>
                        <td>
                            <label class="custom-control custom-checkbox px-2 m-0">
                                <input class="custom-control-input" type="checkbox" name="permissions[{{ $role->id }}][view_forum]" value="1" {{ $role->getPermissionsByForum($forum)->view_forum ? 'checked' : '' }}>
                                <span class="custom-control-label"></span>
                            </label>
                        </td>
                        <td>
                            <label class="custom-control custom-checkbox px-2 m-0">
                                <input class="custom-control-input" type="checkbox" name="permissions[{{ $role->id }}][read_topic]" value="1" {{ $role->getPermissionsByForum($forum)->read_topic ? 'checked' : '' }}>
                                <span class="custom-control-label"></span>
                            </label>
                        </td>
                        <td>
                            <label class="custom-control custom-checkbox px-2 m-0">
                                <input class="custom-control-input" type="checkbox" name="permissions[{{ $role->id }}][reply_topic]" value="1" {{ $role->getPermissionsByForum($forum)->reply_topic ? 'checked' : '' }}>
                                <span class="custom-control-label"></span>
                            </label>
                        </td>
                        <td>
                            <label class="custom-control custom-checkbox px-2 m-0">
                                <input class="custom-control-input" type="checkbox" name="permissions[{{ $role->id }}][start_topic]" value="1" {{ $role->getPermissionsByForum($forum)->start_topic ? 'checked' : '' }}>
                                <span class="custom-control-label"></span>
                            </label>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            <br>
            <div class="form-group">
                <div class="col-sm-5">
                    {!! Form::submit('Editar', ['class' => 'btn btn-primary btn-rounded btn-outline-primary']) !!}
                </div>
            </div>

            {!! Form::close() !!}

        </div>
    </div>

@endsection
