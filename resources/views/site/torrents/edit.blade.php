@extends('layouts.dashboard')

@section('title', 'Editar')

@section('css')
    <!-- select2 -->
    <link href="{{ asset('vendor/select2/dist/css/select2.min.css') }}" rel="stylesheet">
    <!-- sceditor -->
    <link href="{{ asset('vendor/sceditor/minified/themes/default.min.css') }}" rel="stylesheet">
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
                        <h4 class="card-title">Editar: {{ $torrent->name }}</h4>
                        @includeIf('errors.errors', [$errors])
                        {!! Form::model($torrent, ['route' => ['torrents.update', $torrent->id], 'method' => 'PUT',  'class' => 'form-horizontal']) !!}

                        <div class="form-row">
                            <div class="form-group col-sm-9">
                                {!! Form::label('name', 'Nome:') !!}
                                {!! Form::text('name', $torrent->name, ['class' => 'form-control', 'maxlength' => '250', 'required']) !!}
                            </div>
                            <div class="form-group col-sm-3">
                                {!! Form::label('is_anonymous', 'Upload Anonimo:') !!}
                                {!! Form::select('is_anonymous', [true => 'Sim', false => 'Não'], $torrent->is_anonymous, ['class' => 'custom-select', 'required']) !!}
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-sm-4">
                                {!! Form::label('category_id', 'Categoria:') !!}
                                {!! Form::select('category_id', $categories, $torrent->category_id, ['class' => 'custom-select select2']) !!}
                            </div>
                            <div class="form-group col-sm-4">
                                {!! Form::label('media_id', 'Mídia:') !!}
                                {!! Form::select('media_id', $medias, $torrent->media_id, ['class' => 'custom-select select2']) !!}
                            </div>
                            <div class="form-group col-sm-4">
                                {!! Form::label('fansub_id', 'Fansub:') !!}
                                {!! Form::select('fansub_id', $fansubs, $torrent->fansub_id, ['class' => 'custom-select select2']) !!}
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-sm-3">
                                {!! Form::label('allow_comments', 'Habilita comentário:') !!}
                                {!! Form::select('allow_comments', [false => 'Não', true => 'Sim'], $torrent->allow_comments, ['class' => 'custom-select', 'required']) !!}

                            </div>
                            <div class="form-group col-sm-3">
                                {!! Form::label('is_freeleech', 'Free Leech:') !!}
                                {!! Form::select('is_freeleech', [false => 'Não', true => 'Sim'], $torrent->is_freeleech, ['class' => 'custom-select', 'required']) !!}

                            </div>
                            <div class="form-group col-sm-3">
                                {!! Form::label('is_silver', 'Silver:') !!}
                                {!! Form::select('is_silver', [false => 'Não', true => 'Sim'], $torrent->is_silver, ['class' => 'custom-select', 'required']) !!}

                            </div>
                            <div class="form-group col-sm-3">
                                {!! Form::label('is_doubleup', 'Double UP:') !!}
                                {!! Form::select('is_doubleup', [false => 'Não', true => 'Sim'], $torrent->is_doubleup, ['class' => 'custom-select', 'required']) !!}
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-sm-12">
                                {!! Form::label('tag_id', 'Tags:') !!}
                                {!! Form::select('tag_id[]', $tags, $tag, ['class' => 'custom-select select2', 'multiple' => 'multiple', 'size' => '10']) !!}
                            </div>
                        </div>

                        <div class="form-group">
                            {!! Form::label('description', 'Descrição:') !!}
                            {!! Form::textarea('description', $torrent->description, ['class' => 'form-control', 'required']) !!}
                        </div>

                        {!! Form::submit('Atulizar', ['class' => 'btn btn-success btn-rounded']) !!}
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <!-- Select2 -->
    <script src="{{ asset('vendor/select2/dist/js/select2.min.js') }}"></script>
    <!-- sceditor -->
    <script src="{{ asset('vendor/sceditor/minified/sceditor.min.js') }}"></script>
    <script src="{{ asset('vendor/sceditor/minified/formats/bbcode.js') }}"></script>
    <script src="{{ asset('vendor/sceditor/languages/pt-BR.js') }}"></script>

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
