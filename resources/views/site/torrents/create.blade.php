@extends('layouts.dashboard')

@section('title', 'Upload')

@section('css')
    <!-- select2 -->
    <link href="{{ secure_asset('vendor/select2/dist/css/select2.min.css') }}" rel="stylesheet">
    <!-- sceditor -->
    <link href="{{ secure_asset('vendor/sceditor/minified/themes/default.min.css') }}" rel="stylesheet">
@endsection

@section('content')

    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-5 align-self-center">
                <h4 class="page-title">Home</h4>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('home') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ url('torrents') }}">Torrents</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Upload</li>
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
                        <h3 class="card-title">Upload</h3>
                        @includeIf('errors.errors', [$errors])
                        @include('includes.messages')
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

                        <div class="form-row">
                            <div class="form-group col-sm-12">
                                {!! Form::label('tag_id', 'Tags:') !!}
                                {!! Form::select('tag_id[]', $tags, null, ['class' => 'custom-select select2', 'multiple' => 'multiple', 'size' => '10']) !!}
                            </div>
                        </div>

                        <div class="form-group">
                            {!! Form::label('description', 'Descrição:') !!}
                            {!! Form::textarea('description', null, ['class' => 'form-control', 'required']) !!}
                        </div>

                        {!! Form::submit('Enviar', ['class' => 'btn btn-primary btn-rounded']) !!}
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <!-- Select2 -->
    <script src="{{ secure_asset('vendor/select2/dist/js/select2.min.js') }}"></script>
    <!-- sceditor -->
    <script src="{{ secure_asset('vendor/sceditor/minified/sceditor.min.js') }}"></script>
    <script src="{{ secure_asset('vendor/sceditor/minified/formats/bbcode.js') }}"></script>
    <script src="{{ secure_asset('vendor/sceditor/languages/pt-BR.js') }}"></script>

    <!-- script -->
    <script nonce="{{ Bepsvpt\SecureHeaders\SecureHeaders::nonce() }}">
        $(document).ready(function () {
            $('.select2').select2();

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
