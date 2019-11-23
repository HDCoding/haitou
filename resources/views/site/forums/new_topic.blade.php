@extends('layouts.dashboard')

@section('subtitle', 'Forum')

@section('css')
    <!-- sceditor -->
    <link rel="stylesheet" href="{{ asset('vendor/sceditor/minified/themes/default.min.css') }}">
@endsection

@section('content')

    <div class="font-weight-bold py-3 h4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ url('home') }}">Home</a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{ url('forum') }}">Fórum</a>
            </li>
            <li class="breadcrumb-item active">Novo Tópico</li>
        </ol>
    </div>

    <hr class="container-m-nx border-light mt-0 mb-5">

    <div class="card mb-4">
        <h6 class="card-header">Novo Tópico</h6>
        <div class="card-body">

            @includeIf('errors.errors', [$errors])
            <!-- New Topic -->
            {!! Form::open(['route' => ['new.topic', 'id' => $forum->id, 'slug' => $forum->slug], 'class' => 'form-horizontal']) !!}

            <div class="form-group">
                {!! Form::label('name', 'Título do tópico: *', ['class' => 'form-label']) !!}
                {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Título do tópico', 'required', 'maxlength' => 250]) !!}
            </div>

            <div class="form-group">
                {!! Form::label('content', 'Conteúdo: *', ['class' => 'form-label']) !!}
                {!! Form::textarea('content', null, ['class' => 'form-control', 'rows' => 10]) !!}
            </div>

            {!! Form::submit('Adicionar Tópico', ['class' => 'btn btn-primary btn-rounded btn-outline-primary']) !!}
            <br>
            {!! Form::close() !!}
            <!-- END New Topic -->
        </div>
    </div>

@endsection

@section('script')
    <!-- sceditor -->
    <script src="{{ asset('vendor/sceditor/minified/sceditor.min.js') }}"></script>
    <script src="{{ asset('vendor/sceditor/minified/formats/bbcode.js') }}"></script>
    <script src="{{ asset('vendor/sceditor/languages/pt-BR.js') }}"></script>

    <!-- script -->
    <script nonce="{{ Bepsvpt\SecureHeaders\SecureHeaders::nonce() }}">
        $(document).ready(function () {
            var textarea = document.getElementById('content');
            sceditor.create(textarea, {
                format: 'bbcode',
                locale: 'pt-BR',
                emoticonsRoot: '/vendor/sceditor/',
                style: '/vendor/sceditor/minified/themes/content/default.min.css'
            });
        });
    </script>
@endsection
