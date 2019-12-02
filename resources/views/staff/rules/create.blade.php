@extends('layouts.dashboard')

@section('title', 'Adicionar')

@section('css')
    <!-- SCEditor -->
    <link rel="stylesheet" href="{{ asset('vendor/sceditor/minified/themes/default.min.css') }}">
    <!-- Page JS Plugins CSS -->
    <link rel="stylesheet" href="{{ asset('vendor/minicolors/minicolors.css') }}">
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
                            <li class="breadcrumb-item"><a href="{{ url('staff/rules') }}">@lang('dashboard.rules')</a></li>
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
                        {!! Form::open(['url' => 'staff/rules', 'class' => 'form-horizontal']) !!}

                        <div class="form-group">
                            {!! Form::label('name', 'Nome: *') !!}
                            {!! Form::text('name', null, ['class' => 'form-control', 'required']) !!}
                        </div>

                        <div class="form-group">
                            {!! Form::label('color', 'Cor: (Opcional)') !!}
                            {!! Form::text('color', null ? '' : '#5c90d2', ['class' => 'form-control', 'id' => 'minicolors']) !!}
                        </div>

                        <div class="form-group">
                            {!! Form::label('icon', 'Ìcone: (Opcional)') !!}
                            {!! Form::text('icon', null, ['class' => 'form-control']) !!}
                        </div>

                        <div class="form-group">
                            {!! Form::label('description', 'Descrição: *') !!}
                            {!! Form::textarea('description', null, ['class' => 'form-control', 'rows' => 8]) !!}
                        </div>

                        <br>
                        {!! Form::submit('Adicionar', ['class' => 'btn btn-primary btn-rounded btn-outline-primary']) !!}

                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <!-- Minicolors -->
    <script src="{{ asset('vendor/minicolors/minicolors.js') }}"></script>
    <!-- SCEditor -->
    <script src="{{ asset('vendor/sceditor/minified/sceditor.min.js') }}"></script>
    <script src="{{ asset('vendor/sceditor/minified/formats/bbcode.js') }}"></script>
    <script src="{{ asset('vendor/sceditor/languages/pt-BR.js') }}"></script>

    <!-- Page JS Code -->
    <script nonce="{{ Bepsvpt\SecureHeaders\SecureHeaders::nonce() }}">
        $('#minicolors').minicolors({
            control:  'saturation',
            position: 'bottom right'
        });
    </script>

    <!-- Page JS Code -->
    <script nonce="{{ Bepsvpt\SecureHeaders\SecureHeaders::nonce() }}">
        $(document).ready(function () {
            let textarea = document.getElementById('description');
            sceditor.create(textarea, {
                format: 'bbcode',
                locale: 'pt-BR',
                emoticonsRoot: '/vendor/sceditor/',
                style: '/vendor/sceditor/minified/themes/content/default.min.css'
            });
        });
    </script>
@endsection
