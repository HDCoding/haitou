@extends('layouts.dashboard')

@section('title', 'Adicionar')

@section('css')
    <!-- Page JS Plugins CSS -->
    <link href="{{ asset('vendor/minicolors/minicolors.css') }}" rel="stylesheet" />
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
                        {!! Form::open(['url' => 'staff/groups', 'class' => 'form-horizontal']) !!}
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
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <!-- Page JS Plugins -->
    <script src="{{ asset('vendor/minicolors/minicolors.js') }}"></script>

    <!-- Page JS Code -->
    <script nonce="{{ Bepsvpt\SecureHeaders\SecureHeaders::nonce() }}">
        $('#minicolors').minicolors({
            control:  'saturation',
            position: 'bottom right',
        });
    </script>
@endsection
