@extends('layouts.dashboard')

@section('subtitle', 'Adicionar Fórum')

@section('content')

    <div class="font-weight-bold py-3 h4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ url('staff') }}">@lang('dashboard.title')</a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{ url('staff/forums') }}">@lang('dashboard.forums')</a>
            </li>
            <li class="breadcrumb-item active">Adicionar</li>
        </ol>
    </div>

    <hr class="container-m-nx border-light mt-0 mb-5">

    <div class="card mb-4">
        <h6 class="card-header">Adicionar - Fórum</h6>
        <div class="card-body">

            @includeIf('errors.errors', [$errors])
            {!! Form::open(['url' => 'staff/forums', 'class' => 'form-horizontal']) !!}
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

            <div class="form-group mb-3">
                <div class="col-sm-8">
                    {!! Form::label('description', 'Descrição: *') !!}
                    {!! Form::textarea('description', null, ['class' => 'form-control', 'rows' => 8, 'required']) !!}
                </div>
            </div>
            <br>
            <h4 class="text-center mt-3">Permissões</h4>
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
                                <input class="custom-control-input" type="checkbox" name="permissions[{{ $role->id }}][view_forum]" value="1" checked="">
                                <span class="custom-control-label"></span>
                            </label>
                        </td>
                        <td>
                            <label class="custom-control custom-checkbox px-2 m-0">
                                <input class="custom-control-input" type="checkbox" name="permissions[{{ $role->id }}][read_topic]" value="1" checked="">
                                <span class="custom-control-label"></span>
                            </label>
                        </td>
                        <td>
                            <label class="custom-control custom-checkbox px-2 m-0">
                                <input class="custom-control-input" type="checkbox" name="permissions[{{ $role->id }}][reply_topic]" value="1" checked="">
                                <span class="custom-control-label"></span>
                            </label>
                        </td>
                        <td>
                            <label class="custom-control custom-checkbox px-2 m-0">
                                <input class="custom-control-input" type="checkbox" name="permissions[{{ $role->id }}][start_topic]" value="1" checked="">
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
                    {!! Form::submit('Adicionar', ['class' => 'btn btn-primary btn-rounded btn-outline-primary']) !!}
                </div>
            </div>

            {!! Form::close() !!}

        </div>
    </div>

@endsection
