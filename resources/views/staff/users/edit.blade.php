@extends('layouts.dashboard')

@section('title', 'Editar Membro')

@section('content')

    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-5 align-self-center">
                <h4 class="page-title">Staff Painel</h4>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('staff') }}">@lang('dashboard.title')</a></li>
                            <li class="breadcrumb-item"><a href="{{ url('staff/users') }}">@lang('dashboard.users')</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Editar Membro</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <!-- Column -->
            <div class="col-lg-4 col-xlg-3 col-md-5">
                <div class="card">
                    <div class="card-body">
                        <div class="m-t-30 text-center">
                            <img src="{{ $user->avatar() }}" class="rounded-circle" width="150" alt="avatar"/>
                            <h4 class="card-title m-t-10">{{ $user->username }}</h4>
                            <h6 class="card-subtitle">{{ $user->groupName() }}</h6>
                            <div class="row text-center justify-content-md-center">
                                <div class="col-4">
                                    <a href="javascript:void(0)" class="link" data-toggle="tooltip" title="ID">
                                        <i class="icon-people"></i>
                                        <span class="font-medium">{{ $user->id }}</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="card-body">
                        <small class="text-muted">Registro</small>
                        <h6>{{ format_date($user->created_at) }}</h6>
                        <small class="text-muted p-t-30 db">Estado</small>
                        <h6>{{ $user->state->name }}</h6>
                        <small class="text-muted p-t-30 db">Download</small>
                        <h6>{{ $user->downloaded() }}</h6>
                        <small class="text-muted p-t-30 db">Upload</small>
                        <h6>{{ $user->uploaded() }}</h6>
                        <small class="text-muted p-t-30 db">Ratio</small>
                        <h6>{{ $user->ratio() }}</h6>
                        <small class="text-muted p-t-30 db">Status</small>
                        <h6>{!! $user->status() !!}</h6>
                        <br/>
                    </div>
                </div>
            </div>
            <!-- Column -->
            <!-- Column -->
            <div class="col-lg-8 col-xlg-9 col-md-7">
                <div class="card">
                    <!-- Tabs -->
                    <ul class="nav nav-pills custom-pills" id="pills-tab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="pills-setting-tab" data-toggle="pill" href="#account" role="tab" aria-controls="pills-setting" aria-selected="true">Conta</a>
                        </li>
                    </ul>
                    <!-- Tabs -->
                    <div class="tab-content active" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="account" role="tabpanel" aria-labelledby="pills-setting-tab">
                            <div class="card-body">
                                @includeIf('errors.errors', [$errors])
                                {!! Form::model($user, ['url' => 'staff/users/' . $user->id, 'method' => 'PUT', 'class' => 'form-horizontal form-material']) !!}
                                    <div class="form-group">
                                        {!! Form::label('avatar', 'Avatar:', ['class' => 'form-label']) !!}
                                        {!! Form::text('avatar', $user->avatar, ['class' => 'form-control']) !!}
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('cover', 'Cover:', ['class' => 'form-label']) !!}
                                        {!! Form::text('cover', $user->cover(), ['class' => 'form-control']) !!}
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('title', 'Título para o Fórum', ['class' => 'form-label']) !!}
                                        {!! Form::text('title', $user->title, ['class' => 'form-control']) !!}
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('info', 'Info:', ['class' => 'form-label']) !!}
                                        {!! Form::textarea('info', $user->info, ['class' => 'form-control', 'rows' => 3]) !!}
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('signature', 'Assinatura (Fórum):', ['class' => 'form-label']) !!}
                                        {!! Form::textarea('signature', $user->signature, ['class' => 'form-control', 'rows' => 5]) !!}
                                    </div>
                                    <hr>
                                    <div class="form-group">
                                        {!! Form::label('group_id', 'Grupo:', ['class' => 'form-label']) !!}
                                        {!! Form::select('group_id', $groups, $user->group_id, ['class' => 'custom-select']) !!}
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <button class="btn btn-success" type="submit"><i class="fas fa-check"></i>Salvar Alterações</button>
                                            <button class="btn btn-warning" type="reset"><i class="fas fa-undo"></i>Reset</button>
                                        </div>
                                    </div>
                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Column -->
        </div>
    </div>

@endsection
