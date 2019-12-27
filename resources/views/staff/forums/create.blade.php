@extends('layouts.dashboard')

@section('title', 'Adicionar')

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
                            <li class="breadcrumb-item active" aria-current="page">Adicionar</li>
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
                        <h4 class="card-title">Adicionar</h4>
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

                        <div class="form-group m-b-3">
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
                            @foreach ($groups as $group)
                                <tr>
                                    <td>{{ $group->name }}</td>
                                    <td>
                                        <label class="custom-control custom-checkbox px-2 m-0">
                                            <input class="custom-control-input" type="checkbox" name="permissions[{{ $group->id }}][view_forum]" value="1" checked="">
                                            <span class="custom-control-label"></span>
                                        </label>
                                    </td>
                                    <td>
                                        <label class="custom-control custom-checkbox px-2 m-0">
                                            <input class="custom-control-input" type="checkbox" name="permissions[{{ $group->id }}][read_topic]" value="1" checked="">
                                            <span class="custom-control-label"></span>
                                        </label>
                                    </td>
                                    <td>
                                        <label class="custom-control custom-checkbox px-2 m-0">
                                            <input class="custom-control-input" type="checkbox" name="permissions[{{ $group->id }}][reply_topic]" value="1" checked="">
                                            <span class="custom-control-label"></span>
                                        </label>
                                    </td>
                                    <td>
                                        <label class="custom-control custom-checkbox px-2 m-0">
                                            <input class="custom-control-input" type="checkbox" name="permissions[{{ $group->id }}][start_topic]" value="1" checked="">
                                            <span class="custom-control-label"></span>
                                        </label>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                        <div class="form-group">
                            <div class="col-sm-5">
                                {!! Form::submit('Adicionar', ['class' => 'btn btn-primary btn-rounded']) !!}
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
