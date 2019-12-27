@extends('layouts.dashboard')

@section('title', 'Editar')

@section('css')
    <!-- SCEditor -->
    <link href="{{ asset('vendor/sceditor/minified/themes/default.min.css') }}" rel="stylesheet">
    <!-- Minicolors -->
    <link href="{{ asset('vendor/minicolors/jquery.minicolors.css') }}" rel="stylesheet">
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
                        <h4 class="card-title">Conquistas</h4>
                        @includeIf('errors.errors', [$errors])
                        {!! Form::model($rule, ['url' => 'staff/rules/' . $rule->id, 'method' => 'PUT', 'class' => 'form-horizontal']) !!}
                        <div class="form-group">
                            {!! Form::label('name', 'Nome: *') !!}
                            {!! Form::text('name', $rule->name, ['class' => 'form-control', 'required']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('color', 'Cor: (Opcional)') !!}
                            {!! Form::text('color', $rule->color ? $rule->color : '', ['class' => 'form-control minicolors']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('icon', 'Ìcone: (Opcional)') !!}
                            {!! Form::text('icon', $rule->icon, ['class' => 'form-control']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('description', 'Descrição: *') !!}
                            {!! Form::textarea('description', $rule->description, ['class' => 'form-control', 'rows' => 8]) !!}
                        </div>
                        {!! Form::submit('Editar', ['class' => 'btn btn-primary btn-rounded']) !!}
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
    <!-- sceditor -->
    <script src="{{ asset('vendor/sceditor/minified/sceditor.min.js') }}"></script>
    <script src="{{ asset('vendor/sceditor/minified/formats/bbcode.js') }}"></script>
    <script src="{{ asset('vendor/sceditor/languages/pt-BR.js') }}"></script>

    <!-- JS Code -->
    <script nonce="{{ Bepsvpt\SecureHeaders\SecureHeaders::nonce() }}">
        $(document).ready(function () {
            //sceditor
            let textarea = document.getElementById('description');
            sceditor.create(textarea, {
                format: 'bbcode',
                locale: 'pt-BR',
                emoticonsRoot: '/vendor/sceditor/',
                style: '/vendor/sceditor/minified/themes/content/default.min.css'
            });

            //minicolors
            $(".minicolors").minicolors({
                control:  'saturation',
                position: 'bottom right',
                theme: 'bootstrap'
            });
        });
    </script>
@endsection
