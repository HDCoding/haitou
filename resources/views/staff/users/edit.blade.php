@extends('layouts.dashboard')

@section('subtitle', $user->name)

@section('css')
    <!-- Page -->
    <link rel="stylesheet" href="{{ asset('css/pages/users.css') }}">
@endsection

@section('content')

    <div class="media align-items-center py-3 mb-3">
        <img src="{{ $user->getAvatar() }}" alt="avatar" class="d-block ui-w-100 rounded-circle">
        <div class="media-body ml-4">
            <h4 class="font-weight-bold mb-0">{{ $user->name }}</h4>
            <div class="text-muted mb-2">ID: {{ $user->id }}</div>
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-body">
            <table class="table user-view-table m-0">
                <tbody>
                <tr>
                    <td>Registro:</td>
                    <td>{{ $user->created_at->format('d/m/Y') }}</td>
                </tr>
                <tr>
                    <td>Estado:</td>
                    <td>{{ $user->state->name }}</td>
                </tr>
                <tr>
                    <td>Download:</td>
                    <td>{{ $user->getDownloaded() }}</td>
                </tr>
                <tr>
                    <td>Upload:</td>
                    <td>{{ $user->getUploaded() }}</td>
                </tr>
                <tr>
                    <td>Ratio:</td>
                    <td>{{ $user->getRatio() }}</td>
                </tr>
                <tr>
                    <td>Classe:</td>
                    <td>{{ $user->role->name }}</td>
                </tr>
                <tr>
                    <td>Status:</td>
                    <td>{!! $user->getStatus() !!}</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>

    @includeIf('errors.errors', [$errors])
    <div class="nav-tabs-top">
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#user-edit-account">Conta</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ url('staff/user/'.$user->id.'/permissions') }}">Permissões</a>
            </li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane fade show active" id="user-edit-account">

                {!! Form::model($user, ['url' => 'staff/users/' . $user->id, 'method' => 'PUT', 'class' => 'form-horizontal']) !!}
                <div class="card-body pb-2">

                    <div class="form-group">
                        {!! Form::label('avatar', 'Avatar:', ['class' => 'form-label']) !!}
                        {!! Form::text('avatar', $user->avatar, ['class' => 'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('cover', 'Cover:', ['class' => 'form-label']) !!}
                        {!! Form::text('cover', $user->cover, ['class' => 'form-control']) !!}
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

                </div>
                <hr class="border-light m-0">
                <div class="card-body pb-2">

                    <div class="form-group">
                        {!! Form::label('role', 'Classe:', ['class' => 'form-label']) !!}
                        {!! Form::select('role', $roles, $user->role_id, ['class' => 'custom-select']) !!}
                    </div>
                    <div class="block-content block-content-full text-center">
                        <button class="btn btn-primary" type="submit"><i class="fas fa-check"></i> Salvar Alterações</button>
                        <button class="btn btn-warning" type="reset"><i class="fas fa-undo"></i> Reset</button>
                    </div>

                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>

@endsection
