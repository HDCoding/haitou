@extends('layouts.dashboard')

@section('title', 'Editar')

@section('css')
    <!-- minicolors -->
    <link href="{{ asset('vendor/minicolors/jquery.minicolors.css') }}" rel="stylesheet" />
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
                            <li class="breadcrumb-item"><a href="{{ url('staff/groups') }}">@lang('dashboard.groups')</a></li>
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
                        <h4 class="card-title">Editar</h4>
                        @includeIf('errors.errors', [$errors])
                        {!! Form::model($group, ['url' => 'staff/groups/' . $group->id, 'method' => 'PUT', 'class' => 'form-horizontal']) !!}
                        <div class="form-group">
                            {!! Form::label('name', 'Nome: *') !!}
                            {!! Form::text('name', $group->name, ['class' => 'form-control', 'required']) !!}
                        </div>

                        <div class="form-group">
                            {!! Form::label('color', 'Cor: (Opcional)') !!}
                            {!! Form::text('color', $group->color ? $group->color : '', ['class' => 'form-control minicolors']) !!}
                        </div>

                        <div class="form-group">
                            {!! Form::label('icon', 'Icone: (Opcional)') !!}
                            {!! Form::text('icon', $group->icon, ['class' => 'form-control']) !!}
                        </div>

                        <div class="form-group">
                            {!! Form::label('hnr', 'H-N-R: *') !!}
                            {!! Form::text('hnr', ($group->hnr / 3600), ['class' => 'form-control', 'required']) !!}
                        </div>

                        {!! Form::submit('Alterar', ['class' => 'btn btn-success btn-rounded']) !!}
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <!-- minicolors -->
    <script src="{{ asset('vendor/minicolors/jquery.minicolors.min.js') }}"></script>

    <!-- minicolors -->
    <script nonce="{{ Bepsvpt\SecureHeaders\SecureHeaders::nonce() }}">
        $('.minicolors').minicolors({
            control:  'saturation',
            position: 'bottom right',
            theme: 'bootstrap'
        });
    </script>
@endsection
