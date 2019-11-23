@extends('layouts.dashboard')

@section('subtitle', 'Editar Grupo')

@section('css')
    <!-- Page JS Plugins CSS -->
    <link rel="stylesheet" href="{{ asset('vendor/minicolors/minicolors.css') }}">
@endsection

@section('content')

    <div class="font-weight-bold py-3 h4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ url('staff') }}">@lang('dashboard.title')</a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{ url('staff/roles') }}">@lang('dashboard.roles')</a>
            </li>
            <li class="breadcrumb-item active">Editar</li>
        </ol>
    </div>

    <hr class="container-m-nx border-light mt-0 mb-5">

    <div class="card mb-4">
        <h6 class="card-header">Editar - Grupo</h6>
        <div class="card-body">

            @includeIf('errors.errors', [$errors])
            {!! Form::model($role, ['url' => 'staff/roles/' . $role->id, 'method' => 'PUT', 'class' => 'form-horizontal']) !!}
            <div class="form-group">
                {!! Form::label('name', 'Nome: *') !!}
                {!! Form::text('name', null, ['class' => 'form-control', 'required']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('description', 'Descrição: (Opcional)') !!}
                {!! Form::text('description', null, ['class' => 'form-control', 'rows' => 8]) !!}
            </div>

            <div class="form-group">
                {!! Form::label('color', 'Cor: (Opcional)') !!}
                {!! Form::text('color', $role->color, ['class' => 'form-control', 'id' => 'minicolors']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('icon', 'Icone: (Opcional)') !!}
                {!! Form::text('icon', null, ['class' => 'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('hnr', 'H-N-R: *') !!}
                {!! Form::text('hnr', ($role->hnr / 3600), ['class' => 'form-control', 'required']) !!}
            </div>

            {!! Form::submit('Alterar', ['class' => 'btn btn-success btn-rounded btn-outline-success']) !!}
            <br>
            {!! Form::close() !!}

        </div>
    </div>

@endsection

@section('script')
    <!-- Page JS Plugins -->
    <script src="{{ asset('vendor/minicolors/minicolors.js') }}"></script>

    <!-- Page JS Code -->
    <script nonce="{{ Bepsvpt\SecureHeaders\SecureHeaders::nonce() }}">
        let isRtl = $('body').attr('dir') === 'rtl' || $('html').attr('dir') === 'rtl';
        $('#minicolors').minicolors({
            control:  'saturation',
            position: 'bottom ' + (isRtl ? 'left' : 'right'),
        });
    </script>
@endsection
