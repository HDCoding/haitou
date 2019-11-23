@extends('layouts.dashboard')

@section('subtitle', 'Upload Torrent')

@section('css')
    <!-- select2 -->
    <link rel="stylesheet" href="{{ asset('vendor/select2/select2.css') }}">
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
                <a href="{{ url('torrents') }}">Torrents</a>
            </li>
            <li class="breadcrumb-item active">Upload</li>
        </ol>
    </div>

    <hr class="container-m-nx border-light mt-0 mb-5">

    <div class="card mb-4">
        <h6 class="card-header">Upload</h6>
        <div class="card-body">

            @includeIf('errors.errors', [$errors])
            {!! Form::open(['route' => 'torrents.store', 'files' => true, 'class' => 'form-horizontal']) !!}

            <div class="form-group">
                {!! Form::label('torrent', 'Arquivo Torrent:') !!}
                {!! Form::file('torrent', ['accept' => '.torrent,application/x-bittorrent']) !!}
            </div>

            <div class="form-row">
                <div class="form-group col-sm-9">
                    {!! Form::label('name', 'Nome:') !!}
                    {!! Form::text('name', null, ['class' => 'form-control', 'maxlength' => '250', 'required']) !!}
                </div>
                <div class="form-group col-sm-3">
                    {!! Form::label('is_anonymous', 'Upload Anonimo:') !!}
                    {!! Form::select('is_anonymous', [true => 'Sim', false => 'Não'], null, ['class' => 'custom-select', 'required']) !!}
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-sm-3">
                    {!! Form::label('category_id', 'Categoria:') !!}
                    {!! Form::select('category_id', $categories, null, ['class' => 'custom-select select2', 'required']) !!}
                </div>
                <div class="form-group col-sm-4">
                    {!! Form::label('media_id', 'Mídia:') !!}
                    {!! Form::select('media_id', $medias, null, ['class' => 'custom-select select2', 'required']) !!}
                </div>
                <div class="form-group col-sm-4">
                    {!! Form::label('fansub_id', 'Fansub:') !!}
                    {!! Form::select('fansub_id', $fansubs, null, ['class' => 'custom-select select2', 'required']) !!}
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-sm-3">
                    {!! Form::label('allow_comments', 'Habilita comentário:') !!}
                    {!! Form::select('allow_comments', [false => 'Não', true => 'Sim'], null, ['class' => 'custom-select', 'required']) !!}
                </div>
                <div class="form-group col-sm-3">
                    {!! Form::label('is_freeleech', 'Free Leech:') !!}
                    {!! Form::select('is_freeleech', [false => 'Não', true => 'Sim'], null, ['class' => 'custom-select', 'required']) !!}
                </div>
                <div class="form-group col-sm-3">
                    {!! Form::label('is_silver', 'Silver:') !!}
                    {!! Form::select('is_silver', [false => 'Não', true => 'Sim'], null, ['class' => 'custom-select', 'required']) !!}
                </div>
                <div class="form-group col-sm-3">
                    {!! Form::label('is_doubleup', 'Double UP:') !!}
                    {!! Form::select('is_doubleup', [false => 'Não', true => 'Sim'], null, ['class' => 'custom-select', 'required']) !!}
                </div>
            </div>

            <div class="form-group">
                {!! Form::label('description', 'Descrição:') !!}
                {!! Form::textarea('description', null, ['class' => 'form-control', 'required']) !!}
            </div>

            <div class="form-group">
                {!! Form::submit('Enviar', ['class' => 'btn btn-primary btn-outline-primary']) !!}
            </div>
            <br>
            {!! Form::close() !!}

        </div>
    </div>

@endsection

@section('script')
    <!-- Select2 -->
    <script src="{{ asset('vendor/select2/select2.js') }}"></script>
    <!-- sceditor -->
    <script src="{{ asset('vendor/sceditor/minified/sceditor.min.js') }}"></script>
    <script src="{{ asset('vendor/sceditor/minified/formats/bbcode.js') }}"></script>
    <script src="{{ asset('vendor/sceditor/languages/pt-BR.js') }}"></script>

    <!-- script -->
    <script nonce="{{ Bepsvpt\SecureHeaders\SecureHeaders::nonce() }}">
        $(document).ready(function () {
            $('.select2').select2();

            var textarea = document.getElementById('description');
            sceditor.create(textarea, {
                format: 'bbcode',
                locale: 'pt-BR',
                emoticonsRoot: '/vendor/sceditor/',
                style: '/vendor/sceditor/minified/themes/content/default.min.css'
            });
        });
    </script>
@endsection
