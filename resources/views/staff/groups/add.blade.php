@extends('layouts.dashboard')

@section('subtitle', 'Adicionar Grupo')

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
            <li class="breadcrumb-item active">Adicionar</li>
        </ol>
    </div>

    <hr class="container-m-nx border-light mt-0 mb-5">

    <div class="card mb-4">
        <h6 class="card-header">Adicionar - Grupo</h6>
        <div class="card-body">

            @includeIf('errors.errors', [$errors])
            {!! Form::open(['url' => 'staff/roles', 'class' => 'form-horizontal']) !!}
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
                {!! Form::text('color', null ? '' : '#5c90d2', ['class' => 'form-control', 'id' => 'minicolors']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('icon', 'Icone: (Opcional)') !!}
                {!! Form::text('icon', null, ['class' => 'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('hnr', 'H-N-R: *') !!}
                {!! Form::text('hnr', null, ['class' => 'form-control', 'placeholder' => 'Valores em horas', 'required']) !!}
            </div>

            {!! Form::submit('Adicionar', ['class' => 'btn btn-primary btn-rounded btn-outline-primary']) !!}
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
